/**
 * Konversi gambar PNG/JPG besar di storage/app/public/uploads ke WebP.
 * File asli TIDAK dihapus — hanya varian .webp yang dibuat di sampingnya
 * untuk <picture> (fallback tetap berfungsi).
 *
 * Pakai: npm run webp
 */
import fs from 'node:fs/promises';
import path from 'node:path';
import sharp from 'sharp';

const ROOT = path.resolve(process.cwd(), 'storage/app/public/uploads');
const EXT_RE = /\.(png|jpe?g)$/i;
const SKIP_RE = /\.(webp|gif|svg)$/i;

async function walk(dir) {
    const out = [];
    for (const entry of await fs.readdir(dir, { withFileTypes: true })) {
        const full = path.join(dir, entry.name);
        if (entry.isDirectory()) out.push(...(await walk(full)));
        else if (!SKIP_RE.test(entry.name)) out.push(full);
    }
    return out;
}

async function main() {
    let files;
    try {
        files = await walk(ROOT);
    } catch {
        console.log('[webp] Folder uploads tidak ditemukan — selesai.');
        return;
    }

    for (const file of files) {
        if (!EXT_RE.test(file)) continue;
        const out = file.replace(EXT_RE, '.webp');
        try {
            const [srcStat, outStat] = await Promise.all([fs.stat(file), fs.stat(out).catch(() => null)]);
            // Lewati jika varian sudah ada dan lebih baru / sisa sama.
            if (outStat && outStat.mtimeMs >= srcStat.mtimeMs) continue;

            // Logo/ikon kecil dengan transparansi: lossless-ish quality 90.
            // Foto besar: quality 80 + metode kompresi maksimal.
            const meta = await sharp(file).metadata();
            const isSmallIcon = Math.max(meta.width || 0, meta.height || 0) <= 128;
            await sharp(file)
                .webp({ quality: isSmallIcon ? 90 : 80, effort: 5, alphaQuality: 90 })
                .toFile(out);

            const saved = ((srcStat.size - (await fs.stat(out)).size) / 1024).toFixed(1);
            console.log(`[webp] ${path.relative(ROOT, file)} -> hemat ${saved} KB`);
        } catch (err) {
            console.warn(`[webp] Gagal: ${file}: ${err.message}`);
        }
    }
    console.log('[webp] Selesai.');
}

main();
