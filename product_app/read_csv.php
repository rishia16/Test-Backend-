<?php
// Buka file CSV
$file = fopen('employees.csv', 'r');

// Baca header
$headers = fgetcsv($file);

// Tampilkan tabel HTML
echo "<table border='1'>";
echo "<tr><th>ID</th><th>Nama</th><th>Posisi</th><th>Gaji</th></tr>";

// Baca isi file baris per baris
while ($row = fgetcsv($file)) {
    echo "<tr>";
    echo "<td>{$row[0]}</td>";
    echo "<td>{$row[1]}</td>";
    echo "<td>{$row[2]}</td>";
    echo "<td>{$row[3]}</td>";
    echo "</tr>";
}

// Tutup file
fclose($file);

echo "</table>";
?>
