# Mini-LMS: Service Registry & Gateway (PHP)

Prototipe sistem **Service Registry dan API Gateway** yang dikembangkan sebagai bagian dari arsitektur _Microservices_ pada sistem Mini-LMS (_Learning Management System_). Sistem ini dibangun menggunakan PHP untuk mengelola pemetaan tujuh layanan logis dan meneruskan (_proxy_) permintaan klien ke layanan tujuan secara dinamis tanpa perlu mengubah kode klien ketika alamat layanan berubah.

Service Registry berfungsi untuk menyimpan dan menyediakan informasi alamat layanan, sedangkan API Gateway menjadi pintu masuk permintaan dari klien sebelum diteruskan ke layanan yang sesuai.

## 👥 Anggota Kelompok dan Pembagian Tugas

Berikut adalah anggota kelompok beserta tugas dan kontribusi masing-masing dalam pengembangan proyek.

| No. | Nama Anggota            | NIM          | Tugas dan Tanggung Jawab                                                                                 |
| --- | ----------------------- | ------------ | -------------------------------------------------------------------------------------------------------- |
| 1   | Muh. Dimas Januardi Nur | 230209501007 | Melakukan pengujian sistem berdasarkan skenario yang telah ditentukan serta menyusun dokumentasi proyek. |
| 2   | Andini Sri Rahayu       | 230209501026 | Mengimplementasikan endpoint GET untuk pengambilan metadata serta merancang struktur folder proyek.      |
| 3   | Muh. Ridzwan            | 240209501095 | Merancang kontrak API dan mengimplementasikan endpoint POST untuk proses upload.                         |
| 4   | Faqih Ahmad             | 240209501111 | Mengimplementasikan validasi input, menangani error, serta melakukan pengujian integrasi API.            |

## ⚙️ Prasyarat Sistem

Sebelum menjalankan aplikasi, pastikan komputer telah memiliki perangkat lunak berikut:

- **PHP 7.4 atau lebih baru**, dengan ekstensi `cURL` aktif.
- **Git**, jika ingin mendapatkan source code menggunakan metode Git Clone.
- **Postman** atau alat pengujian API sejenis.
- **Web browser** untuk memeriksa akses server lokal jika diperlukan.

### Memeriksa Instalasi PHP

Buka terminal atau PowerShell, kemudian jalankan:

```bash
php -v
```

### Memeriksa Instalasi Git

```bash
git --version
```

### Memeriksa Ekstensi cURL

Jalankan perintah:

```bash
php -m
```

Pastikan `curl` muncul dalam daftar ekstensi yang aktif. Jika belum muncul, aktifkan ekstensi tersebut pada konfigurasi `php.ini`, kemudian mulai ulang terminal atau server PHP.

Jika PHP atau Git belum tersedia, instal melalui situs resminya:

- PHP: https://www.php.net/downloads.php
- Git: https://git-scm.com/downloads
- Postman: https://www.postman.com/downloads/

## 📥 Cara Mendapatkan Proyek

Source code dapat diperoleh melalui dua metode, yaitu Git Clone dan mengunduh file ZIP. Pilih salah satu metode berikut.

### Cara 1: Menggunakan Git Clone

Metode ini cocok bagi pengguna yang ingin mengunduh proyek sekaligus menyimpan riwayat Git untuk pengelolaan perubahan kode.

**Langkah 1 — Buka repository GitHub**

Kunjungi repository proyek:

`https://github.com/Rizz-xx/mini-lms-registry-php`

Pastikan alamat tersebut sesuai dengan repository yang berisi source code Service Registry dan Gateway versi PHP.

**Langkah 2 — Buka terminal atau PowerShell**

Tentukan lokasi untuk menyimpan proyek. Contohnya, jika proyek akan disimpan di drive D:

```powershell
cd D:\
```

**Langkah 3 — Clone repository**

Jalankan perintah berikut:

```bash
git clone https://github.com/Rizz-xx/mini-lms-registry-php.git
```

Tunggu hingga proses pengunduhan selesai.

**Langkah 4 — Masuk ke direktori proyek**

```bash
cd mini-lms-registry-php
```

**Langkah 5 — Periksa isi direktori**

```powershell
dir
```

Pastikan file berikut tersedia:

- `services.json`
- `registry.php`
- `gateway.php`

