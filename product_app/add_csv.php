<?php
// Membaca file CSV dan menampilkan data dalam tabel HTML
$filename = 'employees.csv';

if (($handle = fopen($filename, 'r')) !== FALSE) {
    echo "<table border='1'>";
    echo "<tr><th>ID</th><th>Nama</th><th>Posisi</th><th>Gaji</th></tr>";

    while (($data = fgetcsv($handle, 1000, ',')) !== FALSE) {
        echo "<tr>";
        foreach ($data as $cell) {
            echo "<td>" . htmlspecialchars($cell) . "</td>";
        }
        echo "</tr>";
    }

    echo "</table>";
    fclose($handle);
} else {
    echo "Gagal membuka file.";
}
?>

<!-- Form HTML untuk menambahkan data baru ke file CSV -->
<h2>Tambah Data Karyawan</h2>
<form action="add_employee.php" method="post">
    <label for="id">ID:</label>
    <input type="text" name="id" required><br>

    <label for="name">Nama:</label>
    <input type="text" name="name" required><br>

    <label for="position">Posisi:</label>
    <input type="text" name="position" required><br>

    <label for="salary">Gaji:</label>
    <input type="number" name="salary" required><br>

    <input type="submit" value="Tambah Data">
</form>
