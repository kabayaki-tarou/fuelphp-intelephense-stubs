<?php
/**
 * FuelPHP IDEスタブ生成スクリプト
 *
 * FuelPHPのAutoloaderが動的に生成するグローバル名前空間のクラスエイリアスを
 * Intellephenseに認識させるため、stubs/fuel_aliases.php を生成します。
 *
 * - FuelPHP core の bootstrap.php から Fuel\Core クラス一覧を取得します
 * - core実ファイルを読んで class / abstract class / interface を判定します
 * - appレベルのオーバーライドファイルが存在するクラスはスキップします
 *
 * 使い方:
 *   php tools/generate_ide_stubs.php /path/to/fuel/core /path/to/fuel/app/classes /path/to/stubs
 */

main($argv);

/**
 * @param  array<int, string> $argv
 * @return void
 */
function main(array $argv): void
{
  if (count($argv) !== 4) {
    fwrite(STDERR, "Usage: php {$argv[0]} /path/to/fuel/core /path/to/fuel/app/classes /path/to/stubs\n");
    exit(1);
  }

  $core_path = normalize_path($argv[1]);
  $app_classes_path = normalize_path($argv[2]);
  $output_path = normalize_path($argv[3]) . 'fuel_aliases.php';

  $core_classes = build_core_classes_from_bootstrap($core_path);
  if ($core_classes === []) {
    fwrite(STDERR, "FuelPHP core classes were not found in {$core_path}bootstrap.php\n");
    exit(1);
  }

  echo "処理中...\n";
  echo "  core_path: {$core_path}\n";
  echo "  app_classes_path: {$app_classes_path}\n";

  $lines = [];
  $skipped = [];
  $included = [];
  $kind_counts = [];

  foreach ($core_classes as $alias => $core_class) {
    $app_path = $app_classes_path . alias_to_app_path($alias);

    if (file_exists($app_path)) {
      $skipped[] = $alias;
      continue;
    }

    $included[] = $alias;
    $kind = $core_class['kind'];
    $kind_counts[$kind] = ($kind_counts[$kind] ?? 0) + 1;

    $lines[] = build_stub_declaration($alias, $core_class['fqcn'], $kind);
  }

  $output_path_parent = dirname($output_path);
  if (!is_dir($output_path_parent)) {
    mkdir($output_path_parent, 0755, true);
  }

  $header = <<<'PHP'
    <?php
    /**
     * FuelPHP IDE Stubs — tools/generate_ide_stubs.php により自動生成
     *
     * 手動で編集しないでください。
     * appオーバーライドの追加・削除後は、core/app/output の各パスを指定して再実行してください。
     *
     * このファイルはIntelephense専用です。実行時には読み込まれません。
     */

    PHP;

  file_put_contents($output_path, $header . implode("\n", $lines) . "\n");

  echo "  生成完了: {$output_path}\n";
  echo "  スタブ生成数: " . count($included) . "\n";
  foreach ($kind_counts as $kind => $count) {
    echo "    - {$kind}: {$count}\n";
  }
  echo "  スキップ数 (appオーバーライドが存在): " . count($skipped) . "\n";

  if ($skipped) {
    echo "\n  スキップされたクラス:\n";
    foreach ($skipped as $alias) {
      echo "    - {$alias} (" . $app_classes_path . alias_to_app_path($alias) . ")\n";
    }
  }

  echo "\n";
}

/**
 * パス末尾を DIRECTORY_SEPARATOR つきに正規化する
 *
 * @param  string $path
 * @return string
 */
