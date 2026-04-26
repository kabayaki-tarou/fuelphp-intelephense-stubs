# FuelPHP IDE Stubs Generator

FuelPHPの動的クラスエイリアスを、エディタ側に認識させるためのスタブファイルを生成するスクリプトです。

IntelephenseとPHPStormで使えることは確認しました。

## 動作要件

- PHP 7.3以上（スクリプト実行用）
- FuelPHP 1.8系

## ディレクトリ構成（想定）

```
your-fuelphp-project/
├── fuel/
│   └── app/
│       └── classes/        ← アプリのオーバーライドクラス
├── stubs/
│   └── fuel_aliases.php    ← 生成されるスタブファイル（gitignore推奨）
├── tools/
│   └── generate_ide_stubs.php
└── .vscode/
    └── settings.json
```

## セットアップ

### 1. スクリプトの設定

`$projects` 配列をプロジェクトに合わせて編集します。

```php
$projects = [
  'my-project' => [
    'app_classes_dir' => __DIR__ . '/../fuel/app/classes/',
    'output_file'     => __DIR__ . '/../stubs/fuel_aliases.php',
  ],
];
```

| キー | 説明 |
|---|---|
| `app_classes_dir` | `fuel/app/classes/` へのパス |
| `output_file` | 生成するスタブファイルのパス |
| `core_classes` | （省略可）FuelPHPバージョンが異なる場合に個別指定 |

複数プロジェクトを同一ワークスペースで管理している場合は、エントリを追加します。

```php
$projects = [
  'project-a' => [
    'app_classes_dir' => '/path/to/project-a/fuel/app/classes/',
    'output_file'     => '/path/to/project-a/stubs/fuel_aliases.php',
  ],
  'project-b' => [
    'app_classes_dir' => '/path/to/project-b/fuel/app/classes/',
    'output_file'     => '/path/to/project-b/stubs/fuel_aliases.php',
  ],
];
```

### 2. スタブの生成

```bash
php tools/generate_ide_stubs.php
```

### 3. VS Code の設定（Intelephenseの場合）

`.vscode/settings.json` にスタブディレクトリを追加します。

```json
{
  "intelephense.environment.includePaths": [
    "stubs"
  ]
}
```

複数プロジェクトの場合はそれぞれのパスを追加します。

```json
{
  "intelephense.environment.includePaths": [
    "path/to/project-a/stubs",
    "path/to/project-b/stubs"
  ]
}
```

設定後、コマンドパレットから `Intelephense: Index workspace` を実行してください。

## 再生成

`fuel/app/classes/` にファイルを追加・削除した際は再実行してください。

```bash
php tools/generate_ide_stubs.php
```

## 注意

生成されたスタブはIDE専用です。FuelPHPのオートローダーには読み込まれません。
