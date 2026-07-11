# TUTORIAL DEPLOY KE RENDER (GRATIS)

## Kenapa Render?

| Kelebihan | Keterangan |
|---|---|
| ✅ Gratis | 750 jam/bulan + database PostgreSQL 1GB |
| ✅ Auto HTTPS | SSL otomatis |
| ✅ Auto deploy | Otomatis dari GitHub |
| ✅ Docker support | Bisa jalanin Laravel |
| ❌ Butuh kartu kredit | Untuk verifikasi (tidak ditagih) |
| ❌ PostgreSQL saja | Render tidak support MySQL gratis |

---

## 1. PERSIAPAN

### 1.1 Pastikan project sudah di GitHub

```bash
cd D:\FORTOFOLIO\portfolio-laravel

# Cek git status
git status

# Kalau ada perubahan
git add .
git commit -m "add docker config for render"
git push
```

### 1.2 File yang sudah dibuat

Proyek kamu sekarang punya file tambahan:

| File | Fungsi |
|---|---|
| `Dockerfile` | Instruksi untuk build Laravel + Nginx |
| `docker/nginx.conf` | Konfigurasi web server |
| `docker/supervisord.conf` | Menjalankan Nginx & PHP bersamaan |
| `.dockerignore` | File yang tidak perlu masuk Docker |
| `render.yaml` | Blueprint otomatis untuk Render |

---

## 2. UPLOAD KE GITHUB

```bash
git add Dockerfile docker/ render.yaml .dockerignore
git commit -m "add docker & render config"
git push
```

---

## 3. DEPLOY KE RENDER

### 3.1 Buat Akun Render

```
a. Buka https://dashboard.render.com
b. Klik "Sign Up" → pilih "GitHub"
c. Authorize Render → beri akses ke repo portfolio-laravel
d. Render minta credit card → masukkan (untuk verifikasi)
   ⚠️ TIDAK akan ditagih selama pakai free tier
```

### 3.2 Deploy (Cara 1: Blueprint - Otomatis)

**Pakai render.yaml yang sudah dibuat:**

```
a. Login ke dashboard Render
b. Klik "New +" (atas kanan) → "Blueprint"
c. Pilih repo "portfolio-laravel"
d. Render otomatis baca render.yaml → kasih nama
e. Klik "Apply Blueprint"
f. Render akan buat:
   ✅ Web Service → portfolio-laravel
   ✅ PostgreSQL → portfolio-db
```

⏳ **Tunggu ~5-10 menit** untuk build & deploy.

### 3.3 Deploy (Cara 2: Manual)

**Kalau blueprint error, lakukan manual:**

#### a. Buat PostgreSQL

```
1. Klik "New +" → "PostgreSQL"
2. Isi:
   - Name: portfolio-db
   - Database: portfolio
   - User: portfolio
   - Plan: Free
3. Klik "Create"
4. Save connection info:
   - Internal Database URL
   - Host, Port, Database, User, Password
```

#### b. Buat Web Service

```
1. Klik "New +" → "Web Service"
2. Pilih repo "portfolio-laravel"
3. Isi:
   - Name: portfolio-laravel
   - Runtime: Docker
   - Branch: main
   - Plan: Free

4. Buka tab "Advanced" → "Add Environment Variable"
   Tambah satu per satu:

   APP_ENV = production
   APP_DEBUG = false
   DB_CONNECTION = pgsql

   (copy dari PostgreSQL yang dibuat)
   DB_HOST = (dari PostgreSQL: Host)
   DB_PORT = 5432
   DB_DATABASE = portfolio
   DB_USERNAME = portfolio
   DB_PASSWORD = (dari PostgreSQL: Password)

5. Klik "Create Web Service"
```

---

## 4. SETELAH DEPLOY

### 4.1 Generate APP_KEY

**Render belum generate APP_KEY otomatis. Lakukan manual:**

```
a. Di dashboard Render, klik web service "portfolio-laravel"
b. Klik tab "Shell" (atas)
c. Di terminal yang muncul, ketik:

   php artisan key:generate

d. Keluar: exit
e. Klik "Manual Deploy" → "Deploy latest commit"
```

### 4.2 Jalankan Migration

**Atau langsung semua di Shell:**

```
a. Klik web service → tab "Shell"
b. Jalankan:

   php artisan key:generate
   php artisan migrate --seed
   php artisan storage:link

c. exit
d. "Manual Deploy" → "Deploy latest commit"
```

### 4.3 Dapatkan URL

```
URL ada di dashboard web service, bagian atas:
https://portfolio-laravel.onrender.com
```

---

## 5. UPDATE PROJECT

```bash
git add .
git commit -m "update"
git push
```

Render otomatis build ulang. ⏳ Tunggu ~3-5 menit.

---

## 6. STORAGE UPLOAD (Logo, Favicon)

Render juga punya **episodal storage** — file hilang setiap deploy.

### Solusi: Pakai IMGBB

```
1. Buka https://imgbb.com
2. Upload logo/favicon
3. Copy "Direct Link"
4. Buka website → /admin/settings
5. Paste URL langsung di kolom logo/favicon
6. Save
```

Atau upload manual via Shell:
```bash
# Di Render Shell
php artisan tinker
> Setting::set('logo_path', 'https://i.ibb.co/xxx/logo.png');
> Setting::set('favicon_path', 'https://i.ibb.co/xxx/favicon.png');
```

---

## 7. CEK HASIL

| Halaman | URL |
|---|---|
| Home | `https://portfolio-laravel.onrender.com` |
| Admin | `/admin/dashboard` |
| Sitemap | `/sitemap.xml` |
| Robots | `/robots.txt` |

---

## ⚠️ PERBEDAAN DENGAN RAILWAY

| Fitur | Railway | Render |
|---|---|---|
| Trial | 5 dolar kredit | Tidak ada trial (langsung free) |
| Database | MySQL gratis ✓ | PostgreSQL gratis |
| Storage | Episodal | Episodal |
| Kartu kredit | Tidak wajib (trial) | Wajib (verifikasi) |
| Build | Auto | Auto + Manual |
| Domain | `.railway.app` | `.onrender.com` |
| Kecepatan | Cepat | Sedang |

---

## 🐛 TROUBLESHOOTING

### Error 502 / Connection refused
```
Penyebab: Docker build belum selesai atau port salah
Solusi:
  - Cek Dockerfile → port harus 8080
  - Cek nginx.conf → listen 8080
  - Redeploy
```

### Error 500
```
Penyebab: APP_KEY belum digenerate
Solusi: Buka Shell → php artisan key:generate → Redeploy
```

### Error "Class not found"
```
Penyebab: Composer autoload error
Solusi: Buka Shell → composer dump-autoload → Redeploy
```

### Error PostgreSQL connection
```
Penyebab: DB_HOST salah
Solusi:
  - Cek di database Render → Connections → Internal
  - Pastikan pakai Internal Host (bukan External)
```

### Slow response pertama
```
Render mematikan service setelah 15 menit idle (free tier).
Kunjungi lagi → tunggu ~30 detik → hidup lagi.
Ini normal untuk free tier.