function normalize_path(string $path): string
{
  return rtrim($path, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR;
}

/**
 * FuelPHP core の bootstrap.php からスタブ生成用のcoreクラス一覧を作る
 *
 * @param  string $core_path fuel/core/ へのパス
 * @return array<string, array{fqcn: string, kind: string}>
 */
function build_core_classes_from_bootstrap(string $core_path): array
{
  $bootstrap_path = $core_path . 'bootstrap.php';

  if (!is_file($bootstrap_path)) {
    return [];
  }

  $bootstrap = file_get_contents($bootstrap_path);
  if ($bootstrap === false) {
    return [];
  }

  preg_match_all(
    "#'Fuel\\\\\\\\Core\\\\\\\\([^']+)'\\s*=>\\s*COREPATH\\.'([^']+)'#",
    $bootstrap,
    $matches,
    PREG_SET_ORDER
  );

  $core_classes = [];
  foreach ($matches as $match) {
    $alias = $match[1];
    $relative_path = str_replace('/', DIRECTORY_SEPARATOR, $match[2]);
    $class_path = $core_path . $relative_path;

    $core_classes[$alias] = [
      'fqcn' => 'Fuel\\Core\\' . $alias,
      'kind' => detect_php_declaration_kind($class_path, $alias) ?? 'class',
    ];
  }

  return $core_classes;
}

/**
 * PHPファイルから指定クラス名の宣言種別を取得する
 *
 * @param  string $path
 * @param  string $class_name
 * @return string|null class / abstract class / interface / trait
 */
function detect_php_declaration_kind(string $path, string $class_name): ?string
{
  if (!is_file($path)) {
    return null;
  }

  $contents = file_get_contents($path);
  if ($contents === false) {
    return null;
  }

  $tokens = token_get_all($contents);
  $is_abstract = false;

  foreach ($tokens as $i => $token) {
    // abstract は class と別tokenなので、次の class まで覚えておく。
    if (is_array($token) && $token[0] === T_ABSTRACT) {
      $is_abstract = true;
      continue;
    }

    // 記号などの文字tokenが来たら、abstract class の並びではない。
    if (!is_array($token)) {
      if (trim($token) !== '') {
        $is_abstract = false;
      }
      continue;
    }

    // 空白・コメント・final は宣言の前に挟まっても判定状態を変えない。
    if (in_array($token[0], [T_WHITESPACE, T_COMMENT, T_DOC_COMMENT, T_FINAL], true)) {
      continue;
    }

    // class/interface/trait 以外の意味あるtokenで abstract 候補をリセットする。
    if (!in_array($token[0], [T_CLASS, T_INTERFACE, T_TRAIT], true)) {
      $is_abstract = false;
      continue;
    }

    // 1ファイルに複数宣言があるため、探している宣言名だけを対象にする。
    // 期待しているのは class, interface, trait
    $name = next_string_token($tokens, $i);
    if ($name === null || strcasecmp($name, $class_name) !== 0) {
      $is_abstract = false;
      continue;
    }

    if ($token[0] === T_INTERFACE) {
      return 'interface';
    }

    if ($token[0] === T_TRAIT) {
      return 'trait';
    }

    return $is_abstract ? 'abstract class' : 'class';
  }

  return null;
}

/**
 * 指定token以降に出てくる宣言名を取得する
 *
 * @param  array<int, mixed> $tokens
 * @param  int              $offset
 * @return string|null
 */
function next_string_token(array $tokens, int $offset): ?string
{
  for ($i = $offset + 1, $count = count($tokens); $i < $count; $i++) {
    // class と宣言名の間にある空白などを読み飛ばす。
    if (!is_array($tokens[$i])) {
      if (trim($tokens[$i]) === '') {
        continue;
      }
      return null;
    }

    // class Foo の Foo にあたる宣言名を返す。
    if ($tokens[$i][0] === T_STRING) {
      return $tokens[$i][1];
    }

    // コメントや空白以外が先に来たら、通常の宣言形式ではない。
    if (!in_array($tokens[$i][0], [T_WHITESPACE, T_COMMENT, T_DOC_COMMENT], true)) {
      return null;
    }
  }

  return null;
}

/**
 * クラスエイリアス名をappレベルのファイルパスに変換する
 *
 * FuelPHP の Autoloader::class_to_path() と同じロジック（小文字化、_ -> /）
 *
 * @param  string $alias グローバルエイリアス名 (例: "Cache_Storage_File")
 * @return string        appクラスパスからの相対パス (例: "cache/storage/file.php")
 */
function alias_to_app_path(string $alias): string
{
  return strtolower(str_replace('_', DIRECTORY_SEPARATOR, $alias)) . '.php';
}

/**
 * @param  string $alias
 * @param  string $fqcn
 * @param  string $kind
 * @return string
 */
function build_stub_declaration(string $alias, string $fqcn, string $kind): string
{
  if ($kind === 'interface') {
    return "interface {$alias} extends \\{$fqcn} {}";
  }

  if ($kind === 'abstract class') {
    return "abstract class {$alias} extends \\{$fqcn} {}";
  }

  return "class {$alias} extends \\{$fqcn} {}";
}
