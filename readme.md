1. Buka powershell buka sebagai administrator, lalu run ini

`# Run as administrator...
Set-ExecutionPolicy Bypass -Scope Process -Force; [System.Net.ServicePointManager]::SecurityProtocol = [System.Net.ServicePointManager]::SecurityProtocol -bor 3072; iex ((New-Object System.Net.WebClient).DownloadString('https://php.new/install/windows/8.4'))`

2. Tunggu sampai selesai, lalu buka folder www di laragon (defaultnya C:\laragon\www, pakai laragon v6)
3. Abis buka folder nya di file explorer klik kanan lalu pilih opsi Open in Terminal
4. Lalu clone repo nya `git clone https://github.com/marxiyha/simpeg-dinkes-provkalbar.git` (pastikan sudah selesai install dan setup git)
5. Setelah selesai di clone buka folder nya melalui VSCode atau IDE yang digunakan sekarang
6. Copy file `.env.example` lalu paste di folder yang sama
7. Rename file yang udah dipaste tadi jadi `.env`
8. Buka file tersebut lalu di bagian ini ubah seperti ini

`
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=simpeg-dinkes-provkalbar
DB_USERNAME=root
DB_PASSWORD=
`

9. Setelah diubah save lalu buka command prompt (path command prompt nya harus sesuai path folder proyek nya) copy paste command-command ini (tunggu selesai proses download dan install nya baru lanjut ke command berikut)

`npm install` (pastikan udh terinstall node.js, kalau bisa gunakan nvm untuk manajemen versi node gunakan versi 24.13.1)

`composer install`

`php artisan migrate`

10. Setelah berhasil semua jalankan `composer run dev` dan buka http://127.0.0.1:8000/ di browser
11. Bisa start development