Nama file dan struktur direktori harus disesuaikan dengan implementasi proyek yang sebenarnya.

### Cara 2: Mengunduh Proyek dalam Format ZIP

Metode ini cocok bagi pengguna yang ingin mendapatkan source code tanpa harus menggunakan perintah Git.

**Langkah 1 — Buka repository GitHub**

Kunjungi:

`https://github.com/Rizz-xx/mini-lms-registry-php`

**Langkah 2 — Unduh source code**

1. Klik tombol **Code** pada halaman repository.
2. Pilih **Download ZIP**.
3. Tunggu hingga proses pengunduhan selesai.

**Langkah 3 — Ekstrak file ZIP**

1. Buka folder tempat file ZIP tersimpan.
2. Klik kanan file ZIP.
3. Pilih **Extract All...**.
4. Tentukan lokasi penyimpanan, kemudian selesaikan proses ekstraksi.

**Langkah 4 — Buka folder proyek**

Masuk ke direktori hasil ekstraksi. Nama folder biasanya mengikuti nama repository dan dapat memiliki tambahan seperti `-main`.

Contoh:

```powershell
cd D:\mini-lms-registry-php-main
```

Sesuaikan lokasi tersebut dengan folder hasil ekstraksi pada komputer masing-masing.

**Langkah 5 — Periksa file proyek**

```powershell
dir
```

Pastikan `services.json`, `registry.php`, dan `gateway.php` tersedia sebelum melanjutkan ke tahap berikutnya.

> **Perbedaan kedua metode:** Git Clone menyertakan riwayat Git sehingga perubahan kode dapat dikelola dan dikirim kembali ke repository. ZIP hanya berisi salinan file proyek tanpa riwayat Git.

## 📂 Struktur Berkas Proyek

Proyek ini menggunakan tiga berkas utama yang memiliki fungsi berbeda.

```text
mini-lms-registry-php/
├── services.json
├── registry.php
├── gateway.php
└── README.md
```

Penjelasan setiap berkas:

| Berkas          | Fungsi                                                                                                                  |
| --------------- | ----------------------------------------------------------------------------------------------------------------------- |
| `services.json` | Menyimpan konfigurasi layanan logis beserta alamat dasar (_base URL_) dan port masing-masing.                           |
| `registry.php`  | Menyediakan endpoint untuk mencari alamat layanan berdasarkan nama logis yang terdaftar.                                |
| `gateway.php`   | Menerima permintaan klien, melakukan lookup ke Registry, lalu meneruskan permintaan ke layanan tujuan menggunakan cURL. |
| `README.md`     | Berisi dokumentasi instalasi, konfigurasi, dan pengujian sistem.                                                        |

Struktur di atas merupakan gambaran umum. Berkas tambahan dapat digunakan jika memang diperlukan oleh implementasi aplikasi.

## 🧠 Konsep dan Cara Kerja Sistem

### 1. Service Registry

Service Registry berfungsi sebagai tempat penyimpanan informasi alamat layanan. Setiap layanan memiliki nama logis yang digunakan untuk menemukan alamat layanan tersebut.

Contohnya, klien cukup menggunakan nama `submission-service` untuk menemukan alamat layanan Submission Service tanpa harus menentukan alamat dan portnya secara langsung.

### 2. API Gateway

API Gateway berfungsi sebagai perantara antara klien dan layanan tujuan. Gateway menerima permintaan, mencari alamat layanan melalui Registry, kemudian meneruskan permintaan menggunakan cURL.

Gateway juga meneruskan respons dari layanan tujuan kepada klien sesuai implementasinya.

### 3. Pemetaan Tujuh Layanan Logis

File `services.json` digunakan untuk menyimpan pemetaan tujuh layanan logis yang dikelola oleh Registry.

Setiap entri layanan sebaiknya memuat nama logis dan alamat dasar layanan, termasuk port yang digunakan.

Nama ketujuh layanan, alamat, dan portnya mengikuti konfigurasi aktual di `services.json`.

## 🚀 Panduan Instalasi dan Menjalankan Program

Sistem ini melibatkan Service Registry, API Gateway, dan layanan tujuan yang dapat berjalan pada port berbeda. Untuk pengujian, jalankan server Registry/Gateway dan server layanan tujuan pada terminal terpisah.

### 1. Buka Direktori Proyek

