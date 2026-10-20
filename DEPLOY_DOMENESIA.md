# Deploy Otomatis ke DomaiNesia (GitHub Actions)

Workflow: `.github/workflows/main.yml`
Trigger: **push ke branch `main`** (otomatis) atau manual dari tab **Actions** (ada opsi menjalankan migrasi atau tidak).

---

## 1. Cara kerja singkat

1. **Build di runner GitHub** — `composer install --no-dev` + `npm ci && npm run build`
   (npm TIDAK diperlukan di hosting; ini menjawab error "npm not found" dari cron lama).
2. **Preflight read-only** ke server: cek target path bukan public_html/WordPress, status `.env`, APP_KEY, PHP CLI, rsync, kapasitas disk.
3. **Upload** kode via `rsync --delete` (incremental; fallback `tar` otomatis jika server tidak punya rsync).
4. **Post-deploy aman**: `storage:link` (hanya jika belum ada), `migrate --force --graceful`, `config:cache`, `view:cache`.
5. **Verifikasi**: marker commit SHA di server vs SHA GitHub, manifest Vite, health check HTTP.

### Yang TIDAK pernah dilakukan workflow

| Larangan | Cara diamankan |
|---|---|
| `migrate:fresh` / drop / rollback / seed | Tidak pernah ada perintahnya; hanya `migrate --force --graceful` |
| Menimpa `.env` produksi | `.env` dan `.env.*` di-exclude dari upload |
| Menyentuh `/home/raycodem/public_html` (WordPress) | Deploy hanya ke `/home/raycodem/portfolio-laravel`; preflight membatalkan jika target = public_html atau berisi wp-config.php |
| Menghapus upload/log admin | `storage/` di-exclude dari rsync |
| Mengubah document root / bikin symlink public_html | Tidak ada langkah semacam itu di workflow |

---

## 2. Fakta server yang sudah diverifikasi (18 Okt 2026)

| Item | Nilai | Bukti |
|---|---|---|
| Domain → IP | `raypurba.my.id` → `202.155.137.39` | DNS A record |
| SSH publik | `202.155.137.39` **port 64000** | TCP connect terbuka + banner `SSH-2.0-OpenSSH_9.9` |
| Port lain | 22 / 2222 / 65002 **tertutup** | hasil probe |
| Hostname `toscana` | **TIDAK punya DNS publik** | `toscana.domainesia.id` gagal resolve |

> **PENTING:** `toscana` yang terlihat di terminal cPanel adalah hostname internal server.
> Jangan memakainya sebagai `SSH_HOST` di GitHub Actions. Gunakan IP yang terverifikasi
> di atas, atau hostname yang benar-benar ditampilkan di cPanel → **Security → SSH Access**.
> Verifikasi ulang dari komputer kamu sebelum mengisi secret:
> ```powershell
> Resolve-DnsName raypurba.my.id -Type A          # cek IP terkini
> Test-NetConnection 202.155.137.39 -Port 64000   # TcpTestSucceeded: True = SSH terbuka
> ```

---

## 3. WAJIB diselesaikan dulu: push ke GitHub akan ditolak (file > 100 MB)

Repo lokal saat ini **divergen** dari GitHub (`main` ahead 1, behind 1) dan commit lokal
`837c6cd` membawa `public (2).zip` (117,8 MB) — **di atas batas keras GitHub 100 MB**.
Push akan selalu ditolak selama blob itu ada di commit yang dikirim.

Jalankan urutan ini di PowerShell (dari `D:\FORTOFOLIO\portfolio-laravel`).
Zip besar **tidak dihapus dari disk**, hanya berhenti di-track:

```powershell
git fetch origin
git checkout origin/main -- README.md   # pertahankan update README dari GitHub
git reset --soft origin/main            # HEAD pindah ke posisi GitHub, semua perubahan kerja tetap
git add -A                              # stage seluruh kondisi kerja sekarang (+ file workflow baru)
git rm --cached "12.zip" "porto.zip" "public.zip" "ray.zip" "public (2).zip" "fix-views.zip" "config.zip"
git commit -m "Update portfolio, admin features, dan auto-deploy DomaiNesia"
git push origin main
```

Setelah ini push pertama akan **memicu workflow secara otomatis**.

> Catatan: `config.zip` ikut dilepas karena hanya arsip; kalau kamu masih butuh arsipnya,
> filenya tetap ada di disk lokal. `.gitignore` sudah diperbarui (`/*.zip`) supaya tidak ter-track lagi.
> Jika push masih ditolak dengan pesan "file size limit", cek file besar yang tersisa:
> `git rev-list --objects main | ForEach-Object { $p = $_ -split ' ',2; $s = git cat-file -s $p[0] 2>$null; if ([long]$s -gt 90MB) { "{0:N1} MB {1}" -f ($s/1MB), $p[1] } }`

---

## 4. GitHub Secrets yang wajib diisi

Repo GitHub → **Settings → Secrets and variables → Actions → New repository secret**.
(Jangan pernah menaruh nilai ini di file workflow.)

