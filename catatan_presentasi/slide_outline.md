# Outline Presentasi: Analisis ERD dan Kebutuhan Sistem Hotel 404 Not Found

Gunakan outline ini sebagai acuan saat membuat slide PowerPoint atau Canva, dan sebagai panduan berbicara saat presentasi.

---

## Slide 1: Judul Presentasi
* **Judul Slide**: Pengembangan Sistem Informasi Manajemen Hotel "Hotel 404 Not Found" Berbasis Web.
* **Sub-Judul**: Analisis Kebutuhan Sistem, Perancangan Database (ERD), dan Implementasi Relasi Model.
* **Poin Pembicaraan**: 
  > *"Halo semuanya, hari ini kami akan mempresentasikan hasil analisis kebutuhan dan perancangan database (ERD) untuk sistem manajemen kamar dan transaksi pada Hotel 404 Not Found."*

---

## Slide 2: Latar Belakang Masalah
* **Judul Slide**: Mengapa Sistem ini Dibutuhkan?
* **Poin Utama**:
  * Pencatatan check-in tamu yang masih manual berisiko terjadi tumpang tindih kamar (*double booking*).
  * Sulitnya memantau riwayat pembayaran sewa kamar secara real-time.
  * Rekapitulasi laporan pendapatan bulanan membutuhkan waktu lama bagi owner hotel.
* **Poin Pembicaraan**:
  > *"Masalah utama yang kami selesaikan adalah efisiensi operasional hotel. Dengan sistem digital ini, pengelolaan kamar, tamu, dan transaksi pembayaran terintegrasi secara otomatis."*

---

## Slide 3: Kebutuhan Sistem (System Requirements)
* **Judul Slide**: Spesifikasi & Fitur Fungsional
* **Poin Utama**:
  * **Manajemen Kamar**: Kamar dikelompokkan berdasarkan nomor, tipe (AC/non-AC/Deluxe), harga, dan status (`Tersedia`, `Terisi`, `Pemeliharaan`).
  * **Manajemen Tamu**: Mencatat identitas tamu aktif dan riwayat check-in tamu.
  * **Transaksi Pembayaran**: Pembayaran sewa kamar dengan status `Lunas`, `Pending`, atau `Gagal`.
  * **Multi-Role User**: Pemisahan hak akses antara Admin (Input data), Staff (Pelayanan check-in), dan Owner (Melihat laporan keuangan).

---

## Slide 4: Perancangan Database (ERD)
* **Judul Slide**: Entity Relationship Diagram (ERD)
* **Poin Utama (Relasi)**:
  * **Tabel Kamar ➔ Tamu (One-to-Many)**: Satu kamar dapat disewa oleh banyak tamu (berurutan dari waktu ke waktu), namun satu tamu aktif hanya menempati satu kamar.
  * **Tabel Tamu ➔ Pembayaran (One-to-Many)**: Satu tamu dapat memiliki beberapa transaksi pembayaran (DP awal & pelunasan).
* **Poin Pembicaraan**:
  > *"Kunci dari database kami ada pada integritas data. Setiap tamu terhubung langsung dengan kamarnya melalui foreign key `kamars_id`, dan transaksi pembayaran mereferensikan tamu tersebut melalui `penyewas_id`."*

---

## Slide 5: Teknologi dan Implementasi
* **Judul Slide**: Stack Teknologi
* **Poin Utama**:
  * **Backend**: Laravel 11 (PHP) dengan arsitektur MVC (Model-View-Controller).
  * **Database**: SQLite (Ringan, cepat, dan handal untuk skala menengah).
  * **Frontend**: AdminLTE / SB Admin 2 dengan Vanilla CSS untuk tampilan dashboard premium yang responsif.
  * **Local Environment**: Laragon Web Server.

---

## Slide 6: Penutup & Tanya Jawab
* **Judul Slide**: Kesimpulan & Q&A
* **Poin Utama**:
  * Sistem mempermudah alur kerja resepsionis hotel dan meminimalisir kesalahan pencatatan transaksi keuangan.
  * Memungkinkan pengambilan keputusan bisnis yang lebih cepat bagi owner melalui grafik laporan otomatis.
* **Poin Pembicaraan**:
  > *"Demikian presentasi dari kami, sekarang kami membuka sesi tanya jawab bagi teman-teman atau dosen yang ingin bertanya."*
