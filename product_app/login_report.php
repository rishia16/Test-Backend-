<?php
// Array aktivitas
$activities = [
    'User_Login' => 'John Doe',
    'User_Logout' => 'John Doe',
    'User_Login' => 'Jane Smith'
];

// Menghitung jumlah aktivitas
$totalActivities = count($activities);

// Mendapatkan tanggal sekarang
$currentDate = date('Y-m-d');

// Isi laporan
$reportContent = "Laporan Harian\n";
$reportContent .= "Tanggal : $currentDate\n";
$reportContent .= "Total Aktivitas : $totalActivities\n";

// Menulis ke file report.txt
$filePath = 'report.txt';
if (file_put_contents($filePath, $reportContent)) {
    echo "Laporan berhasil dibuat di $filePath";
} else {
    echo "Gagal membuat laporan.";
}
?>
