# TUTORIAL DEPLOY LENGKAP: GitHub → Railway

## DAFTAR ISI
1. [Apa itu GitHub dan Railway?](#1-apa-itu-github-dan-railway)
2. [Buat Akun GitHub](#2-buat-akun-github)
3. [Upload Project ke GitHub (Push)](#3-upload-project-ke-github-push)
4. [Deploy ke Railway](#4-deploy-ke-railway)
5. [Setup Database MySQL](#5-setup-database-mysql)
6. [Generate Key & Migration](#6-generate-key--migration)
7. [Aktifkan Domain Publik](#7-aktifkan-domain-publik)
8. [Cara Update Project](#8-cara-update-project)

---

## 1. APA ITU GITHUB DAN RAILWAY?

### GitHub
GitHub adalah **tempat penyimpanan code online** (mirip Google Drive tapi khusus coding). Semua file project disimpan di server GitHub.

**Kenapa butuh GitHub?**
- Agar code bisa diakses dari manapun
- Railway mengambil code dari GitHub, bukan dari komputer kamu langsung
- Kalau komputer kamu mati/rusak, code tetap aman di GitHub

### Railway
Railway adalah **jasa hosting** (server online) yang bisa menjalankan website Laravel.

**Cara kerjanya:**
```
Komputer kamu → GitHub → Railway → Website Live
                 (push)     (deploy)
```

Kamu code di komputer → upload ke GitHub → Railway ambil dari GitHub → website jalan 24 jam.

---

## 2. BUAT AKUN GITHUB

### Langkah:
```
a. Buka https://github.com
b. Klik tombol "Sign up" (pojok kanan atas)
c. Masukkan:
   - Email: email kamu (pakai yang aktif)
   - Password: buat password kuat
   - Username: contoh "raypurba" (ini akan jadi nama akun kamu)
d. Klik "Continue"
e. Cek email → masukkan kode verifikasi yang dikirim GitHub
f. Jawab pertanyaan:
   - Number of team members: "Just me"
   - Features interested in: (terserah, bisa skip)
g. Klik "Continue for free"
```

**Selesai!** Sekarang kamu punya akun GitHub.

---

## 3. UPLOAD PROJECT KE GITHUB (PUSH)

### 3.1 Buat Repository (Tempat Penyimpanan)

Repository = folder project di GitHub.

```
a. Login ke https://github.com
b. Klik ikon "+" (pojok kanan atas) → pilih "New repository"
c. Isi form:
   - Repository name: portfolio-laravel
     (nama project. Bebas, tapi jangan pakai spasi)
   
   - Description: (kosongkan)
   
   - Public / Private: pilih Public
     (Public = semua orang bisa lihat. Private = cuma kamu. Pilih Public biar gratis)
   
   - Initialize this repository with: (JANGAN centang apapun)
     ✓ Jangan centang "Add a README"
     ✓ Jangan centang ".gitignore"
     ✓ Jangan centang "License"

d. Klik tombol hijau "Create repository"
```

**Setelah create,** akan muncul halaman baru dengan 3 opsi. **Jangan ditutup** — kita akan pakai perintah dari sini.

### 3.2 Persiapan di Komputer

Buka terminal:
```
Tekan Windows → ketik "PowerShell" → klik kanan "Run as Administrator"
```

Ketik satu perintah untuk pindah ke folder project:
```bash
cd D:\FORTOFOLIO\portfolio-laravel
```

**Apa itu `cd`?** = Change Directory (pindah folder). Perintah ini memberitahu terminal "folder mana yang mau kita kerja".

### 3.3 Cek Apakah Git Sudah Terinstall

```bash
git --version
```

Kalau muncul `git version 2.x.x` → git sudah ada.
Kalau error "not recognized" → download di https://git-scm.com dan install.

### 3.4 Inisialisasi Git (Pertama Kali Saja)

```bash
git init
```

**Penjelasan:** `git init` membuat folder `.git` di project kamu. Folder ini berisi "catatan" semua perubahan file. Tanpa ini, git tidak tahu file mana yang harus di-track.

### 3.5 Setting Git (Pertama Kali Saja)

```bash
git config user.name "Ray Purba"
git config user.email "emailkamu@gmail.com"
```

Ganti dengan nama dan email kamu. Ini untuk identitas — siapa yang melakukan perubahan.

### 3.6 Hapus .env dari Tracking

```bash
git rm --cached .env 2>nul
echo ".env" >> .gitignore
```

**Penjelasan:** File `.env` berisi password database, key rahasia, dll. File ini **tidak boleh** diupload ke GitHub karena bisa dibaca orang lain. Perintah di atas memberitahu git: "abaikan file .env, jangan upload".

`.gitignore` = daftar file/folder yang harus diabaikan git.

### 3.7 Build Frontend

```bash
npm run build
```

**Penjelasan:** Laravel punya file CSS/JS yang perlu "dikompilasi" dulu. `npm run build` mengubah file dari folder `resources/` menjadi file siap-pakai di `public/build/`.

**Kalau error:** coba jalankan `npm install` dulu, baru `npm run build`.

### 3.8 Tambah Semua File ke Git (Staging)

```bash
git add .
```

**Penjelasan:** `git add .` memberitahu git: "file-file ini akan saya upload". Tanda `.` artinya "semua file di folder ini". Ini disebut **staging** — mempersiapkan file sebelum di-commit.

**Cek file apa saja yang akan diupload:**
```bash
git status
```
Akan muncul daftar file hijau. Pastikan tidak ada file `.env` di daftar.

### 3.9 Commit (Simpan Perubahan)

```bash
git commit -m "initial commit"
```

**Penjelasan:** Commit = "mengambil snapshot" atau foto kondisi project saat ini. `-m` adalah pesan yang menjelaskan apa yang diubah. `"initial commit"` artinya "commit pertama".

Ibaratnya: setelah `git add` (memilih barang), `git commit` (memasukkan ke kardus dan menulis label).

### 3.10 Hubungkan ke GitHub (Remote)

```bash
git remote add origin https://github.com/RAY-PURBA/portfolio-laravel.git
```

**⚠️ Ganti `RAY-PURBA` dengan username GitHub kamu!**

**Penjelasan:** `remote` = alamat tujuan upload. `origin` = nama kependekan untuk alamat GitHub. Perintah ini bilang: "kalau saya bilang origin, maksud saya adalah URL GitHub ini".

**Cara cek username GitHub:** Buka github.com, lihat pojok kanan atas — itu username kamu.

### 3.11 Upload ke GitHub (Push)

```bash
git push -u origin main
```

**Penjelasan:** `push` = mengirim file dari komputer ke GitHub. `origin` = tujuan (GitHub). `main` = nama cabang (branch). `-u` = simpan setting ini, lain kali cukup ketik `git push`.

**Kalau error "failed to push":**
```bash
# Mungkin namanya "master", bukan "main"
git push -u origin master
```

### 3.12 Verifikasi

Buka `https://github.com/RAY-PURBA/portfolio-laravel` (ganti dengan username kamu).

Kalau semua file project muncul → **berhasil!** 🎉

---

## 4. DEPLOY KE RAILWAY

### 4.1 Login Railway

```
a. Buka https://railway.com
b. Klik tombol "Login with GitHub"
   (Railway menggunakan login GitHub — tidak perlu bikin akun baru)

c. Masukkan password GitHub kamu
d. Akan muncul halaman "Authorize Railway"
e. Pilih "Only select repositories" → centang "portfolio-laravel"
   (Ini untuk keamanan — Railway cuma bisa akses repo yang kamu izinkan)
f. Klik "Install" / "Authorize"
```

**Kenapa Railway perlu akses GitHub?** Railway perlu "melihat" code project kamu agar bisa di-deploy. Dengan mengizinkan akses, Railway bisa otomatis membaca dan membuild project.

### 4.2 Buat Project Baru

```
a. Setelah login, kamu masuk ke dashboard Railway
b. Klik tombol "New Project" (biru, kanan atas)
c. Pilih opsi "Deploy from GitHub repo"
d. Akan muncul daftar repo GitHub kamu. Klik "portfolio-laravel"
```

**Sekarang Railway mulai bekerja:**
```
1. Railway clone (download) code dari GitHub
2. Railway mendeteksi: "Oh ini Laravel" (lihat file composer.json)
3. Railway install PHP, Composer, Node.js
4. Railway jalankan: composer install
5. Railway jalankan: npm install && npm run build
6. Railway siapkan web server (Nginx)
```

⏳ **Proses ini sekitar 3-5 menit.** Akan ada log/yang bergerak-gerak. Tunggu sampai semua centang hijau.

### 4.3 Kalau Gagal Build

Kadang build gagal. Cek log dengan:
```
Klik service portfolio-laravel → tab "Deployments" → klik deployment terakhir
→ scroll log untuk lihat error
```

Error umum: versi PHP kurang, extension kurang. Tenang, nanti kita fix.

---

## 5. SETUP DATABASE MYSQL

Laravel butuh database untuk menyimpan data (skills, projects, admin, dll).

### 5.1 Tambah Service MySQL

```
a. Di dashboard Railway, lihat sidebar kiri
b. Ada tombol "+ New" (lingkaran biru dengan icon "+")
c. Klik "+ New"
d. Pilih "Database" → "MySQL"
e. Tunggu ~1-2 menit
```

**Yang terjadi:** Railway membuat server MySQL terpisah. Akan muncul kotak baru dengan icon gajah (logo MySQL).

**Cek status:** Pastikan ada centang hijau (artinya MySQL sudah running).

### 5.2 Copy URL Database (MYSQL_URL)

```
a. Klik kotak MySQL (yang icon gajah)
b. Klik tab "Variables" (atas)
c. Akan ada variable: MYSQL_URL
d. Klik icon copy (dua kotak) di sebelah kanan
   — atau select semua → Ctrl+C
```

**Contoh isi MYSQL_URL:**
```
mysql://root:AbCdE123@roundhouse.proxy.rlwy.net:3306/railway
```

**Penjelasan URL ini:**
| Bagian | Arti |
|---|---|
| `mysql://` | Jenis database |
| `root` | Username database |
| `AbCdE123` | Password database |
| `roundhouse.proxy.rlwy.net` | Alamat server database |
| `3306` | Port (pintu koneksi) |
| `railway` | Nama database |

### 5.3 Set Variable di Service Laravel

Sekarang kita beri tahu Laravel: "pakai database ini".

```
a. Klik service "portfolio-laravel" (bukan MySQL)
b. Klik tab "Variables"
c. Klik tombol "+ New Variable"
d. Masukkan KEY dan VALUE satu per satu:
```

**Variable 1:**
```
KEY:   APP_ENV
VALUE: production
```
*Artinya: "Laravel, sekarang kamu mode production (bukan mode development)".*

**Variable 2:**
```
KEY:   APP_DEBUG
VALUE: false
```
*Artinya: "Kalau error, jangan tampilkan detail error ke pengunjung (biar aman)".*

**Variable 3:**
```
KEY:   DB_CONNECTION
VALUE: mysql
```
*Artinya: "Pakai database MySQL".*

**Variable 4:**
```
KEY:   DB_URL
VALUE: (paste MYSQL_URL tadi)
```
*Artinya: "Ini alamat database-nya".*

### 5.4 Deploy Ulang

```
a. Klik tab "Deployments"
b. Klik tombol "Deploy" (biru, kanan atas)
   — atau "Redeploy" jika tombolnya merah

c. Tunggu sampai centang hijau (~2-3 menit)
```

**Kenapa harus deploy ulang?** Variable baru cuma生效 (take effect) setelah di-restart. Deploy ulang = restart aplikasi dengan variable baru.

---

## 6. GENERATE KEY & MIGRATION

### 6.1 Buka Shell Railway

Railway Shell = terminal online yang terhubung ke server kamu.

```
a. Klik service "portfolio-laravel"
b. Tab "Deployments"
c. Di deployment teratas (yang paling baru), klik "..." atau "⋮"
d. Pilih "Railway Shell" atau "Open Shell"
```

**Tunggu sebentar**, akan muncul kotak hitam seperti terminal. Ini adalah "jendela" ke server Railway.

### 6.2 Generate APP_KEY

```bash
php artisan key:generate
```

**Kenapa?** Laravel menggunakan APP_KEY untuk mengenkripsi session, cookie, dan data sensitif lainnya. Tanpa key ini, admin login tidak akan berfungsi.

**Apa yang terjadi:** Perintah ini mengisi file `.env` di server dengan string panjang seperti `base64:AbCd123...`.

### 6.3 Jalankan Migration & Seeder

```bash
php artisan migrate --seed
```

**Penjelasan:** `migrate` = membuat tabel-tabel database. `--seed` = mengisi data awal.

Tanpa perintah ini, database masih kosong — tidak ada tabel users, skills, projects, dll.

**Apa yang dibuat:**
- Tabel users (untuk login admin)
- Tabel skills + skill_categories
- Tabel projects + project_categories
- Tabel settings, about, services, dll
- **Data contoh:** React, Laravel, MySQL (dari seeder)

### 6.4 Buat Symlink Storage

```bash
php artisan storage:link
```

**Kenapa?** Kamu upload file (logo, favicon) ke `storage/app/public/`. Tapi web server melayani file dari `public/`. Symlink membuat `public/storage` terhubung ke `storage/app/public` — jadi file upload bisa diakses lewat browser.

### 6.5 Keluar dari Shell

```bash
exit
```

### 6.6 Deploy Ulang (Terakhir)

```
a. Klik tab "Deployments"
b. Klik "Deploy" (biar APP_KEY tersimpan permanen)
c. Tunggu centang hijau
```

---

## 7. AKTIFKAN DOMAIN PUBLIK

### 7.1 Generate Domain

```
a. Klik service "portfolio-laravel"
b. Klik tab "Settings" (⚙️ — icon gir/roda gigi)
c. Scroll ke bawah, cari bagian "Public Networking"
d. Klik tombol "Generate Domain"
```

⏳ Tunggu ~30 detik. Akan muncul URL seperti:
```
https://portfolio-laravel.up.railway.app
```

### 7.2 Update APP_URL

```
a. Klik tab "Variables"
b. Cari variable "APP_URL"
c. Edit VALUE:
   ⚠️ Hapus yang lama → isi dengan:
   https://portfolio-laravel.up.railway.app
   (ganti sesuai URL yang kamu dapat)

d. Klik "Deploy" ulang
```

**Kenapa APP_URL penting?** Tanpa ini, link di website kamu mungkin mengarah ke `localhost` (tidak akan berfungsi).

### 7.3 Coba Buka

Klik URL yang di-generate. Portfolio kamu sudah LIVE! 🎉

---

## 8. CARA UPDATE PROJECT

Seiring waktu, kamu akan mengubah code (tambah fitur, perbaiki bug). Begini caranya:

### 8.1 Code Baru → Commit → Push

**Di komputer kamu:**
```bash
# 1. Pindah ke folder project
cd D:\FORTOFOLIO\portfolio-laravel

# 2. Build ulang frontend (kalau ada perubahan CSS/JS)
npm run build

# 3. Lihat file apa yang berubah
git status

# 4. Tambah semua perubahan
git add .

# 5. Commit dengan pesan
git commit -m "update: tambah animasi skill"

# 6. Push ke GitHub
git push
```

### 8.2 Railway Otomatis Build Ulang

Setelah `git push`:
```
1. GitHub menerima code baru
2. Railway mendeteksi ada perubahan di GitHub
3. Railway otomatis build ulang (~3 menit)
4. Website otomatis update
```

**Kamu tidak perlu login ke Railway setiap kali update.** Cukup `git push`, sisanya otomatis.

---

## ⚠️ PENTING: STORAGE UPLOAD (Logo, Favicon)

Railway punya **penyimpanan sementara**. Kalau kamu upload logo di `/admin/settings`, file itu akan **hilang** setiap kali deploy ulang.

### Solusi IMGBB (Gratis)

Gunakan layanan hosting gambar gratis:

```
1. Buka https://imgbb.com
2. Klik "Start Uploading"
3. Pilih file logo/favicon kamu
4. Klik "Upload"
5. Setelah selesai, cari "Direct Link" dan copy URL-nya
6. Buka website kamu → /admin/settings
7. Tempel URL di kolom logo/favicon
8. Klik "Save All Settings"
```

Dengan cara ini, logo disimpan di IMGBB (bukan di Railway) — jadi tidak akan hilang.

---

## 🐛 TROUBLESHOOTING (Kalau Error)

### Error 500 (Halaman Putih)
```
Penyebab: APP_KEY tidak ada atau salah
Solusi: Buka Railway Shell → php artisan key:generate → Deploy ulang
```

### Error 403 Forbidden
```
Penyebab: Storage link belum dibuat
Solusi: Buka Railway Shell → php artisan storage:link
```

### Error 404 Not Found
```
Penyebab: Route tidak ditemukan
Solusi: Pastikan APP_URL sudah benar di Variables
```

### Error 502 Bad Gateway
```
Penyebab: Service belum siap atau crash
Solusi: Klik "Redeploy" dan tunggu 2 menit
```

### Error "Class not found"
```
Penyebab: Composer tidak terinstall dengan benar
Solusi: Buka Railway Shell → composer dump-autoload → Deploy ulang
```

### Push Error: "failed to push some refs"
```
Penyebab: GitHub punya file yang tidak ada di komputer kamu
Solusi:
   git pull --rebase origin main
   git push
```

---

## 📋 CEKLIST SETELAH DEPLOY

| No | Item | Cara Cek |
|---|---|---|
| 1 | Homepage | Buka URL Railway |
| 2 | Admin login | Buka `/admin/dashboard` |
| 3 | Sitemap | Buka `/sitemap.xml` |
| 4 | robots.txt | Buka `/robots.txt` |
| 5 | Image logo | Cek di navbar |
| 6 | Favicon | Cek di tab browser |
| 7 | Skill animation | Scroll ke section Skills |
| 8 | Contact form | Coba kirim pesan |

---

## SELESAI! 🎉

Portfolio kamu sekarang sudah live dan bisa diakses dari mana saja, 24 jam sehari. Kalau ada error atau bingung di langkah tertentu, bilang aja.
