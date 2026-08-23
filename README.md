# Tumbang Smart Kids

Aplikasi **Tumbang Smart Kids** merupakan sistem informasi berbasis web
untuk membantu proses pencatatan, evaluasi, dan pemantauan perkembangan
anak pada layanan **Klinik Tumbuh Kembang RSIB**.

Aplikasi ini mendigitalisasi proses evaluasi terapi anak yang sebelumnya
dilakukan melalui formulir manual. Terapis dapat menentukan
aktivitas/indikator khusus untuk setiap anak, melakukan penilaian pada
setiap kunjungan, serta melihat perkembangan masing-masing aktivitas
secara longitudinal.

------------------------------------------------------------------------

## 📋 Tentang Project

Pada proses terapi, setiap anak dapat memiliki daftar aktivitas atau
indikator latihan yang berbeda.

Contoh aktivitas:

-   Identifikasi warna dasar
-   Mengcopy garis
-   Memegang pensil
-   Menyusun puzzle
-   Mengenal angka
-   Aktivitas lainnya sesuai kebutuhan terapi

Daftar aktivitas cukup dibuat ketika pasien mulai menjalani terapi. Pada
kunjungan berikutnya, terapis tidak perlu mengetik ulang aktivitas
tersebut.

Terapis cukup memilih tanggal evaluasi dan memberikan skor untuk
masing-masing aktivitas.

------------------------------------------------------------------------

## 🎯 Tujuan

Project ini dikembangkan untuk:

-   Mendigitalisasi pencatatan evaluasi tumbuh kembang anak.
-   Mengurangi pencatatan manual menggunakan formulir kertas.
-   Menyimpan riwayat evaluasi setiap pasien.
-   Mempermudah terapis melakukan evaluasi rutin.
-   Memantau perkembangan setiap aktivitas anak.
-   Menampilkan perkembangan dalam bentuk grafik.
-   Menyediakan laporan perkembangan anak dalam format PDF.
-   Mengetahui terapis yang melakukan setiap evaluasi.

------------------------------------------------------------------------

## 🛠️ Tech Stack

Project menggunakan:

  Teknologi            Keterangan
  -------------------- --------------------------
  Laravel              Backend Framework
  Filament v3          Administration Panel
  Livewire             Reactive Component
  Tailwind CSS         Styling
  MySQL / PostgreSQL   Database
  Chart.js             Visualisasi perkembangan
  DomPDF               Generate laporan PDF
  Vite                 Frontend build tool

------------------------------------------------------------------------

# ✨ Fitur Utama

## 👶 Manajemen Pasien Anak

Admin dan terapis dapat mengelola data pasien anak.

Data pasien meliputi:

-   Nama anak
-   Tanggal lahir
-   Jenis kelamin
-   Nama ayah
-   Nama ibu
-   Alamat

Setiap pasien memiliki aktivitas dan riwayat evaluasi masing-masing.

------------------------------------------------------------------------

## 📝 Aktivitas Per Anak

Setiap anak dapat mempunyai daftar aktivitas/indikator terapi yang
berbeda.

Contoh:

``` text
1. Identifikasi warna dasar
2. Mengcopy garis
3. Memegang pensil
4. Menyusun puzzle
5. Mengenal angka
```

Aktivitas disimpan pada tabel:

``` text
child_activities
```

dan terhubung dengan pasien melalui:

``` text
child_id
```

Dengan konsep ini, terapis tidak perlu membuat ulang aktivitas pada
setiap kunjungan.

------------------------------------------------------------------------

# 📊 Sistem Evaluasi D/S

Sistem menggunakan pola:

``` text
D = Date
S = Score
```

**D (Date)** merupakan tanggal evaluasi/konsultasi.

**S (Score)** merupakan nilai kemampuan anak untuk setiap aktivitas.

Skala penilaian:

    Skor Keterangan
  ------ ---------------------------------------
     `0` Full Prompted / Dibantu penuh
     `3` 70% Prompted / Dibantu sebagian besar
     `7` 30% Prompted / Dibantu sedikit
    `10` No Prompted / Mandiri

Contoh perkembangan:

``` text
Aktivitas: Mengcopy garis

01 Agustus 2026    → 3
08 Agustus 2026    → 3
15 Agustus 2026    → 7
22 Agustus 2026    → 7
29 Agustus 2026    → 10
```

Sehingga perkembangan aktivitas tersebut adalah:

``` text
3 → 3 → 7 → 7 → 10
```

------------------------------------------------------------------------

# 📅 Evaluation Session

