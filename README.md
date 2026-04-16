# web-template

WordPress子テーマ開発用のテンプレートです。
再利用性・保守性・開発効率を重視した構成になっています。

---

## 構築時開発環境

* WordPress 6.9.4
* PHP 8.2.29
* MySQL 8.0.35

### フロントエンド環境

* Node.js 24.14.0
* npm 11.9.0
* Sass
* Vite
* PostCSS（autoprefixer / cssnano / postcss-preset-env）
* ESLint / Stylelint / Prettier
* Husky / lint-staged

---

## 使用テーマ

- Lightning

---

## 使用プラグイン

* All-In-One Security (AIOS)
* Advanced Custom Fields
* vk-all-in-one-expansion-unit
* vk-block-patterns
* vk-blocks

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
├── functions.php                          # インクルード管理のみ
├── style.css                              # テーマ認識用（中身なし）
│
├── assets/                                # ビルド後ファイル
│   ├── css/
│   │   ├── style.css                      # コンパイル済みCSS
│   │   ├── style.css.map
│   │   ├── components/                    # コンポーネント別CSS
│   │   ├── foundation/                    # 基本スタイル
│   │   ├── layout/                        # レイアウトCSS
│   │   └── pages/                         # ページ別CSS
│   │
│   └── js/
│       └── script.js                      # バンドル済みJS
│
├── include/                               # PHP機能分割
│   ├── setup.php                          # テーマサポート設定
│   ├── enqueue.php                        # CSS/JS読み込み
│   ├── post-types.php                     # カスタム投稿タイプ
│   ├── taxonomies.php                     # カスタムタクソノミー
│   └── helpers.php                        # ヘルパー関数
│
└── src/                                   # 開発用ソース
    ├── js/
    │   ├── init.js                        # 初期化処理
    │   └── main.js                        # メイン処理
    │
    └── scss/
        ├── style.scss                     # メインエントリーポイント
        │
        ├── components/                    # コンポーネント（再利用可能）
        │   ├── breadcrumb.scss
        │   ├── button.scss
        │   ├── card.scss
        │   ├── comment.scss
        │   ├── form.scss
        │   ├── heading.scss
        │   ├── label.scss
        │   ├── list.scss
        │   ├── nav.scss
        │   ├── pagination.scss
        │   ├── post.scss
        │   ├── table.scss
        │   └── widget.scss
        │
        ├── foundation/                    # 基本スタイル（変数・リセット）
        │   ├── base.scss
        │   ├── reset.scss
        │   └── variables.scss
        │
        ├── layout/                        # レイアウト（共通構造）
        │   ├── container.scss
        │   ├── footer.scss
        │   └── header.scss
        │
        └── pages/                         # ページ固有スタイル
            ├── archive.scss               # アーカイブページ
            ├── error.scss                 # エラーページ
            ├── front.scss                 # フロントページ
            ├── home.scss                  # ホームページ
            ├── page.scss                  # 固定ページ
            ├── search.scss                # 検索ページ
            └── single.scss                # 単一投稿ページ

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

自動でlint実行

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

Viteでbundleして `assets/js/script.js` に出力

---

## PHP設計

functions.phpには直接処理を書かない
インクルードファイルに記述してfunctions.phpでまとめてインポートする

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

## インクルードファイルの記述ルール

### 基本方針
- すべての処理は関数内に記述する
- グローバルスコープに処理を書かない
- 「関数定義 → フック登録」の順で記述する

### 記述テンプレート

```php
/**
 * 概要: ファイルの役割
 */

// 関数定義
function my_custom_theme_xxx() {
  // 処理内容
}

// フック登録
add_action('hook_name', 'my_custom_theme_xxx');
```

### ルール詳細

#### 1. 直接処理を書かない

**NG**

```php
update_option('test', 'value');
```

**OK**

```php
function my_custom_theme_update_option() {
  update_option('test', 'value');
}
add_action('init', 'my_custom_theme_update_option');
```

#### 2. 無名関数（クロージャ）禁止

**NG**

```php
add_action('init', function () {
  // 処理
});
```

**OK**

```php
function my_custom_theme_init() {
  // 処理
}
add_action('init', 'my_custom_theme_init');
```

#### 3. フックは同一ファイル内で登録

**NG**

```php
// functions.php
add_action('init', 'my_custom_theme_register_post_type');
```

```php
// post-types.php
function my_custom_theme_register_post_type() {}
```

**OK**

```php
// post-types.php
function my_custom_theme_register_post_type() {}
add_action('init', 'my_custom_theme_register_post_type');
```

#### 4. 条件分岐は関数内で行う

```php
function my_custom_theme_example() {
  if (is_admin()) {
    return;
  }

  // フロント処理
}
```

#### 5. WordPressフックを必ず経由する

**NG**

```php
my_custom_theme_setup();
```

**OK**

```php
add_action('after_setup_theme', 'my_custom_theme_setup');
```

#### 6. 関数の責務を小さく保つ

**NG**

```php
function my_custom_theme_all() {
  // setup
  // enqueue
  // post-type
}
```

**OK**

```php
function my_custom_theme_setup() {}
function my_custom_theme_enqueue() {}
```

#### 7. 依存関係を持たせない
- 他ファイルの関数に依存しない
- 共通処理は `helpers.php` にまとめる

#### 8. returnを意識する

```php
function my_custom_theme_get_data() {
  return get_option('test');
}
```

#### 9. エスケープ・サニタイズ

```php
echo esc_html($text);
$input = sanitize_text_field($_POST['name']);
```

---

## ファイル別ルール

### setup.php
- `add_theme_support` のみ
- テーマ初期設定のみ

### enqueue.php
- `wp_enqueue_style` / `wp_enqueue_script` のみ
- 読み込み処理に限定

### post-types.php
- `register_post_type` のみ
- 1投稿タイプ = 1関数

### taxonomies.php
- `register_taxonomy` のみ

### helpers.php
- フックを使わない純粋関数のみ

```php
function my_custom_theme_get_thumbnail() {
  return get_the_post_thumbnail_url();
}
```