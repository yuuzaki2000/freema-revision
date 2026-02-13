# freema-revision
[Dockerビルド]
1. git clone git@github.com:yuuzaki2000/freema.git
2. docker-compose up -d --build

[Laravel環境構築]
1. docker-compose exec php bash
2. composer install
3. 新たに、srcディレクトリ下に、.envファイルを作成し、.env.exampleファイルの内容をコピーする
4. .envファイルに以下の環境変数を追加
  DB_CONNECTION=mysql
  DB_HOST=mysql
　DB_PORT=3306
  DB_DATABASE=laravel_db
  DB_USERNAME=laravel_user
  DB_PASSWORD=laravel_pass
5. アプリケーションキーを作成する
  php aritsan key:generate
6. マイグレーションを実行する
  php artisan migrate:
7. シーディングを実行する
  php artisan db:seed
8. chmod -R 777 ./storage
9. chmod 777 bootstrap/cache -R

[実行環境]
MySQL 8.0.26
PHP 7.4.9-fpm
Laravel 8
nginx 1.21.1

[mailtrapの設定]
mailtrapのメールボックスを作成し、
.env内の下記※と※の間の部分を、自分のmailtrapの設定に書き換える


※
MAIL_MAILER=smtp
MAIL_HOST=sandbox.smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=(自分のusername)
MAIL_PASSWORD=(自分のpassword)
MAIL_ENCRYPTION=tls
※
MAIL_FROM_ADDRESS=from@example.com
MAIL_FROM_NAME="${APP_NAME}"

.envに下記の変数を追加（Secret KeyやPublic Keyは、stripeのホームページから自分のものをコピー）

STRIPE_SK = (test用のSecret Key)

STRIPE_PK = （test用のPublic Key）

[stripeの決済画面でのデモ入力]
下記を入力して試してください。
カード番号：4242 4242 4242 4242
期限：　12/34
セキュリティ番号：567
名前：Zhang San
国籍：United States
パスワード：12345

E-R図<img width="1181" height="1122" alt="er drawio" src="https://github.com/user-attachments/assets/d9e6dd5b-d8aa-490a-a83f-59464e526775" />


# freema-revision
# freema-revision
