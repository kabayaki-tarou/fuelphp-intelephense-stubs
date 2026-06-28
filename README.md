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

### 1. スタブの生成

FuelPHP core、appクラス、スタブ出力先ディレクトリのパスを指定して実行します。

```bash
php tools/generate_ide_stubs.php /path/to/fuel/core /path/to/fuel/app/classes /path/to/stubs
```

| 引数 | 説明 |
|---|---|
| 第1引数 | `fuel/core/` へのパス。`bootstrap.php` からcoreクラス一覧と宣言種別を判定 |
| 第2引数 | `fuel/app/classes/` へのパス |
| 第3引数 | スタブ出力先ディレクトリのパス。`fuel_aliases.php` が生成されます |

### 2. VS Code の設定（Intelephenseの場合）

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
php tools/generate_ide_stubs.php /path/to/fuel/core /path/to/fuel/app/classes /path/to/stubs
```

## 注意

生成されたスタブはIDE専用です。FuelPHPのオートローダーには読み込まれません。
