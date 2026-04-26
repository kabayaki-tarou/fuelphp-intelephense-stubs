<?php
/**
 * FuelPHP IDEスタブ生成スクリプト
 *
 * FuelPHPのAutoloaderが動的に生成するグローバル名前空間のクラスエイリアスを
 * Intellephenseに認識させるため、各プロジェクトの stubs/fuel_aliases.php を生成します。
 *
 * - appレベルのオーバーライドファイルが存在するクラスはスキップされます
 *   （Intellephenseがそのファイルを直接認識しているため、スタブ不要）
 * - Fuel\Core 名前空間でグローバルにエイリアスされるクラスのみ出力します
 *
 * 使い方:
 *   php tools/generate_ide_stubs.php
 */

// -----------------------------------------------------------------------
// プロジェクト設定
//
// 複数のFuelPHPプロジェクトがある場合はここに追加してください。
// core_classes を省略するとデフォルトの $default_core_classes が使われます。
// -----------------------------------------------------------------------
/** @var array<string, array{app_classes_dir: string, output_file: string, core_classes?: array<string, string>}> */
$projects = [
  'fuel' => [
    'app_classes_dir' => __DIR__ . '/../fuel/app/classes/',
    'output_file'     => __DIR__ . '/../stubs/fuel_aliases.php',
    // 'core_classes' => [...],  // プロジェクト固有のクラス一覧がある場合のみ指定
  ],
];

/**
 * setup_autoloader() で登録されている Fuel\Core クラスの一覧（デフォルト）
 *
 * 別バージョンのFuelPHPを使うプロジェクトがある場合は、
 * $projects の該当エントリに core_classes を個別指定してください。
 *
 * @var array<string, string> キー=グローバルエイリアス名, 値=完全修飾クラス名
 */
