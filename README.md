# Mini App Klasemen FootBall

Mini App Klasemen dideploy menggunakan framework Laravel, MySQL, JQuery, dan TailwindCSS

Fitur:
- Halaman Klasemen untuk melihat point klub
- Halaman Klub berfungsi untuk melihat list klub dan dapat menambahkan klub baru beserta validasi
- Halaman Match berfungsi untuk mengupdate papan klasemen beserta dengan validasi multi array

## Installasi
- Download pada github .zip atau dengan git clone
- setelah terdownload, buka direkotri menggunakan terminal/cmd atau IDE
- buat file baru pada root direktori atau sejajar dengan file .env.example, buat file dengan nama .env
- bula file .env.exmaple , copy semua dan pastekan pada file .env
- ketikan composer install pada terminal, pastikan tertuju pada direktori app klasemen
- setelah selesai ketik php artisan key:generate
- buat database, dan buka file .env dan ubah isi DB_DATABASE dengan nama database yang dibuat
- ketik php artisan migrate
- terkahir ketik php artisan serve
- selamat mencoba