| Secret | Nilai | Keterangan |
|---|---|---|
| `SSH_HOST` | `202.155.137.39` | IP publik terverifikasi. Ganti hanya jika cPanel/SSH Access menunjukkan host yang berbeda. |
| `SSH_PORT` | `64000` | Port SSH DomaiNesia (port 22 tertutup). |
| `SSH_USER` | `raycodem` | Username cPanel. |
| `SSH_PRIVATE_KEY` | isi lengkap file private key | Lihat langkah 5. Termasuk baris `-----BEGIN/END ...-----`. |

Semua kredensial hanya lewat Secrets — tidak ada yang di-hardcode di workflow.

---

## 5. Membuat & memasang SSH key (sekali saja)

### 5a. Generate key di komputer (PowerShell)

```powershell
ssh-keygen -t ed25519 -C "github-actions-deploy" -f $env:USERPROFILE\.ssh\domenesia_deploy
```

Saat diminta passphrase: **tekan Enter dua kali** (kosongkan — runner tidak bisa membuka key ber-passphrase).

### 5b. Pasang public key di cPanel (WAJIB)

```powershell
Get-Content $env:USERPROFILE\.ssh\domenesia_deploy.pub
```

1. cPanel → **Security → SSH Access → Manage SSH Keys → Import Key**
2. Paste isi `.pub` → Import
3. Klik **Manage** di key tersebut → **Authorize** ← langkah yang paling sering terlupa
   (tanpa ini hasilnya selalu `Permission denied (publickey)`)

### 5c. Tes dari komputer SEBELUM ke GitHub

```powershell
ssh -p 64000 -i $env:USERPROFILE\.ssh\domenesia_deploy raycodem@202.155.137.39 "echo OK && hostname && pwd"
```

Harus membalas `OK`. Jika gagal, jangan lanjut — cek authorize di cPanel / hubungi support DomaiNesia.

### 5d. Isi secret

```powershell
Get-Content $env:USERPROFILE\.ssh\domenesia_deploy -Raw | Set-Clipboard
```

Paste ke GitHub secret `SSH_PRIVATE_KEY` (termasuk baris BEGIN/END).

---

## 6. Menjalankan deploy pertama

1. Push ke `main` (langkah 3) → workflow `Deploy ke DomaiNesia` berjalan otomatis;
   atau GitHub → **Actions → Deploy ke DomaiNesia → Run workflow**.
2. Perhatikan log tiap step:
   - **Preflight** — di sinilah terlihat apakah `.env` sudah ada di server, PHP CLI, disk, dan kondisi public_html.
   - **Upload** — log akan bilang `rsync incremental` atau `fallback tar`.
   - **Post-deploy** — semua langkah Laravel, tanpa menyentuh `.env`.
   - **Verifikasi** — marker commit + manifest Vite harus `[OK]`.
3. Selesai. Buka tab **Summary** run untuk ringkasan.

> **Informasi yang belum diketahui & risikonya (transparan):**
> - Apakah `/home/raycodem/portfolio-laravel/.env` sudah ada di server → preflight akan melaporkan.
>   Jika **belum ada**: upload tetap sukses, tapi langkah artisan dilewati dan aplikasi belum
>   bisa jalan sampai `.env` dibuat manual (lihat bagian 9). Workflow tidak akan menimpanya.
> - Apakah server punya `rsync` → otomatis fallback ke `tar` jika tidak.
> - GitHub runner harus bisa menjangkau `202.155.137.39:64000` (biasanya tidak difilter;
>   terbukti dari jaringan lokal). Jika run pertama gagal connect, hubungi support DomaiNesia.

---

## 7. Yang di-deploy / tidak di-deploy (rsync)

- **Di-deploy**: `app/`, `resources/`, `routes/`, `public/` (termasuk `public/build` hasil Vite), `vendor/` (hasil composer no-dev), `lang/`, `config/`, dll.
- **Tidak disentuh di server**: `.env`, `storage/` (upload admin, log, sesi), `bootstrap/cache/` (cache di-rebuild), `public/storage` (symlink), `.deploy/`.
- **Tidak di-upload**: `.git`, `.github`, `node_modules`, `tests`, `.design/`, dan semua `*.zip` root (repo kamu menyimpan arsip besar di root — sengaja di-skip).

Karena `routes/web.php` memakai Closure (`sitemap.xml`, `robots.txt`, `/clear`, switch locale),
workflow **tidak** memakai `artisan optimize`/`route:cache` (pasti gagal). Yang dipakai hanya
`config:cache` dan `view:cache` — keduanya aman.

---

## 8. Migrasi database & konten

- Workflow menjalankan `migrate --force --graceful` setiap deploy:
  **tidak pernah** menghapus/mengosongkan data.
- Jika DB production diimpor dari `database.sql` (skenario yang disiapkan repo ini),
  tabel sudah ada tapi tabel `migrations` tidak — perintah akan melaporkan error per-migrasi
  dan `.env`/situs tetap jalan. Ini normal, bukan kegagalan deploy.
