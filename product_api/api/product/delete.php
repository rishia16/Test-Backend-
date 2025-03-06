<?php
include_once '../../config/Database.php';
header('Content-Type: application/json');

$data = json_decode(file_get_contents("php://input"));
$db = (new Database())->getConnection();

$query = "DELETE FROM product WHERE product_code = ?";
$stmt = $db->prepare($query);
$stmt->execute([$data->product_code]);

echo json_encode(["message" => "Product deleted successfully"]);
?>