Setiap kunjungan pasien menghasilkan sebuah **Evaluation Session**.

Session menyimpan:

-   Pasien
-   Terapis/evaluator
-   Tanggal evaluasi
-   Total skor
-   Catatan terapis

Contoh:

``` text
Pasien          : Ahmad
Tanggal         : 23 Agustus 2026
Terapis         : Terapis A
Catatan         : Perkembangan motorik mulai meningkat
```

------------------------------------------------------------------------

# 📋 Evaluation Detail

Setiap aktivitas yang dinilai pada sebuah session disimpan sebagai
`evaluation_details`.

Contoh:

``` text
Evaluation Session
│
├── Identifikasi warna → 7
├── Mengcopy garis     → 3
├── Memegang pensil    → 7
├── Menyusun puzzle    → 10
└── Mengenal angka     → 7
```

Dengan struktur ini, perkembangan setiap aktivitas dapat ditelusuri dari
waktu ke waktu.

------------------------------------------------------------------------

# 📈 Grafik Perkembangan

Aplikasi menyediakan grafik perkembangan **per aktivitas**.

Terapis terlebih dahulu memilih aktivitas:

``` text
Aktivitas

[ 2. Mengcopy garis                 ▼ ]
```

Kemudian sistem mengambil seluruh riwayat skor aktivitas tersebut.

Contoh:

``` text
10 |                              ●
   |                            /
 7 |                   ●──────●
   |                 /
 3 |       ●────────●
   |
 0 +--------------------------------------
      01 Aug   08 Aug   15 Aug   22 Aug
```

Pendekatan per aktivitas digunakan karena lebih representatif
dibandingkan hanya melihat total skor seluruh aktivitas.

Dengan demikian terapis dapat mengetahui apakah suatu kemampuan:

``` text
↑ Meningkat
→ Stabil
↓ Menurun
```

------------------------------------------------------------------------

# 📄 Laporan PDF

Sistem menyediakan laporan perkembangan untuk masing-masing pasien.

Pada halaman pasien tersedia fitur:

``` text
Preview Laporan
```

Alurnya:

``` text
Pasien
   ↓
Preview Laporan
   ↓
Preview di Browser
   ↓
Download PDF / Print
```

Laporan berisi:

-   Identitas pasien
-   Keterangan skala scoring
-   Daftar aktivitas
-   Riwayat skor setiap aktivitas
-   Riwayat konsultasi
-   Terapis/evaluator
-   Catatan evaluasi

Contoh nama file:

``` text
laporan-perkembangan-ahmad.pdf
```

------------------------------------------------------------------------

# 👤 User Management

Sistem memiliki dua role utama:

``` text
admin
terapis
```

Data user:

-   Nama
-   Alamat
-   Email
-   Password
-   Role
-   Status

Status user:

``` text
active
inactive
```

User dengan status `inactive` tidak diperbolehkan mengakses panel.

------------------------------------------------------------------------

## 🔐 Hak Akses

  Fitur                       Admin   Terapis
  -------------------------- ------- ---------
  Login Panel                  ✅       ✅
  Kelola User                  ✅       ❌
  Tambah Pasien                ✅       ✅
  Edit Pasien                  ✅       ✅
  Kelola Aktivitas             ✅       ✅
  Input Evaluasi               ✅       ✅
  Melihat Grafik               ✅       ✅
  Melihat Riwayat Evaluasi     ✅       ✅
  Preview Laporan              ✅       ✅
  Export PDF                   ✅       ✅
  Hapus Pasien                 ✅       ❌
  Mengaktifkan User            ✅       ❌

------------------------------------------------------------------------

# 🗄️ Struktur Database

Struktur utama database:

``` text
users
│
│ evaluator_id
│
└───────────────┐
                │
children        │
│               │
├── child_activities
│       │
│       │
│       └──────────────┐
│                      │
└── evaluation_sessions│
        │               │
        └── evaluation_details
```

------------------------------------------------------------------------

## `users`

Menyimpan akun pengguna.

Field utama:

``` text
id
name
address
email
password
role
status
created_at
updated_at
```

------------------------------------------------------------------------

## `children`

Menyimpan data pasien anak.

``` text
id
name
date_of_birth
gender
father
mother
address
created_at
updated_at
```

------------------------------------------------------------------------

## `child_activities`

Menyimpan aktivitas khusus masing-masing anak.

``` text
id
child_id
activity_no
activity_name
created_at
updated_at
```

Relasi:

``` text
children
    1
    │
    │
    N
child_activities
```