- Ingin membuat DB dari nol: buat database + user di **cPanel → MySQL® Databases**,
  isi kredensial di `.env` server, lalu jalankan manual via cPanel Terminal/SSH:
  ```bash
  cd ~/portfolio-laravel
  /opt/cpanel/ea-php83/root/usr/bin/php artisan migrate --force
  /opt/cpanel/ea-php83/root/usr/bin/php artisan db:seed   # hanya jika DB kosong & memang mau seed
  ```
  (Workflow tidak pernah menjalankan seed.)

---

## 9. `.env` produksi (dibuat manual di server, tidak pernah dari CI)

Jika preflight melaporkan `.env` tidak ada, buat via cPanel Terminal/SSH di
`~/portfolio-laravel/.env`. Template (isi nilai yang sebenarnya):

```env
APP_NAME="Ray Putra Purba"
APP_ENV=production
APP_DEBUG=false
APP_URL=https://raypurba.my.id
APP_KEY=

APP_LOCALE=id
APP_FALLBACK_LOCALE=id

LOG_LEVEL=error

DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=raycodem_portfolio
DB_USERNAME=raycodem_portfolio
DB_PASSWORD=...

SESSION_DRIVER=database
CACHE_STORE=database
QUEUE_CONNECTION=database
FILESYSTEM_DISK=local

MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=
MAIL_PASSWORD=
MAIL_FROM_ADDRESS=

OPENROUTER_API_KEY=
```

Lalu generate APP_KEY (sekali):

```bash
cd ~/portfolio-laravel
/opt/cpanel/ea-php83/root/usr/bin/php artisan key:generate
```

Workflow deploy berikutnya akan otomatis menjalankan `storage:link`, cache, dll.

---

## 10. Domain `raypurba.my.id` & WordPress di `public_html` (RENCANA AMAN — belum dieksekusi)

Saat ini `public_html` masih berisi WordPress dan workflow **tidak menyentuhnya**.
Jadi setelah deploy, file Laravel sudah rapi di server tapi domain utama **belum**
menyajikan Laravel. Langkah aman yang disarankan, berurutan:

1. **Tes lewat subdomain dulu** (tanpa mengganggu WordPress):
   cPanel → **Domains → Create A New Domain** → subdomain, mis. `laravel.raypurba.my.id`,
   Document Root diarahkan ke `/home/raycodem/portfolio-laravel/public`.
   Aktifkan SSL (AutoSSL/Let's Encrypt) untuk subdomain itu.
2. Buka subdomain → pastikan semua fitur jalan (home 3D, admin login, upload gambar,
   chatbot). Upload admin tersimpan di `storage/` dan tersaji via `public/storage`.
3. **Jika sudah mantap dan ingin memindahkan domain utama**:
   - Backup WordPress dulu: file `public_html` + export database via phpMyAdmin.
   - Baru pindahkan document root `raypurba.my.id` ke `/home/raycodem/portfolio-laravel/public`
     (cPanel → Domains, atau minta bantuan support DomaiNesia jika panel tidak mengizinkan).
   - Jalankan AutoSSL untuk domain utama.
4. **Jangan** menghapus isi `public_html` dan **jangan** membuat symlink
   `public_html → portfolio-laravel/public` selama WordPress masih dipakai.

Setelah document root pindah, update `APP_URL` di `.env` server jika berubah,
lalu push sekali (atau Run workflow) agar cache config di-refresh.

---

## 11. Troubleshooting

| Gejala | Penyebab umum | Solusi |
|---|---|---|
| Push ditolak `exceeds GitHub's file size limit` | Masih ada file >100 MB di commit | Ulangi langkah bagian 3 |
| `Permission denied (publickey)` | Key belum di-Authorize di cPanel | Bagian 5b, tes 5c dulu |
| `ssh-keyscan gagal` di log | Host/port salah atau diblokir | Cek `SSH_HOST`/`SSH_PORT`; koneksi tetap lanjut via accept-new |
| `rsync: command not found` | rsync tidak ada di server | Otomatis fallback `tar` (lihat log); tidak ada aksi |
| HTTP 500 di Laravel | `.env`/APP_KEY kosong, permission storage | Cek log: `ssh ... "tail -n 50 ~/portfolio-laravel/storage/logs/laravel.log"` |
| Migrate error "table already exists" | DB dari import `database.sql` (tanpa tabel migrations) | Normal — graceful; situs tetap jalan |
| CSS/JS lama setelah deploy | Browser cache / view cache | Hard refresh; cek log step `view:cache` |
| Cron lama error `npm not found` | Cron deploy lama masih aktif | cPanel → Cron Jobs → hapus cron lama (build sekarang di GitHub Actions) |
| Deploy sukses tapi domain masih WordPress | `public_html` masih docroot WordPress | Bagian 10 (pindah docroot lewat subdomain tes dulu) |

---

## 12. Update rutin selanjutnya

```powershell
git add .
git commit -m "update"
git push origin main
```

Workflow jalan otomatis, ±3–8 menit (deploy berikutnya lebih cepat karena rsync incremental).
