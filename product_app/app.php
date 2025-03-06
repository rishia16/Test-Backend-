<?php
$inputFile = 'names.txt';
$outputFile = 'sorted_names.txt';

if (file_exists($inputFile)) {
    $names = file($inputFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

    sort($names);

    // Tulis hasil yang sudah diurutkan ke file baru
    file_put_contents($outputFile, implode(PHP_EOL, $names));

    echo "Nama-nama berhasil diurutkan dan disimpan di $outputFile";
} else {
    echo "File $inputFile tidak ditemukan.";
}
?>