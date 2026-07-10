<?php
$target = __DIR__ . '/storage/app/public';
$link = __DIR__ . '/public/storage';

if (is_dir($link) || is_link($link)) {
    echo "Symlink already exists.";
} elseif (symlink($target, $link)) {
    echo "Storage link created successfully!";
} else {
    echo "Failed to create storage link. Check permissions.";
}
