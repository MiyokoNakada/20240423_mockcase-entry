# Atte

## 環境構築
**Dockerビルド**
1. `git clone git@github.com:MiyokoNakada/20240423_mockcase-entry.git`
2. DockerDesktopアプリを立ち上げる
3. `docker-compose up -d --build`

  ※MySQLはOSによって起動しない場合があるので、それぞれのPCに合わせてdocker-compose.ymlファイルを編集してください。

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

## 使用技術(実行環境)
- PHP8.2.12
- Laravel10.48.8
- MySQL8.0.36

## ER図
![ER_Atte_tables](https://github.com/MiyokoNakada/20240423_mockcase-entry/assets/159742835/4b3eaeea-127c-437f-a2ed-e257277fb17d)


## URL
- 開発環境：http://localhost/
- phpMyAdmin:：http://localhost:8080/



