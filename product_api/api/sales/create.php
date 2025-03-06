<?php
include_once '../../config/Database.php';
header('Content-Type: application/json');

$data = json_decode(file_get_contents("php://input"));
$db = (new Database())->getConnection();

try {
    $query = "CALL process_sale(?, NOW(), ?, ?, ?)";
    $stmt = $db->prepare($query);
    $stmt->execute([
        $data->sales_reference,
        $data->product_code,
        $data->quantity,
        $data->price
    ]);

    echo json_encode(["message" => "Sale processed successfully"]);
} catch (PDOException $e) {
    echo json_encode(["message" => "Failed to process sale", "error" => $e->getMessage()]);
}
?>
