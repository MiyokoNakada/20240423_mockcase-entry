# Atte

社内勤怠管理システム  
人事評価に利用する目的で作成しました  
<br>
＜トップページ＞  
<img src="https://github.com/MiyokoNakada/20240423_mockcase-entry/assets/159742835/d6da36ad-46e8-4b16-a396-ce5b46cd2688" width=70%>
<br>

## URL
- 本番環境：http://3.27.233.206/  
  （上記URLでログイン後にトップページに遷移します)
- 開発環境：http://localhost/
- phpMyAdmin：http://localhost:8080/
<br>


## 関連レポジトリ
https://github.com/MiyokoNakada/20240423_mockcase-entry/  
<br>

## 機能一覧

- ログイン機能
- 会員登録機能
- 勤務開始・終了/休憩開始・終了ボタン
- 日付別勤怠情報一覧
- 従業員一覧
- 従業員別勤怠情報一覧
  <br>

## 使用技術(実行環境)

- PHP 8.2.12
- Laravel 10.48.8
- MySQL 8.0.36
  <br>

## テーブル設計

<img src="https://github.com/MiyokoNakada/20240423_mockcase-entry/assets/159742835/efff9dad-3b70-4cba-8891-473204842f4a" width=60%> 
<br>

## ER 図

![ER_Atte_tables](https://github.com/MiyokoNakada/20240423_mockcase-entry/assets/159742835/4b3eaeea-127c-437f-a2ed-e257277fb17d)
<br>

## 環境構築

### 開発環境のセットアップ

#### 前提条件

- Docker
- Docker Compose

#### 手順

1. リポジトリをクローン
   ```sh
   git clone git@github.com:MiyokoNakada/20240423_mockcase-entry.git
   cd 20240423_mockcase-entry
   ```
2. Docker コンテナをビルドして起動
   ```sh
   docker-compose -f docker-compose.dev.yml up --build -d
   ```
3. .env ファイルを作成し、必要な環境変数を設定

   ```sh
   cp src/.env.example src/.env
   ```

   ```env
   APP_ENV=development
   APP_DEBUG=true
   APP_URL=http://localhost

   DB_HOST=mysql
   DB_DATABASE=laravel_db
   DB_USERNAME=laravel_user
   DB_PASSWORD=laravel_pass

   MAIL_MAILER=smtp
   MAIL_HOST=your_email_host
   MAIL_PORT=2525
   MAIL_USERNAME=your_username
   MAIL_PASSWORD=your_password
   MAIL_ENCRYPTION=null
   MAIL_FROM_ADDRESS="email_verification@atte.com"
   MAIL_FROM_NAME="Atte"
   ```
   ※メールに関する設定項目もそれぞれの環境に合わせて変更

4. PHP コンテナにログイン後、composer のインストール
   ```sh
   docker-compose -f docker-compose.dev.yml exec php bash
   ```
   ```php
   composer install
   ```
5. アプリケーションキーの作成
   ```php
   php artisan key:generate
   ```
6. マイグレーションの実行
   ```php
   php artisan migrate
   ```

### 本番環境のセットアップ

#### 前提条件

- AWS EC2 インスタンス
- AWS RDS データベース

#### 手順

1. EC2 インスタンスを作成し、必要なソフトウェアをインストール

- Docker
- Docker-compose
- Git

2. RDS データーベースを作成し、作成した EC2 に接続
3. リポジトリをクローン
   ```sh
   git clone git@github.com:MiyokoNakada/20240423_mockcase-entry.git
   cd 20240423_mockcase-entry
   ```
4. `nginx/default.conf` ファイルを編集
    ```nginx/default.conf
    server_name 3.27.233.206;
    ```
5. Docker コンテナをビルドして起動
   ```sh
   docker-compose -f docker-compose.prod.yml up --build -d
   ```
6. .env ファイルを作成し、必要な環境変数を設定

   ```sh
   cp src/.env.example src/.env
   ```

   ```env
   APP_ENV=production
   APP_DEBUG=false
   APP_URL=http://3.27.233.206/

   DB_HOST=your_rds_endpoint
   DB_DATABASE=your_production_db
   DB_USERNAME=your_db_user
   DB_PASSWORD=your_db_password

   MAIL_MAILER=smtp
   MAIL_HOST=your_email_host
   MAIL_PORT=2525
   MAIL_USERNAME=your_username
   MAIL_PASSWORD=your_password
   MAIL_ENCRYPTION=null
   MAIL_FROM_ADDRESS="email_verification@atte.com"
   MAIL_FROM_NAME="Atte"
   ```
   ※メールに関する設定項目もそれぞれの環境に合わせて変更

7. PHP コンテナにログイン後、composer のインストール
   ```sh
   docker-compose -f docker-compose.prod.yml exec php bash
   ```
   ```php
   composer install
   ```
8. アプリケーションキーの作成
   ```php
   php artisan key:generate
   ```
9. マイグレーションの実行
   ```php
   php artisan migrate
   ```
