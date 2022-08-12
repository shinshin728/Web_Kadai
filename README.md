## Laravel
## ダウンロード方法
git clone
git clone https://github.com/shinshin0773/laravel_umarche.git

##　インストール方法



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