Pastikan terminal berada di direktori utama `mini-lms-registry-php`, yaitu folder yang berisi `services.json`, `registry.php`, dan `gateway.php`.

Contoh:

```powershell
cd D:\mini-lms-registry-php
```

Sesuaikan lokasi direktori dengan hasil Git Clone atau ekstraksi ZIP.

### 2. Jalankan Registry dan Gateway

Buka **Terminal 1**, kemudian jalankan:

```bash
php -S localhost:8005
```

Server akan berjalan pada alamat:

`http://localhost:8005`

Biarkan terminal tetap terbuka selama pengujian.

**Catatan:** Perintah di atas menjalankan server bawaan PHP. Agar URL seperti `/registry.php/api/registry/submission-service` dapat diproses, pastikan routing yang digunakan memang mendukung format tersebut. Jika implementasi membutuhkan file router khusus, jalankan server menggunakan file router tersebut.

### 3. Jalankan Target Service

Buka **Terminal 2** dan masuk ke direktori proyek Submission Service.

Contoh:

```powershell
cd D:\mini-lms-submission-php
```

Jalankan server pada port `8000`:

```bash
php -S localhost:8000
```

Server Submission Service akan berjalan pada alamat:

`http://localhost:8000`

Pastikan Submission Service dapat diakses secara langsung dan endpoint upload-nya sudah berjalan sebelum melakukan pengujian melalui Gateway.

### 4. Pastikan Konfigurasi Alamat Layanan

Buka file `services.json` pada direktori Registry.

Pastikan entri `submission-service` mengarah ke alamat Submission Service yang benar, misalnya:

```json
{
  "submission-service": {
    "baseUrl": "http://localhost:8000"
  }
}
```

Contoh di atas hanya ilustrasi format konfigurasi. Gunakan struktur JSON yang sesuai dengan kode `registry.php` dan `gateway.php` yang sebenarnya.

Jika struktur konfigurasi aktual menggunakan properti berbeda, jangan menggantinya dengan contoh ini tanpa menyesuaikan implementasi PHP.

### 5. Pastikan Semua Server Aktif

Sebelum pengujian, periksa bahwa:

- Registry dan Gateway berjalan pada port `8005`.
- Submission Service berjalan pada port yang terdaftar di `services.json`.
- Ekstensi PHP cURL aktif.
- Endpoint Registry dan Gateway sesuai dengan mekanisme routing aplikasi.

## 📊 Diagram Alur Registry dan Gateway

Diagram berikut menggambarkan alur komunikasi antara klien, API Gateway, Service Registry, dan layanan tujuan.

```text
+-------------------+
|   Client /        |
|   Postman         |
+-------------------+
          |
          | 1. Mengirim request
          v
+-------------------+
|   API Gateway     |
|   gateway.php     |
+-------------------+
          |
          | 2. Lookup alamat layanan
          v
+-------------------+
|  Service Registry |
|   registry.php    |
|   services.json   |
+-------------------+
          |
          | 3. Mengembalikan alamat
          v
+-------------------+
|   API Gateway     |
+-------------------+
          |
          | 4. Proxy request via cURL
          v
+-------------------+
|   Target Service  |
|   Port 8000       |
+-------------------+
          |
          | 5. Mengembalikan respons
          v
+-------------------+
|   API Gateway     |
+-------------------+
          |
          | 6. Meneruskan respons
          v
+-------------------+
|   Client /        |
|   Postman         |
+-------------------+
```

Diagram tersebut menjelaskan alur konseptual. Detail komunikasi antara Registry dan Gateway mengikuti implementasi kode yang digunakan.

## 📄 Kontrak API (_API Endpoints_)

### 1. Registry Resolver — Mencari Alamat Layanan

Endpoint ini digunakan untuk mencari alamat layanan berdasarkan nama logis yang terdaftar di `services.json`.

- **Method:** `GET`
- **Contoh URL:**

```text
http://localhost:8005/registry.php/api/registry/submission-service
```

- **Parameter URL:** `submission-service`, yaitu nama logis layanan yang ingin dicari.

**Hasil yang diharapkan jika layanan ditemukan:**

Server mengembalikan informasi alamat dasar layanan dalam format JSON sesuai implementasi Registry.

**Hasil yang diharapkan jika layanan tidak ditemukan:**

