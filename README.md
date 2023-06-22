# Aplikasi Travel App

Travel App adalah sebuah aplikasi yang dirancang untuk memudahkan pengguna dalam merencanakan perjalanan mereka. Aplikasi ini memiliki beberapa fitur utama, termasuk pengelolaan lokasi, harga perjalanan, pemesanan transportasi, informasi pengguna, dan merek transportasi. Berikut adalah deskripsi tentang setiap komponen aplikasi tersebut:

Terdapat dua jenis pengguna dalam aplikasi ini:

```bash
Admin: Pengguna dengan hak akses untuk mengontrol sistem aplikasi TravelApp.

Hak Akses
    - Lokasi (CRUD)
    - Harga (CRUD)
    - Merek Kendaraan (CRUD)
    - Kendaraan (CRUD)
    - Order Travel (RD)
```

```bash
User: Pengguna yang akan melakukan pemesanan travel melalui aplikasi.

Hak Akses
    - Harga (R)
    - Kendaraan (R)
    - Order Travel (CRD)
    - Order History (R)
```

# Data

Berikut adalah daftar username dan password untuk mengakses aplikasi:

    Admin:
        Username: admin
        Password: password

    User1:
        Username: user1
        Password: password

    User2:
        Username: user2
        Password: password

Note\* : user juga bisa melakukan register

# Dependency

Untuk menjalankan aplikasi ini, pastikan sistem memenuhi kebutuhan berikut:

    PHP versi >= ^8.0
    Composer >= ^2.0
    Laravel Framework versi 10

# Running Project

Clone repository dahulu

Buka terminal atau command prompt, lalu navigasikan ke direktori proyek Laravel Anda menggunakan perintah cd.

```bash
cd [nama_folder]
```

Jalankan perintah composer install untuk menginstal semua dependensi proyek Laravel. Pastikan Anda memiliki file composer.json di direktori proyek.

```bash
composer install
```

Buat file `.env` dari file `.env.example` dengan perintah

```bash
cp .env.example .env
```

di sistem operasi Linux/Unix atau di sistem operasi Windows.

```bash
copy .env.example .env
```

Generate kunci aplikasi dengan perintah

```bash
php artisan key:generate
```

Pastikan pengaturan koneksi database di file .env sesuai dengan konfigurasi database Anda.

Jalankan migrasi database dengan perintah php artisan migrate untuk membuat tabel-tabel yang diperlukan di database.

```bash
php artisan migrate --seed
```

Jalankan server pengembangan lokal dengan perintah

```bash
php artisan serve
```

Buka browser dan akses http://localhost:8000 atau sesuai dengan URL yang ditampilkan di terminal.

Aplikasi dapat dijalankan secara normal

# Testing Application

Aplikasi ini menyediakan dashboard yang menampilkan total data dari berbagai tabel. Untuk user dan admin tampilan tabel nya sama, hanya saja dibagian sidebar dibedakan karena adanya settingan middlaware

Berikut adalah panduan penggunaan untuk aplikasi TravelApp:

```bash
Admin
```

<ul>
    <li>Masukkan username dan password yang valid untuk masuk ke aplikasi.</li>
    <li>
        Setelah login, admin dapat menginputkan mengecek dashboard, admin juga dapat melihat data dependency dari berbagai tabel
    </li>
    <li>Terdapat fitur soft delete, jadi ketika admin tidak sengaja menghapus data. Admin dapat merestore data yang dihapus tersebut pada sidebar kategori <u> Data Sampah </u></li>
    <li>Ada juga fitur search untuk mempermudah dalam pencarian data disetiap tabelnya</li>
    <li>Testing bisa dimulai dengan menambahkan data di tabel mobil dengan menklik data tabel dan cari <u> Data Kendaraan</u>, dengan menginputkan data yang diminta form lalu melakukan submit.</li>
    <li>Dapat dilihat data input berhasil ditambahkan. Kemudian coba untuk mengedit data tersebut, jika sudah tekan submit, kemudian coba untuk mendelete data tersebut. Dan admin bisa mengeceknya pada data sampah di sidebar <u> Data Sampah </u></li>
</ul>

```bash
User
```

<ul>
    <li>Masukkan username dan password yang valid untuk masuk ke aplikasi atau bisa melakukan register dengan menginputkan data yang valid, kemudian login terhadap sistem.</li>
    <li>
        Setelah login, user dapat menginputkan mengecek dashboard, user juga dapat melihat list daftar kendaraan, daftar rute perjalanan, dan data order serta history
    </li>
    <li>Testing bisa dimulai dengan melakukan booking travel terlebih dahulu yaitu dengan menklik data order lalu klik tombol buat pesanan</li>
    <li>User kemudian dapat mengisi form sesuai ketentuan yang ditampilkan, adapun syarat dari pengisian form diantaranya : 
        <ol>
            <li>Untuk Tanggal Keberangkatan minimal adalah tanggal keesokan harinya (sudah di set otomatis, tetapi user bisa memilih)</li>
            <li>Total penumpang tidak boleh melebihi kapasitas mobil travel</li>
            <li>Lokasi keberangkatan dan lokasi tujuan tidak boleh sama</li>
        </ol>
        Jika syarat dari pengisian form tersebut tidak terpenuhi maka akan ada validasi error dari sistem, dan user harus mengisikan data yang sesuai dengan requirement sistem
    </li>
    <li>Jika dirasa user ingin membatalkan pesanan order tersebut, maka user bisa menjadi datanya di tabel order, lalu klik tombol detail dan klik tombol batalkan pesanan, maka user sudah selesai membatalkan pesanan</u></li>
    <li>Untuk tabel history order akan otomatis terisi jika data order, lebih tepatnya tanggal keberangkatan pada data order telah melewati hari dimana sistem berjalan (hari sekarang), maka status dari order akan secara otomatis menjadi finish yang berarti data dari tabel order akan secara otomatis dipindahkan ke tabel history order</li>
    <li>Tidak ada fitur edit/update untuk order ini karena kebanyakan aplikasi order juga tidak menerapkan edit/update disistem nya</li>
</ul>

Catatan: Pastikan untuk menggantikan sesuaikan versi dependecies agar bisa menjalankan aplikasi tersebut.
