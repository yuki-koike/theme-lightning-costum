# web-template

WordPress子テーマ開発用のテンプレートです。
再利用性・保守性・開発効率を重視した構成になっています。

---

## 構築時開発環境

* WordPress 6.x
* PHP 8.x
* MySQL 8.x

### フロントエンド環境

* Node.js 24.x
* npm 11.x
* Sass
* Vite
* PostCSS（autoprefixer / cssnano / postcss-preset-env）
* ESLint / Stylelint / Prettier
* Husky / lint-staged

---

## 想定プラグイン

* All-In-One Security (AIOS)
* Advanced Custom Fields

---

## 概要

このテンプレートは複数サイト制作を前提とした
**WordPress子テーマ開発用テンプレート**です。

* SCSSによるスタイル管理
* JSのモジュール化（Vite）
* コード品質管理（lint / prettier）
* Git連携（コミット時自動チェック）

---

## ディレクトリ構成

```
my-custom-theme
│
├ assets                # ビルド後ファイル
│   ├ css
│   │   └ style.css
│   ├ js
│   │   └ script.js
│
├ include              # PHP機能分割
│   ├ setup.php
│   ├ enqueue.php
│   ├ post-types.php
│   ├ taxonomies.php
│   └ helpers.php
│
├ src                  # 開発用ファイル
│   ├ js
│   │   ├ init.js
│   │   └ main.js
│   └ scss
│       ├ style.scss
│       ├ components
│       ├ foundation
│       ├ layout
│       └ pages
│
├ functions.php
└ style.css            # テーマ認識用（中身なし）
```

---

## 開発コマンド

### 環境構築

```
npm i
```

* 環境インストール

---

### 開発（監視）

```
npm run dev
```

* SCSS監視（展開CSS）
* JS自動ビルド（Vite）

---

### CSSビルド（本番）

```
npm run build
```

実行内容：

* SCSSコンパイル（圧縮）
* autoprefixer適用
* cssnanoで最適化

---

### JSビルド

```
npm run build:js
```

---

### Lint

```
npm run lint:js
npm run lint:scss
```

---

## Git連携（重要）

### コミット時自動処理

* ESLint（JS）
* Stylelint（SCSS）
* 自動修正（--fix）

設定：lint-staged + husky

---

## 開発フロー

### 通常開発

```
npm run dev
```

---

### コミット前

```
git add .
git commit
```

👉 自動でlint実行

---

### 本番ビルド

```
npm run build
npm run build:js
```

---

## CSS設計

以下の構造でSCSSを管理：

```
foundation  # 変数・リセット・ベース
layout      # レイアウト
components  # UIパーツ
pages       # ページ単位
```

---

## JS設計

```
init.js  # 初期化処理
main.js  # メイン処理
```

👉 Viteでbundleして `assets/js/script.js` に出力

---

## functions.phpルール

functions.phpには直接処理を書かない

```php
require_once get_theme_file_path('/include/setup.php');
require_once get_theme_file_path('/include/enqueue.php');
require_once get_theme_file_path('/include/post-types.php');
require_once get_theme_file_path('/include/taxonomies.php');
require_once get_theme_file_path('/include/helpers.php');
```

---

## 命名規則

プレフィックス：

```
my_custom_theme_
```

例：

```
my_custom_theme_setup
my_custom_theme_enqueue_scripts
my_custom_theme_get_thumbnail
```

---

## コーディング方針

* 1ファイル1責務
* フックベースで処理分離
* 再利用関数はhelpers.phpへ
* 静的ファイルはassetsに集約

---

## 補足

* 開発時はCSSは圧縮しない（デバッグ優先）
* 本番時のみ最適化
* browserslistにより自動でベンダープレフィックス付与

---