------------------------------------------------------------------------

## `evaluation_sessions`

Menyimpan informasi setiap kunjungan/evaluasi.

``` text
id
child_id
evaluator_id
evaluation_date
total_score
notes
created_at
updated_at
```

`evaluator_id` mengacu kepada user/terapis yang sedang login ketika
evaluasi dilakukan.

------------------------------------------------------------------------

## `evaluation_details`

Menyimpan skor setiap aktivitas.

``` text
id
session_id
activity_id
score
created_at
updated_at
```

Kombinasi:

``` text
session_id + activity_id
```

harus unik agar satu aktivitas tidak mempunyai dua nilai dalam session
yang sama.

------------------------------------------------------------------------

# 🔗 Relasi Eloquent

``` text
Child
│
├── hasMany ChildActivity
│
└── hasMany EvaluationSession


ChildActivity
│
├── belongsTo Child
│
└── hasMany EvaluationDetail


EvaluationSession
│
├── belongsTo Child
├── belongsTo User (Evaluator)
└── hasMany EvaluationDetail


EvaluationDetail
│
├── belongsTo EvaluationSession
└── belongsTo ChildActivity


User
│
└── hasMany EvaluationSession
```

------------------------------------------------------------------------

# 🚀 Instalasi

Clone repository:

``` bash
git clone <repository-url>
```

Masuk ke directory project:

``` bash
cd tumbang-smart-kids
```

Install dependency PHP:

``` bash
composer install
```

Install dependency frontend:

``` bash
npm install
```

Salin `.env`:

``` bash
cp .env.example .env
```

Generate application key:

``` bash
php artisan key:generate
```

------------------------------------------------------------------------

# 🗄️ Konfigurasi Database

Atur `.env`.

Contoh MySQL:

``` env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=tumbang
DB_USERNAME=root
DB_PASSWORD=
```

Kemudian:

``` bash
php artisan migrate
```

------------------------------------------------------------------------

# 🌱 Database Seeder

Project dapat menyediakan akun development menggunakan seeder.

Jalankan:

``` bash
php artisan db:seed
```

Atau sekaligus membuat ulang database:

``` bash
php artisan migrate:fresh --seed
```

> **PERINGATAN:** `migrate:fresh` akan menghapus seluruh tabel dan data
> yang ada.

Contoh akun development:

``` text
ADMIN

Email    : admin@tumbang.test
Password : admin12345
```

dan:

``` text
TERAPIS

Email    : terapis@tumbang.test
Password : terapis12345
```

> Akun dan password di atas hanya untuk development. Jangan menggunakan
> password default tersebut pada environment production.

------------------------------------------------------------------------

# ▶️ Menjalankan Aplikasi

Backend:

``` bash
php artisan serve
```

Frontend development:

``` bash
npm run dev
```

Buka:

``` text
http://127.0.0.1:8000/admin
```

Kemudian login menggunakan akun yang telah dibuat melalui database
seeder.

------------------------------------------------------------------------

# 🐳 Menjalankan dengan Docker

Apabila project dijalankan menggunakan Docker Compose:

``` bash
docker compose up -d
```

Install dependency:

``` bash
docker compose exec app composer install
```

Generate key:

``` bash
docker compose exec app php artisan key:generate
```

Migration dan seeder:

``` bash
docker compose exec app php artisan migrate --seed
```

Membersihkan cache Laravel:

``` bash
docker compose exec app php artisan optimize:clear
```

------------------------------------------------------------------------

# 🧹 Development Commands

Membersihkan cache:

``` bash
php artisan optimize:clear
```

Menjalankan migration:

``` bash
php artisan migrate
```

Reset database development:

``` bash
php artisan migrate:fresh --seed
```

Menjalankan seeder:

``` bash
php artisan db:seed
```

Menjalankan queue jika nantinya digunakan:

``` bash
php artisan queue:work
```

Build frontend:

``` bash
npm run build
```

------------------------------------------------------------------------

# 📂 Struktur Project Utama

``` text
app/
├── Models/
│   ├── User.php
│   ├── Child.php
│   ├── ChildActivity.php
│   ├── EvaluationSession.php
│   └── EvaluationDetail.php
│
└── Filament/
    └── Resources/
        ├── UserResource.php
        │
        └── ChildResource/
            ├── Pages/
            │   ├── ListChildren.php
            │   ├── CreateChild.php
            │   └── EditChild.php
            │
            ├── RelationManagers/
            │   └── ChildActivitiesRelationManager.php
            │
            └── Widgets/
                └── ChildProgressChart.php

database/
├── migrations/
└── seeders/

resources/
└── views/
    └── pdf/

routes/
└── web.php
```

