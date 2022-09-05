<h1 align="center">Hi 👋 Fruit EC site</h1>
<h3 align="center">マルチログイン機能を持ったECサイトです</h3>

- 👨‍💻 機能一覧 ログイン機能・新規登録機能・購入機能・出品機能


<p align="left">
</p>

<h3 align="left">今回使った技術:Laravel,HTML,Tailwindcss,MySQL</h3>
<p align="left"> <a href="https://www.w3.org/html/" target="_blank" rel="noreferrer"> <img src="https://raw.githubusercontent.com/devicons/devicon/master/icons/html5/html5-original-wordmark.svg" alt="html5" width="40" height="40"/> </a> <a href="https://laravel.com/" target="_blank" rel="noreferrer"> <img src="https://raw.githubusercontent.com/devicons/devicon/master/icons/laravel/laravel-plain-wordmark.svg" alt="laravel" width="40" height="40"/> </a> <a href="https://www.mysql.com/" target="_blank" rel="noreferrer"> <img src="https://raw.githubusercontent.com/devicons/devicon/master/icons/mysql/mysql-original-wordmark.svg" alt="mysql" width="40" height="40"/> </a> <a href="https://tailwindcss.com/" target="_blank" rel="noreferrer"> <img src="https://www.vectorlogo.zone/logos/tailwindcss/tailwindcss-icon.svg" alt="tailwind" width="40" height="40"/> </a> </p>


## Laravel
## ダウンロード方法
git clone https://github.com/shinshin728/Web_Kadai.git

##　インストール方法 テスト
composer install
npm install
npm run dev

envファイルの中の下記をご利用の環境に合わせて変更してください。
.env.example をコピーして .env ファイルを作成

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=****
DB_USERNAME=****
DB_PASSWORD=****

XAMPP/MAMPまたは他の開発環境でDBを起動した後に

php artisan migrate:fresh --seed

と実行してください。(データベーステーブルとダミーデータが追加されればOK)

最後に
php artisan key:generate
と入力してキーを生成後、

php artisan serve
で簡易サーバーを立ち上げ、表示確認してください。


##　インストール後の実装事項

画像のダミーデータは
public/imagesフォルダ内に
sample1.jpg ~ sample6.jpg　として保存しています。

php artisan storage:link　で
storageフォルダにリンク後、

storage/app/public/productsフォルダ内に保存すると表示されます

ショップの画像も表示する場合は、
storage/app/public/shopsフォルダを作成し
画像を保存してください


決済のテストとしてStripeを使用しております
必要な場合は.envに stripeの情報を追記してください。

メール処理には時間がかかるのでキューをしよ空いています

必要な場合は php artisan queue.work で
ワーカーを立ち上げて動作確認するようにしてください。
