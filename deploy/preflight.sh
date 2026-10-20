#!/usr/bin/env bash
# ==============================================================================
# Preflight check server DomaiNesia - READ-ONLY (hanya mkdir -p APP_DIR).
# Dijalankan oleh .github/workflows/main.yml via:
#   ssh ... "APP_DIR=... PHP_BIN=... bash -s" < deploy/preflight.sh
#
# Tujuan: memastikan target deploy aman SEBELUM file apa pun di-upload,
# dan mencatat konfigurasi hosting TANPA membocorkan rahasia.
# ==============================================================================
set -euo pipefail

APP_DIR="${APP_DIR:-$HOME/portfolio-laravel}"
PHP_BIN="${PHP_BIN:-/opt/cpanel/ea-php83/root/usr/bin/php}"

fail() { echo "[FAIL] $*"; exit 1; }
info() { echo "[INFO] $*"; }
warn() { echo "[WARN] $*"; }

info "Host     : $(hostname)"
info "Kernel   : $(uname -srm)"
info "Waktu    : $(date '+%Y-%m-%d %H:%M:%S %Z')"

# --- Pengaman target: jangan sampai menyentuh WordPress / public_html -------
case "$APP_DIR" in
  "$HOME"/*) : ;;
  *) fail "APP_DIR harus berada di dalam $HOME (sekarang: $APP_DIR)" ;;
esac
case "$APP_DIR" in
  "$HOME/public_html"|"$HOME/public_html/"*) fail "APP_DIR menunjuk ke public_html - dilarang." ;;
esac
if [ -f "$APP_DIR/wp-config.php" ]; then
  fail "APP_DIR berisi WordPress (wp-config.php) - dibatalkan demi keamanan."
fi

mkdir -p "$APP_DIR" || fail "Tidak bisa membuat $APP_DIR"
[ -w "$APP_DIR" ] || fail "$APP_DIR tidak writable oleh user $(whoami)"
info "APP_DIR  : $APP_DIR (siap, writable)"

# --- Status .env TANPA menampilkan isinya ----------------------------------
if [ -f "$APP_DIR/.env" ]; then
  info ".env     : ADA (akan dipertahankan, tidak pernah ditimpa)"
  if grep -q '^APP_KEY=base64:' "$APP_DIR/.env"; then
    info "APP_KEY  : terisi"
  else
    warn "APP_KEY  : kosong / tidak ada"
  fi
else
  warn ".env     : tidak ditemukan (aplikasi belum dikonfigurasi di server ini)"
fi

# --- PHP CLI ----------------------------------------------------------------
if [ -x "$PHP_BIN" ]; then
  info "PHP CLI  : $PHP_BIN"
  "$PHP_BIN" -v | head -n 1
else
  warn "PHP CLI  : $PHP_BIN tidak ada (script deploy akan mencari alternatif)"
fi

# --- rsync (menentukan metode upload) ----------------------------------------
if command -v rsync >/dev/null 2>&1; then
  info "rsync    : tersedia (upload incremental)"
else
  warn "rsync    : TIDAK tersedia (upload memakai fallback tar)"
fi

# --- Kapasitas disk -----------------------------------------------------------
info "Disk home: $(df -h "$HOME" | awk 'NR==2 {print $4 " tersedia dari " $2}')"

# --- Bagaimana website disajikan saat ini (hanya dibaca) ---------------------
if [ -d "$HOME/public_html" ] && [ ! -L "$HOME/public_html" ]; then
  if [ -f "$HOME/public_html/wp-config.php" ]; then
    info "public_html: masih berisi WordPress - tidak akan disentuh oleh deploy ini."
  else
    info "public_html: ada - tidak akan disentuh oleh deploy ini."
  fi
fi

info "Preflight selesai. Aman untuk lanjut upload."