$default_core_classes = [
  'Agent'                          => 'Fuel\\Core\\Agent',
  'Arr'                            => 'Fuel\\Core\\Arr',
  'Asset'                          => 'Fuel\\Core\\Asset',
  'Asset_Instance'                 => 'Fuel\\Core\\Asset_Instance',
  'Cache'                          => 'Fuel\\Core\\Cache',
  'CacheNotFoundException'         => 'Fuel\\Core\\CacheNotFoundException',
  'CacheExpiredException'          => 'Fuel\\Core\\CacheExpiredException',
  'Cache_Handler_Driver'           => 'Fuel\\Core\\Cache_Handler_Driver',
  'Cache_Handler_Json'             => 'Fuel\\Core\\Cache_Handler_Json',
  'Cache_Handler_Serialized'       => 'Fuel\\Core\\Cache_Handler_Serialized',
  'Cache_Handler_String'           => 'Fuel\\Core\\Cache_Handler_String',
  'Cache_Storage_Driver'           => 'Fuel\\Core\\Cache_Storage_Driver',
  'Cache_Storage_Apc'              => 'Fuel\\Core\\Cache_Storage_Apc',
  'Cache_Storage_File'             => 'Fuel\\Core\\Cache_Storage_File',
  'Cache_Storage_Memcached'        => 'Fuel\\Core\\Cache_Storage_Memcached',
  'Cache_Storage_Redis'            => 'Fuel\\Core\\Cache_Storage_Redis',
  'Cache_Storage_Xcache'           => 'Fuel\\Core\\Cache_Storage_Xcache',
  'Config'                         => 'Fuel\\Core\\Config',
  'ConfigException'                => 'Fuel\\Core\\ConfigException',
  'Config_Db'                      => 'Fuel\\Core\\Config_Db',
  'Config_File'                    => 'Fuel\\Core\\Config_File',
  'Config_Ini'                     => 'Fuel\\Core\\Config_Ini',
  'Config_Json'                    => 'Fuel\\Core\\Config_Json',
  'Config_Interface'               => 'Fuel\\Core\\Config_Interface',
  'Config_Php'                     => 'Fuel\\Core\\Config_Php',
  'Config_Yml'                     => 'Fuel\\Core\\Config_Yml',
  'Config_Memcached'               => 'Fuel\\Core\\Config_Memcached',
  'Controller'                     => 'Fuel\\Core\\Controller',
  'Controller_Rest'                => 'Fuel\\Core\\Controller_Rest',
  'Controller_Template'            => 'Fuel\\Core\\Controller_Template',
  'Controller_Hybrid'              => 'Fuel\\Core\\Controller_Hybrid',
  'Cookie'                         => 'Fuel\\Core\\Cookie',
  'DB'                             => 'Fuel\\Core\\DB',
  'DBUtil'                         => 'Fuel\\Core\\DBUtil',
  'Database_Connection'            => 'Fuel\\Core\\Database_Connection',
  'Database_Result'                => 'Fuel\\Core\\Database_Result',
  'Database_Exception'             => 'Fuel\\Core\\Database_Exception',
  'Database_Expression'            => 'Fuel\\Core\\Database_Expression',
  'Database_Schema'                => 'Fuel\\Core\\Database_Schema',
  'Database_Query'                 => 'Fuel\\Core\\Database_Query',
  'Database_Query_Builder'         => 'Fuel\\Core\\Database_Query_Builder',
  'Database_Query_Builder_Insert'  => 'Fuel\\Core\\Database_Query_Builder_Insert',
  'Database_Query_Builder_Delete'  => 'Fuel\\Core\\Database_Query_Builder_Delete',
  'Database_Query_Builder_Update'  => 'Fuel\\Core\\Database_Query_Builder_Update',
  'Database_Query_Builder_Select'  => 'Fuel\\Core\\Database_Query_Builder_Select',
  'Database_Query_Builder_Where'   => 'Fuel\\Core\\Database_Query_Builder_Where',
  'Database_Query_Builder_Join'    => 'Fuel\\Core\\Database_Query_Builder_Join',
  'Database_SQLite_Builder_Delete' => 'Fuel\\Core\\Database_SQLite_Builder_Delete',
  'Database_SQLite_Builder_Update' => 'Fuel\\Core\\Database_SQLite_Builder_Update',
  'Database_Pdo_Connection'        => 'Fuel\\Core\\Database_Pdo_Connection',
  'Database_Pdo_Result'            => 'Fuel\\Core\\Database_Pdo_Result',
  'Database_Pdo_Cached'            => 'Fuel\\Core\\Database_Pdo_Cached',
  'Database_MySQL_Connection'      => 'Fuel\\Core\\Database_MySQL_Connection',
  'Database_SQLite_Connection'     => 'Fuel\\Core\\Database_SQLite_Connection',
  'Database_Sqlsrv_Connection'     => 'Fuel\\Core\\Database_Sqlsrv_Connection',
  'Database_Dblib_Connection'      => 'Fuel\\Core\\Database_Dblib_Connection',
  'Database_MySQLi_Connection'     => 'Fuel\\Core\\Database_MySQLi_Connection',
  'Database_MySQLi_Result'         => 'Fuel\\Core\\Database_MySQLi_Result',
  'Database_MySQLi_Cached'         => 'Fuel\\Core\\Database_MySQLi_Cached',
  'Fuel'                           => 'Fuel\\Core\\Fuel',
  'FuelException'                  => 'Fuel\\Core\\FuelException',
  'Finder'                         => 'Fuel\\Core\\Finder',
  'Date'                           => 'Fuel\\Core\\Date',
  'Debug'                          => 'Fuel\\Core\\Debug',
  'Cli'                            => 'Fuel\\Core\\Cli',
  'Crypt'                          => 'Fuel\\Core\\Crypt',
  'Event'                          => 'Fuel\\Core\\Event',
  'Event_Instance'                 => 'Fuel\\Core\\Event_Instance',
  'Errorhandler'                   => 'Fuel\\Core\\Errorhandler',
  'PhpErrorException'              => 'Fuel\\Core\\PhpErrorException',
  'Format'                         => 'Fuel\\Core\\Format',
  'Fieldset'                       => 'Fuel\\Core\\Fieldset',
  'Fieldset_Field'                 => 'Fuel\\Core\\Fieldset_Field',
  'File'                           => 'Fuel\\Core\\File',
  'FileAccessException'            => 'Fuel\\Core\\FileAccessException',
  'OutsideAreaException'           => 'Fuel\\Core\\OutsideAreaException',
  'InvalidPathException'           => 'Fuel\\Core\\InvalidPathException',
  'File_Area'                      => 'Fuel\\Core\\File_Area',
  'File_Handler_File'              => 'Fuel\\Core\\File_Handler_File',
  'File_Handler_Directory'         => 'Fuel\\Core\\File_Handler_Directory',
  'Form'                           => 'Fuel\\Core\\Form',
  'Form_Instance'                  => 'Fuel\\Core\\Form_Instance',
  'Ftp'                            => 'Fuel\\Core\\Ftp',
  'FtpConnectionException'         => 'Fuel\\Core\\FtpConnectionException',
  'FtpFileAccessException'         => 'Fuel\\Core\\FtpFileAccessException',
  'HttpException'                  => 'Fuel\\Core\\HttpException',
  'HttpBadRequestException'        => 'Fuel\\Core\\HttpBadRequestException',
  'HttpNoAccessException'          => 'Fuel\\Core\\HttpNoAccessException',
  'HttpNotFoundException'          => 'Fuel\\Core\\HttpNotFoundException',
  'HttpServerErrorException'       => 'Fuel\\Core\\HttpServerErrorException',
  'Html'                           => 'Fuel\\Core\\Html',
  'Image'                          => 'Fuel\\Core\\Image',
  'Image_Driver'                   => 'Fuel\\Core\\Image_Driver',
  'Image_Gd'                       => 'Fuel\\Core\\Image_Gd',
  'Image_Imagemagick'              => 'Fuel\\Core\\Image_Imagemagick',
  'Image_Imagick'                  => 'Fuel\\Core\\Image_Imagick',
  'Inflector'                      => 'Fuel\\Core\\Inflector',
  'Input'                          => 'Fuel\\Core\\Input',
  'Input_Instance'                 => 'Fuel\\Core\\Input_Instance',
  'Lang'                           => 'Fuel\\Core\\Lang',
  'LangException'                  => 'Fuel\\Core\\LangException',
  'Lang_Db'                        => 'Fuel\\Core\\Lang_Db',
  'Lang_File'                      => 'Fuel\\Core\\Lang_File',
  'Lang_Ini'                       => 'Fuel\\Core\\Lang_Ini',
  'Lang_Json'                      => 'Fuel\\Core\\Lang_Json',
  'Lang_Interface'                 => 'Fuel\\Core\\Lang_Interface',
  'Lang_Php'                       => 'Fuel\\Core\\Lang_Php',
  'Lang_Yml'                       => 'Fuel\\Core\\Lang_Yml',
  'Log'                            => 'Fuel\\Core\\Log',
  'Markdown'                       => 'Fuel\\Core\\Markdown',
  'Migrate'                        => 'Fuel\\Core\\Migrate',
  'Model'                          => 'Fuel\\Core\\Model',
  'Model_Crud'                     => 'Fuel\\Core\\Model_Crud',
  'Module'                         => 'Fuel\\Core\\Module',
  'ModuleNotFoundException'        => 'Fuel\\Core\\ModuleNotFoundException',
  'Mongo_Db'                       => 'Fuel\\Core\\Mongo_Db',
  'Mongo_DbException'              => 'Fuel\\Core\\Mongo_DbException',
  'Output'                         => 'Fuel\\Core\\Output',
  'Package'                        => 'Fuel\\Core\\Package',
  'PackageNotFoundException'       => 'Fuel\\Core\\PackageNotFoundException',
  'Pagination'                     => 'Fuel\\Core\\Pagination',
  'Presenter'                      => 'Fuel\\Core\\Presenter',
  'Profiler'                       => 'Fuel\\Core\\Profiler',
  'Request'                        => 'Fuel\\Core\\Request',
  'Request_Driver'                 => 'Fuel\\Core\\Request_Driver',
  'RequestException'               => 'Fuel\\Core\\RequestException',
  'RequestStatusException'         => 'Fuel\\Core\\RequestStatusException',
  'Request_Curl'                   => 'Fuel\\Core\\Request_Curl',
  'Request_Soap'                   => 'Fuel\\Core\\Request_Soap',
  'Redis_Db'                       => 'Fuel\\Core\\Redis_Db',
  'RedisException'                 => 'Fuel\\Core\\RedisException',
  'Response'                       => 'Fuel\\Core\\Response',
  'Route'                          => 'Fuel\\Core\\Route',
  'Router'                         => 'Fuel\\Core\\Router',
  'Sanitization'                   => 'Fuel\\Core\\Sanitization',
  'Security'                       => 'Fuel\\Core\\Security',
  'SecurityException'              => 'Fuel\\Core\\SecurityException',
  'Session'                        => 'Fuel\\Core\\Session',
  'Session_Driver'                 => 'Fuel\\Core\\Session_Driver',
  'Session_Db'                     => 'Fuel\\Core\\Session_Db',
  'Session_Cookie'                 => 'Fuel\\Core\\Session_Cookie',
  'Session_File'                   => 'Fuel\\Core\\Session_File',
  'Session_Memcached'              => 'Fuel\\Core\\Session_Memcached',
  'Session_Redis'                  => 'Fuel\\Core\\Session_Redis',
  'Session_Exception'              => 'Fuel\\Core\\Session_Exception',
  'Num'                            => 'Fuel\\Core\\Num',
  'Str'                            => 'Fuel\\Core\\Str',
  'TestCase'                       => 'Fuel\\Core\\TestCase',
  'Theme'                          => 'Fuel\\Core\\Theme',
  'ThemeException'                 => 'Fuel\\Core\\ThemeException',
  'Uri'                            => 'Fuel\\Core\\Uri',
  'Unzip'                          => 'Fuel\\Core\\Unzip',
  'Upload'                         => 'Fuel\\Core\\Upload',
  'Validation'                     => 'Fuel\\Core\\Validation',
  'Validation_Error'               => 'Fuel\\Core\\Validation_Error',
  'View'                           => 'Fuel\\Core\\View',
  'Viewmodel'                      => 'Fuel\\Core\\Viewmodel',
];