Server mengembalikan status HTTP `404 Not Found` beserta pesan kesalahan yang menjelaskan bahwa nama layanan tidak terdaftar.

### 2. API Gateway — Meneruskan Permintaan

Gateway menerima permintaan klien, mencari alamat layanan melalui Registry, kemudian meneruskan permintaan tersebut ke endpoint layanan tujuan.

- **Method:** `POST`
- **Contoh URL:**

```text
http://localhost:8005/gateway.php/gateway/submissions
```

- **Content-Type:** `multipart/form-data`

Untuk pengujian Submission Service, sertakan parameter berikut pada bagian **Body → form-data** di Postman:

| Parameter      | Tipe | Keterangan                                   |
| -------------- | ---- | -------------------------------------------- |
| `assignmentId` | Text | ID tugas yang terdaftar, misalnya `asg-001`. |
| `studentId`    | Text | ID mahasiswa atau siswa pengunggah.          |
| `file`         | File | File tugas yang akan diunggah.               |

Gateway meneruskan permintaan ke endpoint Submission Service sesuai aturan routing yang diimplementasikan.

**Hasil yang diharapkan:**

Jika proses berhasil, Gateway meneruskan respons dari layanan tujuan kepada klien. Status yang diterima dapat berupa `201 Created` atau status sukses lain yang sesuai dengan implementasi layanan.

> URL Registry dan Gateway di atas mengikuti format endpoint yang direncanakan untuk proyek ini. Pastikan kode PHP benar-benar mendukung format URL tersebut. Jika routing berbeda, sesuaikan URL pengujian dengan implementasi aktual.

## 🧪 Panduan Pengujian (_Testing Guide_)

Pengujian dilakukan menggunakan Postman untuk memeriksa fungsi Registry, Gateway, penanganan error, dan kemampuan sistem menyesuaikan perubahan alamat layanan.

Sebelum memulai, pastikan server Registry/Gateway dan Submission Service sudah berjalan.

### Skenario 1: Nama Layanan Valid

**Tujuan:** Memastikan Registry dapat menemukan layanan yang terdaftar dan Gateway dapat meneruskan permintaan ke layanan tujuan.

**A. Menguji Registry secara langsung**

1. Buka Postman.
2. Pilih method `GET`.
3. Masukkan URL:

   `http://localhost:8005/registry.php/api/registry/submission-service`

4. Klik **Send**.

**Hasil yang diharapkan:**

- Layanan ditemukan di `services.json`.
- Server mengembalikan informasi alamat layanan sesuai implementasi Registry.

**B. Menguji Gateway**

1. Pilih method `POST`.
2. Masukkan URL:

   `http://localhost:8005/gateway.php/gateway/submissions`

3. Buka tab **Body**, kemudian pilih **form-data**.
4. Tambahkan parameter:
   - `assignmentId` — `asg-001` dengan tipe Text.
   - `studentId` — `MHS-12345` dengan tipe Text.
   - `file` — pilih file dari komputer dengan tipe File.
5. Klik **Send**.

**Hasil yang diharapkan:**

- Gateway menemukan alamat `submission-service`.
- Permintaan diteruskan ke Submission Service.
- Layanan memproses unggahan dan mengembalikan respons sesuai implementasi.

Ambil tangkapan layar hasil pengujian sebagai **Bukti 1**.

### Skenario 2: Nama Layanan Tidak Ditemukan

**Tujuan:** Memastikan Registry menangani permintaan untuk layanan yang tidak terdaftar.

1. Buka Postman.
2. Pilih method `GET`.
3. Masukkan URL:

   `http://localhost:8005/registry.php/api/registry/service-fiktif`

4. Klik **Send**.

**Hasil yang diharapkan:**

- Registry tidak menemukan `service-fiktif` di `services.json`.
- Server mengembalikan status HTTP `404 Not Found`.
- Respons berisi pesan kesalahan yang sesuai.

Ambil tangkapan layar hasil pengujian sebagai **Bukti 2**.

### Skenario 3: Perubahan Alamat atau Port Layanan

**Tujuan:** Membuktikan bahwa Gateway dapat mengikuti perubahan alamat layanan melalui Registry tanpa mengubah kode klien maupun kode Gateway.

**Langkah pengujian:**

1. Pastikan Submission Service awalnya berjalan pada port `8000`.
2. Buka file `services.json`.
3. Ubah alamat `submission-service` dari:

   `http://localhost:8000`

   menjadi:

   `http://localhost:8001`

