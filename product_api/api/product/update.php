<?php
include_once '../../config/Database.php';
header('Content-Type: application/json');

$data = json_decode(file_get_contents("php://input"));
$db = (new Database())->getConnection();

$query = "UPDATE product SET product_name = ?, price = ?, stock = ? WHERE product_code = ?";
$stmt = $db->prepare($query);
$stmt->execute([$data->product_name, $data->price, $data->stock, $data->product_code]);

echo json_encode(["message" => "Product updated successfully"]);
?>