/**
 * クラスエイリアス名をappレベルのファイルパスに変換する
 *
 * FuelPHP の Autoloader::class_to_path() と同じロジック（小文字化、_ -> /）
 *
 * @param  string $alias グローバルエイリアス名 (例: "Cache_Storage_File")
 * @return string         appクラスディレクトリからの相対パス (例: "cache/storage/file.php")
 */
function alias_to_app_path(string $alias): string
{
  return strtolower(str_replace('_', DIRECTORY_SEPARATOR, $alias)) . '.php';
}

// -----------------------------------------------------------------------
// 各プロジェクトのスタブを生成
// -----------------------------------------------------------------------
foreach ($projects as $project_name => $project) {
  $app_classes_dir = $project['app_classes_dir'];
  $output_file     = $project['output_file'];
  $core_classes    = $project['core_classes'] ?? $default_core_classes;

  echo "[{$project_name}] 処理中...\n";

  // スタブ内容の構築
  $lines    = [];
  $skipped  = [];
  $included = [];

  foreach ($core_classes as $alias => $fqcn) {
    $app_file = $app_classes_dir . alias_to_app_path($alias);

    if (file_exists($app_file)) {
      // appオーバーライドが存在する場合はスキップ
      // （Intellephenseがそのファイルを直接認識しているためスタブ不要）
      $skipped[] = $alias;
      continue;
    }

    $included[] = $alias;

    // FuelPHPをロードせずに実行するため、クラス種別（class/interface/abstract）は
    // 判定できない。すべて class extends として出力する。
    $lines[] = "class {$alias} extends \\{$fqcn} {}";
  }

  // ファイル書き出し
  $output_dir = dirname($output_file);
  if (!is_dir($output_dir)) {
    mkdir($output_dir, 0755, true);
  }

  $header = <<<'PHP'
    <?php
    /**
     * FuelPHP IDE Stubs — tools/generate_ide_stubs.php により自動生成
     *
     * 手動で編集しないでください。
     * appオーバーライドの追加・削除後は `php tools/generate_ide_stubs.php` を再実行してください。
     *
     * このファイルはIntelephense専用です。実行時には読み込まれません。
     */

    PHP;

  file_put_contents($output_file, $header . implode("\n", $lines) . "\n");

  // 実行結果の出力
  echo "  生成完了: {$output_file}\n";
  echo "  スタブ生成数: " . count($included) . "\n";
  echo "  スキップ数 (appオーバーライドが存在): " . count($skipped) . "\n";

  if ($skipped) {
    echo "\n  スキップされたクラス:\n";
    foreach ($skipped as $alias) {
      echo "    - {$alias} (" . $app_classes_dir . alias_to_app_path($alias) . ")\n";
    }
  }

  echo "\n";
}
