# 飲食店予約サービス

飲食店予約サービスを作成しました。ホーム画面にて各店舗の詳細が閲覧出来ます。会員登録しログイン後、店舗の予約、お気に入り店舗の登録、レビューの記載が可能になります。

![ホーム画面](https://github.com/user-attachments/assets/e843607d-9ea0-4ffe-8539-eec6a5d37816)

## 作成した目的

## アプリケーションURL
  * 開発環境: http://localhost/
  * phpMyAdmin: http://localhost:8080/

## 機能一覧
会員登録、ログイン、ログアウト、検索(エリア、店名、ジャンル)、お気に入り店舗追加/削除、飲食店一覧/詳細表示、予約追加/変更/削除、レビュー閲覧、レビュー書き込み/変更・削除

## 使用技術
　　docker、Laravel 8.x、PHP 7.4、fortify、javascript

## テーブル設計
![usersテーブル](https://github.com/user-attachments/assets/d1e897c0-7395-4cf8-a198-a18154007e9c)
![shopsテーブル](https://github.com/user-attachments/assets/a27f906d-5494-4bc5-8e18-eeb804c0a28a)
![areasテーブル](https://github.com/user-attachments/assets/ec0728a6-70b7-4be0-a2ac-278686cf6efb)
![genresテーブル](https://github.com/user-attachments/assets/1246f4f9-a094-43a5-b06c-66aa203172da)
![reservesテーブル](https://github.com/user-attachments/assets/130ccaa8-2506-4f1a-8bec-9a44dcbd46b7)
![favoritesテーブル](https://github.com/user-attachments/assets/18bff1db-f3c5-4c8c-af73-5cb59b7b80a4)
![reviewsテーブル](https://github.com/user-attachments/assets/a5d841ab-4f4c-4594-85f3-52db3bfb7543)

## ER図
![ER図](https://github.com/user-attachments/assets/ed6b267f-d593-455e-a85e-f4f29d236971)

## 環境構築
**Dockerビルド**
1. `git clone git@github.com:maenakarino/rese.git`
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
php artisan db:seed
```
* アクセスした際にPermission deniedというエラーが発生した場合、下記のコマンドを実行し、再度アプリケーションを立ち上げる。
```
$ sudo chmod -R 777 src/*
```

## アカウントの種類
・テストユーザー　　　email: test@gmail.com 、  password: 12345678

