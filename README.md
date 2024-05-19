# Atte
社内勤怠管理システム  
人事評価に利用する目的で作成しました  
<br>
＜トップページ＞  
<img src="https://github.com/MiyokoNakada/20240423_mockcase-entry/assets/159742835/d6da36ad-46e8-4b16-a396-ce5b46cd2688" width=70%>
<br>

## URL
- URL：http://3.27.233.206/
  （上記URLでログイン後にトップページに遷移します)
- 開発環境：http://localhost/
- phpMyAdmin:：http://localhost:8080/
<br>

## 関連するレポジトリ
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
- PHP8.2.12
- Laravel10.48.8
- MySQL8.0.36
<br>

## テーブル設計
<img src="https://github.com/MiyokoNakada/20240423_mockcase-entry/assets/159742835/efff9dad-3b70-4cba-8891-473204842f4a" width=60%> 
<br>

## ER図
![ER_Atte_tables](https://github.com/MiyokoNakada/20240423_mockcase-entry/assets/159742835/4b3eaeea-127c-437f-a2ed-e257277fb17d)
<br>


## 環境構築
### 開発環境のセットアップ


### 本番環境のセットアップ
#### 前提条件
- Docker
- Docker Compose

#### 手順
1. リポジトリをクローン：
   ```
   git clone git@github.com:MiyokoNakada/20240423_mockcase-entry.git
   ```
2. .env ファイルを作成し、必要な環境変数を設定：
  ```
  cp .env.example .env
  ```
3. .env ファイルを編集して以下の内容を追加・修正
  ```
  APP_ENV=local
  DB_HOST=mysql
  DB_DATABASE=your_local_db
  DB_USERNAME=root
  DB_PASSWORD=secret
  ```
4. それぞれのPCに合わせてdocker-compose.ymlファイル、を編集してください。
5. Docker コンテナをビルドして起動：
  ```
  docker-compose up -d --build
  ```

**Dockerビルド**
1. `git clone git@github.com:MiyokoNakada/20240423_mockcase-entry.git`
2. DockerDesktopアプリを立ち上げる
3. `docker-compose up -d --build`

  

**Laravel環境構築**
1. `docker-compose exec php bash`
2. `composer install`
3. 「.env.example」ファイルを 「.env」ファイルに命名を変更。または、新しく.envファイルを作成
4. .envに以下の環境変数を追加
``` text
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=laravel_db
DB_USERNAME=laravel_user
DB_PASSWORD=laravel_pass
```
5. アプリケーションキーの作成
``` bash
php artisan key:generate
```

6. マイグレーションの実行
``` bash
php artisan migrate
```

7. シーディングの実行
``` bash
php artisan migrate
```