------------------------------------------------------------------------

# 🔄 Alur Sistem

### 1. Registrasi Pasien

``` text
Terapis/Admin
      ↓
Tambah Pasien
      ↓
Isi Biodata
      ↓
Simpan
```

### 2. Menentukan Aktivitas

``` text
Pasien
   ↓
Daftar Aktivitas
   ↓
Tambah Aktivitas
   ↓
1. Identifikasi warna
2. Mengcopy garis
3. Memegang pensil
```

Aktivitas ini digunakan kembali pada evaluasi berikutnya.

### 3. Evaluasi

``` text
Pasien
   ↓
Input Evaluasi
   ↓
Tanggal Evaluasi
   ↓
────────────────────────────
Identifikasi warna    0 3 7 10
Mengcopy garis        0 3 7 10
Memegang pensil       0 3 7 10
────────────────────────────
   ↓
Simpan
```

Sistem otomatis mencatat:

``` text
child_id
evaluator_id
evaluation_date
score
```

### 4. Monitoring

``` text
Pasien
   ↓
Pilih Aktivitas
   ↓
Grafik Perkembangan
   ↓
3 → 3 → 7 → 7 → 10
```

### 5. Laporan

``` text
Pasien
   ↓
Preview Laporan
   ↓
Preview Browser
   ↓
Download PDF / Print
```

------------------------------------------------------------------------

# 🛡️ Catatan Keamanan

Beberapa prinsip yang digunakan:

-   Password disimpan dalam bentuk hash.
-   Email user harus unik.
-   User inactive tidak diperbolehkan masuk panel.
-   Evaluator diambil dari user yang sedang login.
-   `activity_id` divalidasi terhadap pasien yang sedang dievaluasi.
-   Penginputan session dan detail evaluasi dilakukan dalam database
    transaction.
-   Foreign key digunakan untuk menjaga integritas data.
-   Role digunakan untuk membatasi fitur administratif.

------------------------------------------------------------------------

# 📝 Scoring Reference

     Score Prompting       Interpretasi
  -------- --------------- ------------------------
     **0** Full Prompted   Dibantu penuh
     **3** 70% Prompted    Dibantu sebagian besar
     **7** 30% Prompted    Dibantu sedikit
    **10** No Prompted     Mandiri

Semakin tinggi nilai menunjukkan semakin sedikit bantuan yang diperlukan
oleh anak dalam melakukan aktivitas tersebut.

------------------------------------------------------------------------

# 📝 Surat Keterangan Dalam Perawatan

Aplikasi menyediakan modul **Surat Keterangan Dalam Perawatan** yang
terhubung langsung dengan data pasien anak. Fitur ini digunakan untuk
membuat dan mengarsipkan surat keterangan bahwa seorang anak masih
menjalani perawatan atau terapi di **TUMBANG Smart Kids RSIB**.

Dengan modul ini, petugas tidak perlu mengetik ulang seluruh identitas
pasien setiap kali membuat surat. Data dasar anak diambil dari data
pasien yang sudah tersimpan pada sistem.

## Data Surat

Setiap surat menyimpan informasi seperti:

-   Pasien/anak yang bersangkutan
-   Nomor surat
-   Tanggal surat
-   Diagnosis dari dokter rehabilitasi
-   Isi/keterangan surat
-   User yang membuat surat
-   Nama penanggung jawab
-   Jabatan penanggung jawab

Data surat disimpan pada tabel:

``` text
treatment_certificates
```

Struktur utama data:

``` text
id
child_id
letter_number
letter_date
diagnosis
statement
created_by
signer_name
signer_title
created_at
updated_at
```

`child_id` menghubungkan surat dengan data pasien pada tabel `children`,
sedangkan `created_by` mencatat user yang membuat surat.

## Data Pasien Otomatis

Identitas anak pada surat diambil dari data pasien sehingga tidak perlu
dimasukkan ulang.

Data yang digunakan antara lain:

``` text
Nama
Tempat Lahir
Tanggal Lahir
Alamat
```

Untuk mendukung format **Tempat, Tanggal Lahir (TTL)** pada surat, data
pasien dapat menggunakan field:

``` text
place_of_birth
date_of_birth
```

Contoh tampilan:

``` text
Nama                 : Ahmad
TTL                  : Bontang, 20 Januari 2020
Alamat               : Bontang
Diagnosis dr. Rehab  : ASD
```

## Historical Snapshot Surat

