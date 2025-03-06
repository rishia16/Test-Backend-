<?php
include_once '../../config/Database.php';
header('Content-Type: application/json');

$db = (new Database())->getConnection();

$query = "CALL get_top_product()";
$stmt = $db->prepare($query);
$stmt->execute();

$top_products = $stmt->fetchAll(PDO::FETCH_ASSOC);
echo json_encode($top_products);
?>
