## Nama Kelompok = 

- Dwi Ramdhona - A11.2022.14033
- Stefanus Panji Sulistyo - A11.2022.14520
- Dafa Sultan Atalariq - A11.2022.14016


## Inventory

## Tentang Aplikasi
Aplikasi ini merupakan sistem manajemen inventory yang dikembangkan untuk mempermudah pemantauan dan pengelolaan stok barang dalam suatu perusahaan atau bisnis. Dibangun menggunakan teknologi framework Laravel, aplikasi ini dirancang agar pengguna dapat melakukan pencatatan, pemantauan, serta pembaruan data inventory secara efisien dan akurat. Tujuan utama aplikasi ini adalah untuk membantu perusahaan dalam mengoptimalkan pengelolaan stok, mengurangi kesalahan pencatatan, dan meningkatkan visibilitas atas status persediaan barang.

## Cara Menjalankan Aplikasi Menggunakan Docker Compose
Persiapan Docker dan Docker Compose
Pastikan Docker dan Docker Compose sudah terpasang di sistem Anda. Jika belum, ikuti panduan instalasi di Docker dan Docker Compose.

## Clone Repository
Lakukan clone repository ke sistem lokal Anda dengan perintah berikut:

## Copy code
git clone https://github.com/dafasultan/utssisiserver
cd utssisiserver

## Menjalankan Docker Compose
Di direktori utama repository, jalankan perintah ini untuk memulai seluruh layanan yang telah dikonfigurasi dalam docker-compose.yml:

## Copy code
docker-compose up -d
Opsi -d digunakan untuk menjalankan layanan di latar belakang.

## Akses Aplikasi
Setelah semua container berjalan, aplikasi dapat diakses melalui browser pada http://localhost:<port_anda>. Gantilah <port_anda> dengan port yang telah Anda tetapkan di file Docker Compose.

## Menghentikan Layanan
Untuk menghentikan seluruh layanan, gunakan perintah berikut:
Copy code
docker-compose down
