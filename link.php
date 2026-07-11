<?php
$target = __DIR__ . '/storage/app/public';
$link = __DIR__ . '/public/storage';

if (is_link($link) || is_dir($link)) {
    echo "Storage link/directory already exists.";
    exit;
}

// Try symlink
if (function_exists('symlink') && @symlink($target, $link)) {
    echo "Storage link created successfully via symlink.";
    exit;
}

// Fallback: copy files directly
echo "Symlink not available. Copying files directly...\n";

function copyRecursive($src, $dst) {
    if (!is_dir($dst)) mkdir($dst, 0755, true);
    $items = array_diff(scandir($src), ['.', '..']);
    foreach ($items as $item) {
        $s = $src . '/' . $item;
        $d = $dst . '/' . $item;
        if (is_dir($s)) {
            copyRecursive($s, $d);
        } else {
            copy($s, $d);
        }
    }
}

if (is_dir($target . '/uploads')) {
    copyRecursive($target . '/uploads', $link . '/uploads');
    echo "Files copied to public/storage/uploads/ successfully!";
} else {
    echo "No uploads directory found in storage.";
}