Informasi seperti diagnosis, nama penanggung jawab, dan jabatan
penanggung jawab disimpan pada record surat.

Tujuannya agar surat yang sudah diterbitkan tetap mempertahankan
informasi pada saat surat tersebut dibuat. Apabila penanggung jawab atau
informasi surat berubah di kemudian hari, surat lama tidak ikut berubah.

## Preview Surat

Setelah surat dibuat dan disimpan, user dapat membuka **Preview Surat**
terlebih dahulu sebelum mencetak atau mengunduh PDF.

Alurnya:

``` text
Pasien
   ↓
Surat Keterangan Dalam Perawatan
   ↓
Buat Surat
   ↓
Isi Data Surat
   ↓
Simpan
   ↓
Preview Surat
   ↓
Download PDF / Print
```

Preview dibuat menyerupai dokumen A4 agar user dapat memeriksa isi surat
sebelum dicetak.

Template preview berada pada:

``` text
resources/views/treatment-certificates/preview.blade.php
```

## Export PDF Surat

Surat dapat diunduh dalam format PDF menggunakan **DomPDF**.

Template PDF berada pada:

``` text
resources/views/treatment-certificates/pdf.blade.php
```

PDF surat dapat memuat:

-   Kop/header layanan
-   Logo RSIB
-   Judul Surat Keterangan Dalam Perawatan
-   Nomor surat
-   Identitas anak
-   Tempat dan tanggal lahir
-   Alamat
-   Diagnosis
-   Isi keterangan
-   Tanggal surat
-   Nama penanggung jawab
-   Jabatan penanggung jawab

Untuk logo pada PDF, file dapat disimpan pada:

``` text
public/images/rsib.png
```

Pada halaman preview browser, logo dapat dipanggil menggunakan
`asset()`. Untuk hasil DomPDF, penggunaan local path melalui
`public_path()` atau Base64 lebih stabil, khususnya ketika aplikasi
berjalan menggunakan Docker.

## Relasi Eloquent Surat

Relasi modul surat:

``` text
Child
│
└── hasMany TreatmentCertificate

TreatmentCertificate
│
├── belongsTo Child
└── belongsTo User (Creator)

User
│
└── hasMany TreatmentCertificate
```

Dengan relasi tersebut, satu anak dapat memiliki lebih dari satu surat
pada tanggal yang berbeda dan seluruh riwayat surat tetap tersimpan.

## Alur Penggunaan Surat

``` text
Terapis / Admin
      ↓
Buka Data Pasien
      ↓
Surat Keterangan Dalam Perawatan
      ↓
Buat Surat
      ↓
Isi Nomor Surat, Tanggal, Diagnosis,
Keterangan dan Penanggung Jawab
      ↓
Simpan
      ↓
Preview
      ↓
Download PDF / Print
```

Pemisahan setiap surat sebagai record tersendiri memungkinkan sistem
menyimpan histori dokumen administratif masing-masing pasien.

------------------------------------------------------------------------

# 🗺️ Pengembangan Selanjutnya

Beberapa fitur yang dapat dikembangkan:

-   Surat Keterangan Dalam Perawatan
-   Preview dan export surat PDF
-   Nomor surat otomatis
-   Tanda tangan digital
-   Dashboard statistik pasien
-   Filter laporan berdasarkan periode
-   Perbandingan perkembangan beberapa aktivitas
-   Riwayat perubahan aktivitas
-   Audit log aktivitas user
-   Backup database
-   Export Excel
-   Laporan perkembangan berdasarkan periode
-   Notifikasi jadwal evaluasi
-   Manajemen jadwal terapi

------------------------------------------------------------------------

# 📌 Status Project

Saat ini modul utama yang telah dirancang meliputi:

``` text
✓ User Management
✓ Role Admin / Terapis
✓ Status User
✓ Manajemen Pasien
✓ Aktivitas Per Anak
✓ Evaluation Session
✓ Scoring Per Aktivitas
✓ Riwayat Evaluasi
✓ Grafik Perkembangan Per Aktivitas
✓ Preview Laporan
✓ Export PDF Per Anak

○ Surat Keterangan Dalam Perawatan
○ Dashboard Statistik
○ Audit Log
○ Export Excel
```

------------------------------------------------------------------------

## License

Project ini dikembangkan untuk kebutuhan sistem informasi **Tumbang
Smart Kids / Klinik Tumbuh Kembang RSIB**.

Penggunaan, distribusi, dan pengembangan lebih lanjut mengikuti
kebijakan internal organisasi.