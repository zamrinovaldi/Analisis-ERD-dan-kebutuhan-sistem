# Skenario Demo Aplikasi: Presentasi Hotel 404 Not Found

Gunakan panduan langkah-demi-langkah ini saat Anda melakukan demo aplikasi di depan audiens atau dosen.

---

## Persiapan Sebelum Demo (Setup)
1. Buka browser pada alamat: **[http://analisis-erd-dan-kebutuhan-sistem.test](http://analisis-erd-dan-kebutuhan-sistem.test)**.
2. Pastikan Anda berada di halaman Login.

---

## Langkah 1: Login Sebagai Admin (Hak Akses Penuh)
* **Tindakan**: 
  1. Masukkan Email: `admin@admin.com`
  2. Masukkan Password: `password`
  3. Klik tombol **Login**.
* **Penjelasan untuk Audiens**:
  > *"Pertama, saya login sebagai Admin. Role Admin memiliki otoritas penuh untuk mengelola semua data master seperti Kamar, Tamu, dan Transaksi."*

---

## Langkah 2: Simulasi Kelola Kamar Hotel
* **Tindakan**:
  1. Klik menu **Data Kamar** di sidebar kiri.
  2. Klik tombol **Tambah Kamar**.
  3. Masukkan data contoh:
     * Nomor Kamar: `105`
     * Tipe Kamar: `Deluxe Suite`
     * Harga: `450000`
     * Status: `Tersedia`
  4. Klik **Simpan**.
* **Penjelasan untuk Audiens**:
  > *"Di sini kita dapat melihat daftar seluruh kamar beserta tipenya. Kamar baru dengan nomor 105 telah berhasil kita tambahkan dengan status awal 'Tersedia'."*

---

## Langkah 3: Simulasi Check-in Tamu Baru (Relasi Kamar ➔ Tamu)
* **Tindakan**:
  1. Klik menu **Data Tamu** (atau Penyewa) di sidebar.
  2. Klik **Tambah Tamu**.
  3. Isi formulir:
     * Nama: `Budi Santoso`
     * Nomor HP: `08123456789`
     * Email: `budi@gmail.com`
     * Pekerjaan: `Karyawan Swasta`
     * Pilih Kamar: `105 - Deluxe Suite (Rp 450.000)`
     * Tanggal Masuk: Pilih tanggal hari ini.
  4. Klik **Simpan**.
* **Penjelasan untuk Audiens**:
  > *"Sekarang kita simulasikan Tamu baru bernama Budi Santoso melakukan check-in dan memesan kamar 105 yang baru kita buat tadi. Di balik layar, database akan menghubungkan ID Budi ke ID Kamar 105."*

---

## Langkah 4: Pencatatan Transaksi Pembayaran (Relasi Tamu ➔ Pembayaran)
* **Tindakan**:
  1. Klik menu **Transaksi Pembayaran** di sidebar.
  2. Klik **Tambah Pembayaran**.
  3. Isi data pembayaran:
     * Pilih Tamu: `Budi Santoso`
     * Tanggal Bayar: Pilih tanggal hari ini.
     * Jumlah: `450000` (atau sesuai harga kamar)
     * Metode Pembayaran: `Transfer`
     * Status: `Lunas`
     * Keterangan: `Pembayaran malam pertama`
  4. Klik **Simpan**.
* **Penjelasan untuk Audiens**:
  > *"Setelah check-in, tamu membayar biaya sewa kamarnya. Kita buat transaksi pembayaran baru atas nama Budi Santoso dengan status Lunas. Transaksi ini terikat langsung ke data tamu bersangkutan."*

---

## Langkah 5: Logout & Login Sebagai Owner (Melihat Laporan Keuangan)
* **Tindakan**:
  1. Klik foto profil di kanan atas, lalu klik **Logout**.
  2. Login kembali menggunakan akun Owner:
     * Email: `owner@admin.com`
     * Password: `password`
  3. Buka menu **Laporan Keuangan**.
* **Penjelasan untuk Audiens**:
  > *"Terakhir, saya logout dan masuk sebagai Owner. Seperti yang Anda lihat, Owner memiliki tampilan dashboard yang memfokuskan pada grafik pendapatan keuangan. Transaksi lunas dari tamu Budi tadi otomatis terekap ke dalam laporan bulanan tanpa perlu input manual lagi."*
