<h1 align="center">Hi 👋 Fruit EC site</h1>
<h3 align="center">マルチログイン機能を持ったECサイトです</h3>

- 👨‍💻 機能一覧 ログイン機能・新規登録機能・購入機能・出品機能


<p align="left">
</p>

<h3 align="left">今回使った技術:Laravel,HTML,Tailwindcss,MySQL</h3>
<p align="left"> <a href="https://www.w3.org/html/" target="_blank" rel="noreferrer"> <img src="https://raw.githubusercontent.com/devicons/devicon/master/icons/html5/html5-original-wordmark.svg" alt="html5" width="40" height="40"/> </a> <a href="https://laravel.com/" target="_blank" rel="noreferrer"> <img src="https://raw.githubusercontent.com/devicons/devicon/master/icons/laravel/laravel-plain-wordmark.svg" alt="laravel" width="40" height="40"/> </a> <a href="https://www.mysql.com/" target="_blank" rel="noreferrer"> <img src="https://raw.githubusercontent.com/devicons/devicon/master/icons/mysql/mysql-original-wordmark.svg" alt="mysql" width="40" height="40"/> </a> <a href="https://tailwindcss.com/" target="_blank" rel="noreferrer"> <img src="https://www.vectorlogo.zone/logos/tailwindcss/tailwindcss-icon.svg" alt="tailwind" width="40" height="40"/> </a> </p>


## Laravel
## ダウンロード方法
git clone
git clone https://github.com/shinshin0773/laravel_umarche.git

##　インストール方法 テスト



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
