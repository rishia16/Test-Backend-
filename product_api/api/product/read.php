<?php
include_once '../../config/Database.php';
header('Content-Type: application/json');

$db = (new Database())->getConnection();
$query = "SELECT * FROM product";
$stmt = $db->prepare($query);
$stmt->execute();

$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
echo json_encode($products);
?>