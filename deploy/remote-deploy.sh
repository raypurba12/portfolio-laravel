#!/usr/bin/env bash
# ==============================================================================
# Post-deploy di server DomaiNesia. Aman & idempotent:
#   - TIDAK pernah migrate:fresh / drop / rollback / seed
#   - TIDAK menimpa .env (milik server, diubah manual bila perlu)
#   - TIDAK menyentuh public_html (masih WordPress)
# Dijalankan oleh .github/workflows/main.yml via:
#   ssh ... "APP_DIR=... RUN_MIGRATIONS=... DEPLOY_SHA=... bash -s" < deploy/remote-deploy.sh
# ==============================================================================
set -uo pipefail   # tanpa -e: tiap langkah ditangani eksplisit agar tidak ada kejutan

APP_DIR="${APP_DIR:?APP_DIR wajib diisi}"
PHP_BIN="${PHP_BIN:-/opt/cpanel/ea-php83/root/usr/bin/php}"
RUN_MIGRATIONS="${RUN_MIGRATIONS:-true}"
DEPLOY_SHA="${DEPLOY_SHA:-unknown}"

info() { echo "[INFO] $*"; }
warn() { echo "[WARN] $*"; }

cd "$APP_DIR" || { echo "[FAIL] tidak bisa masuk ke $APP_DIR"; exit 1; }

# 1) Pastikan PHP CLI >= 8.2 ------------------------------------------------
if [ ! -x "$PHP_BIN" ]; then
  for c in \
    /opt/cpanel/ea-php83/root/usr/bin/php \
    /opt/cpanel/ea-php82/root/usr/bin/php \
    /usr/local/bin/ea-php83 \
    /usr/bin/php8.3 /usr/bin/php8.2; do
    if [ -x "$c" ]; then PHP_BIN="$c"; break; fi
  done
fi
if [ ! -x "$PHP_BIN" ] && command -v php >/dev/null 2>&1; then
  PHP_BIN="$(command -v php)"
fi
[ -x "$PHP_BIN" ] || { echo "[FAIL] PHP CLI tidak ditemukan di server."; exit 1; }
info "PHP: $("$PHP_BIN" -r 'echo PHP_VERSION;') ($PHP_BIN)"

# 2) Direktori runtime wajib (idempotent, tidak menghapus apa pun) -----------
mkdir -p \
  storage/app/public storage/app/private \
  storage/framework/cache/data storage/framework/sessions storage/framework/views \
  storage/logs bootstrap/cache

# 3) .env adalah milik server - jangan pernah diubah dari CI -----------------
if [ ! -f .env ]; then
  warn ".env tidak ada. Langkah artisan dilewati (lihat DEPLOY_DOMENESIA.md cara mengisi)."
elif ! grep -q '^APP_KEY=base64:' .env; then
  warn "APP_KEY kosong. Jalankan manual di server: $PHP_BIN artisan key:generate"
else
  # 4) storage:link hanya dibuat jika belum ada (dibutuhkan upload admin) ----
  if [ ! -L public/storage ]; then
    "$PHP_BIN" artisan storage:link || warn "storage:link gagal (lanjut)"
  else
    info "public/storage sudah berupa symlink."
  fi

  # 5) Migrasi aman: tanpa fresh/drop; --graceful agar kegagalan TIDAK
  #    menggagalkan deploy dan TIDAK pernah menghapus data.
  #    Catatan: jika DB berasal dari import database.sql (tanpa tabel
  #    "migrations"), perintah ini akan melaporkan error per-migrasi - normal.
  if [ "$RUN_MIGRATIONS" = "true" ]; then
    "$PHP_BIN" artisan migrate --force --graceful || warn "migrate melaporkan error (aman, tidak ada data terhapus)"
  else
    info "Migrasi dilewati (dipilih manual)."
  fi

  # 6) Cache ringan. SENGAJA tidak memakai 'artisan optimize' / route:cache
  #    karena routes/web.php memakai Closure (tidak bisa di-cache). ---------
  "$PHP_BIN" artisan config:cache || warn "config:cache gagal"
  "$PHP_BIN" artisan view:cache  || warn "view:cache gagal"
fi

# 7) Marker deploy untuk verifikasi di sisi workflow -------------------------
mkdir -p .deploy
printf '%s\n' "$DEPLOY_SHA" > .deploy/current_sha
info "Marker deploy: $DEPLOY_SHA"

info "Post-deploy selesai."
