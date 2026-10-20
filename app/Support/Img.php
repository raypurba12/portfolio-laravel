<?php

namespace App\Support;

use Illuminate\Support\Facades\Storage;

/**
 * Helper optimasi gambar untuk view.
 * - webpVariant(): kembalikan URL varian .webp jika file turunannya ada
 *   di storage (dibuat oleh `npm run webp`). Tidak mengubah data DB —
 *   file asli tetap sebagai fallback di <picture>.
 */
class Img
{
    public static function webpVariant(?string $path): ?string
    {
        if (!$path || preg_match('~^https?://~i', $path)) {
            return null;
        }

        $rel = preg_replace('~^public/~', '', $path);
        $webpRel = preg_replace('~\.(png|jpe?g)$~i', '.webp', $rel);

        if ($webpRel === null || $webpRel === $rel) {
            return null;
        }

        if (!Storage::disk('public')->exists($webpRel)) {
            return null;
        }

        return Storage::url($webpRel);
    }
}
