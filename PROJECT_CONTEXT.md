# PORTFOLIO PROJECT CONTEXT

## Project
Laravel Portfolio - Ray Putra Purba

## Current Design
Portfolio menggunakan tema:
- dark futuristic
- navy/black background
- purple + cyan/blue glow
- animated particles
- subtle grid
- futuristic typography
- responsive desktop + mobile

## Important Rule
Jangan mengubah section yang sudah selesai kecuali diminta.

Jangan melakukan redesign besar-besaran.
Prioritaskan refinement dan animation quality.

---

# PROJECTS SECTION

Projects section dibuat sebagai large cinematic visual scene.

## Background
Projects background:
- dark navy/black
- purple ambient glow
- blue/cyan ambient glow
- animated particles
- subtle stars
- subtle grid/noise
- subtle parallax

Background harus tetap hidup ketika user scrolling.

## Featured Projects Title

Text:
"Featured Projects"

Fungsinya sebagai opening title Projects scene.

PENTING:
- jangan terlalu dekat dengan navbar
- jangan sampai teks terpotong navbar
- jangan dibuat sticky sepanjang scroll
- jangan terus berhenti di tengah viewport
- title berada di belakang project card

Title harus bergerak secara natural ketika scrolling.

---

# PROJECT CARD SCROLL ANIMATION

Target animation:

Project card dimulai dari bawah.

STATE 0:
- translateY besar
- scale sekitar 0.55 - 0.65
- opacity rendah
- sedikit blur

STATE 1:
- mulai masuk viewport
- bergerak naik
- scale meningkat
- opacity meningkat
- blur berkurang

STATE 2:
- card mendekati center
- scale sekitar 0.85 - 0.95

STATE 3:
- card full size
- menjadi fokus utama

Project card harus melewati / menutupi
Featured Projects title.

Title berada di belakang card.

---

# PROJECT SEQUENCE

Project 01:

small + bottom
↓
move upward
↓
scale up
↓
cover title
↓
full size
↓
focus

Kemudian:

Project 01
↓
bergerak ke atas
↓
sedikit mengecil

Project 02
↓
muncul dari bawah
↓
scale up
↓
focus

Ulangi untuk project berikutnya.

Jangan menampilkan semua project sekaligus.

---

# SCROLL PHILOSOPHY

Animasi harus mengikuti scroll user.

Scroll DOWN:
animation maju.

Scroll UP:
animation mundur.

Jangan menggunakan animation yang hanya
berjalan sendiri berdasarkan timer.

Gunakan scroll-linked animation.

Jika menggunakan GSAP:
GSAP ScrollTrigger + scrub dapat digunakan.

---

# CURRENT STATUS (TERVERIFIKASI)

Semua masalah scroll-timing dan title SUDAH DIPERBAIKI dan diverifikasi via CDP.

## Milestone scroll (Project 01) — sudah sesuai spec user:

| Scroll | Kondisi (terverifikasi CDP) |
|--------|-----------------------------|
| 0%   | title penuh, card belum muncul |
| 20%  | card mulai naik dari bawah (scale ~0.62), title mulai naik + fade |
| 40%  | card scale ~0.75 |
| 60%  | card scale ~0.87, menutupi title |
| 80%  | card FULL (scale 1.0), title sudah hilang |
| 100% | full + transisi ke project berikutnya |

Hasil verifikasi (desktop 1440x900 + mobile 390x844, reduced-motion ON):
- Maksimal 1 kartu yang terbaca, maksimal 1-2 saat handoff.
- Sticky pinned di semua posisi scroll.
- Title tidak tertabrak navbar: h2 top ~160px (navbar height 68px).
- Title tidak sticky, ikut scroll, berada di belakang card (z 6 vs slide z 700-1000).

## Implementasi saat ini

- `resources/js/projects-showcase.js`:
  - Custom scroll-mapper (rAF + requestAnimationFrame), TANPA GSAP.
  - `ARRIVE = 0.8` (card full di 80% scroll), `LEAVE = 0.45`, `HOLD = 0`.
  - `entryY = 0.8vh` desktop / `0.7vh` mobile.
  - arrival: `op = pArr^1.25`, `sc = 0.5 + 0.5*pArr` desktop.
  - Title drift: translateY naik + scale 0.94 + fade mengikuti arrival project 0.
  - `prefers-reduced-motion` branch: SKIP blur/rotate, TAPI tetap pakai
    satu-kartu-per-fokus yang sama (jangan diubah!).
- `resources/views/welcome.blade.php`:
  - `.projects-title` ada DI DALAM sticky, di belakang card (z 6).
  - `padding-top: 15vh` (jarak dari navbar), `h2 clamp(2.2rem,6.5vw,4.75rem)`,
    desktop `clamp(2.6rem,6.2vw,4.9rem)`.
  - `.projects-bg` living background (JANGAN diubah).
- `resources/js/projects-bg.js`: living background engine (JANGAN diubah).
- Struktur: `#projects` TIDAK boleh `overflow-hidden` (mematahkan sticky).
  `.projects-bg` sendiri yang punya overflow:hidden.

---

# IMPORTANT

Jangan membuat:
- landing page biasa
- project grid biasa
- card fade-in biasa
- title sticky sepanjang scroll
- random animations
- excessive effects

Target akhir:

Projects terasa seperti
ONE CINEMATIC INTERACTIVE SCENE.

User scroll perlahan dan dapat melihat
setiap tahap animasi.

---

# CARA JALANKAN

1. `npm run build` (Vite production build).
2. `php artisan serve --host=127.0.0.1 --port=8099`
3. Buka `http://127.0.0.1:8099/`
4. Opsional live-HMR: `npm run dev` (port 5173).
   Jika Vite dev aktif, page memakai dev bundle,
   jadi pastikan `npm run dev` berjalan saat mau cek source-refresh.

## Verifikasi

Script CDP (headless Chrome) di `C:\Users\ASUS\AppData\Local\Temp\opencode\`:
- `verify-timing.js` — milestone 0/20/40/60/80/100%, title geometry, sticky.
- `verify-final.js` — worst visible/readable cards, bg hidup, canvas.
- `verify-sticky.js`, `verify-layer.js`, `verify-mobile.js` — probe lain.
- `shot-px.js` — JANGAN dipakai (hang di page animated).

---

# NEXT STEPS (belum dikerjakan)

- [ ] Tanya user: rasakan scroll di `127.0.0.1:8099`, apakah timeline
      0/20/40/60/80/100 sudah pas dengan yang diinginkan.
- [ ] Jika ya, lanjutkan ke section lain (About / Experience / Contact)
      dengan style konsisten — hanya jika diminta user.
- [ ] Jangan redesign ulang Projects section tanpa diminta.

---
