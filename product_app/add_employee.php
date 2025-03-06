<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $filename = 'employees.csv';

    $id = $_POST['id'];
    $name = $_POST['name'];
    $position = $_POST['position'];
    $salary = $_POST['salary'];

    $newData = [$id, $name, $position, $salary];

    if (($handle = fopen($filename, 'a')) !== FALSE) {
        fputcsv($handle, $newData);
        fclose($handle);
        echo "Data berhasil ditambahkan.";
    } else {
        echo "Gagal membuka file.";
    }
}
?>

<a href="index.php">Kembali ke daftar karyawan</a>
