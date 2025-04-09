#　アプリケーション名
商品管理

## 環境構築
Dockerビルド
1. ディレクトリを作成する
2. docker-compose up -d --build
3. DockerDesktopアプリを立ち上げる
4. git clone https://github.com/aya1204/fruit.git

Laravel環境構築
1. docker-compose exec php bash
2. composer -v
(composerがインストールできているか確認する)
3. Laravelプロジェクトの作成
　composer create-project "laravel/laravel=8.*" . --prefer-dist
4. 時間設定の編集
　src/config/app.phpを開き、70行目あたりの'timezone' => 'UTC',を'timezone' => 'Asia/Tokyo',に変更
5. .envに以下の環境変数を追加
　DB_CONNECTION=mysql
　DB_HOST=mysql
　DB_PORT=3306
　DB_DATABASE=laravel_db
　DB_USERNAME=laravel_user
　DB_PASSWORD=laravel_pass
6. アプリケーションキーの作成
　php artisan key:generate
7. マイグレーションの実行
　php artisan migrate
8. シーディングの実行
　php artisan db:seed


## 使用技術（実行環境）
PHP:7.4.7(cli)
Laravel: 8.83.29
Composer version 2.8.6
mysql  Ver 9.1.0 for macos15.2 on arm64 (Homebrew)

## ER図
productテーブルはproduct_seasonテーブルと１対多の関係

seasonテーブルはproduct_seasonテーブルと１対他の関係

![ER図](docs/fruit.png)


## URL
ローカル環境: [\[http://127.0.0.1:8000\]](http://localhost)
Githubリポジトリ:https://github.com/aya1204/fruit
商品一覧画面:http://localhost/products
商品登録画面:http://localhost/products/register