4. Hentikan server Submission Service pada port `8000`.
5. Jalankan kembali Submission Service pada port `8001` melalui terminal proyek Submission Service:

   ```bash
   php -S localhost:8001
   ```

6. Pastikan Registry membaca konfigurasi terbaru. Jika konfigurasi dibaca setiap kali ada permintaan, perubahan dapat langsung digunakan. Jika konfigurasi disimpan dalam cache atau dimuat saat startup, lakukan penyesuaian atau mulai ulang server sesuai implementasi.
7. Kirim ulang permintaan melalui Gateway menggunakan URL yang sama seperti pada Skenario 1.

**Hasil yang diharapkan:**

- Gateway tetap menggunakan endpoint yang sama.
- Registry memberikan alamat baru dari `services.json`.
- Permintaan berhasil diteruskan ke Submission Service pada port `8001`.
- Tidak diperlukan perubahan pada kode klien atau `gateway.php`.

Ambil tangkapan layar hasil pengujian sebagai **Bukti 3**.

> **Catatan:** Skenario ini hanya berhasil jika Gateway benar-benar melakukan lookup alamat layanan secara dinamis dan tidak menggunakan alamat tujuan yang ditulis secara permanen di dalam kode.

## ⚠️ Penanganan Masalah Umum

### 1. Perintah `php` Tidak Dikenali

**Penyebab:** PHP belum terpasang atau lokasi executable PHP belum ditambahkan ke `PATH`.

**Solusi:** Instal PHP, tambahkan lokasinya ke `PATH`, lalu buka terminal baru dan jalankan `php -v`.

### 2. Ekstensi cURL Tidak Aktif

**Penyebab:** Ekstensi cURL belum diaktifkan pada konfigurasi PHP.

**Solusi:** Periksa `php.ini`, aktifkan ekstensi cURL sesuai instalasi PHP, kemudian periksa kembali menggunakan:

```bash
php -m
```

### 3. Registry Mengembalikan 404

**Penyebab yang mungkin:**

- Nama layanan tidak terdaftar di `services.json`.
- File konfigurasi tidak terbaca.
- Format URL tidak sesuai dengan routing aplikasi.

**Solusi:** Periksa nama layanan, format JSON, serta implementasi routing pada `registry.php`.

### 4. Gateway Tidak Dapat Terhubung ke Layanan Tujuan

**Penyebab yang mungkin:**

- Target Service belum berjalan.
- Alamat atau port pada `services.json` tidak sesuai.
- Ekstensi cURL belum aktif.
- Endpoint tujuan tidak sesuai dengan implementasi Submission Service.

**Solusi:** Pastikan target service berjalan, periksa alamat dan port yang terdaftar, kemudian uji endpoint target secara langsung.

### 5. Port Sudah Digunakan

**Penyebab:** Port yang dipilih sedang digunakan oleh aplikasi lain.

**Solusi:** Gunakan port lain yang tersedia dan perbarui konfigurasi layanan pada `services.json` agar alamat tujuan tetap sesuai.

## 🔐 Catatan Keamanan dan Implementasi

- Pastikan alamat layanan hanya berasal dari konfigurasi yang dipercaya.
- Validasi nama layanan yang diminta klien sebelum melakukan lookup.
- Tangani kegagalan koneksi cURL dengan respons error yang sesuai.
- Jangan mengembalikan informasi internal server atau konfigurasi sensitif kepada klien.
- Batasi akses ke layanan internal jika sistem digunakan di lingkungan selain komputer lokal.
- Pastikan Gateway meneruskan method, header, body, dan status respons sesuai kebutuhan API yang didukung.

## 📌 Kesimpulan

Mini-LMS Service Registry & Gateway merupakan prototipe arsitektur microservices yang memisahkan proses pencarian alamat layanan dan penerusan permintaan klien. Service Registry menyediakan pemetaan layanan melalui `services.json`, sedangkan API Gateway menggunakan informasi tersebut untuk meneruskan permintaan secara dinamis.

Melalui pengujian nama layanan valid, nama layanan yang tidak ditemukan, dan perubahan port layanan, proyek ini bertujuan menunjukkan bagaimana Registry dan Gateway dapat membantu pengelolaan komunikasi antarlayanan secara lebih fleksibel.
