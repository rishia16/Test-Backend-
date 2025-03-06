<?php
include_once '../../config/Database.php';
include_once '../../jwt/JwtHandler.php';
header('Content-Type: application/json');

$headers = getallheaders();
$jwt = new JwtHandler();

try {
    if (!isset($headers['Authorization'])) {
        echo json_encode(["message" => "Authorization token not provided"]);
        http_response_code(401);
        exit();
    }

    $token = str_replace('Bearer ', '', $headers['Authorization']);
    $decoded = $jwt->decode($token);

    $input = file_get_contents("php://input");
    $data = json_decode($input);

    if (json_last_error() !== JSON_ERROR_NONE) {
        echo json_encode(["message" => "Invalid JSON format", "error" => json_last_error_msg()]);
        http_response_code(400);
        exit();
    }

    if (!isset($data->product_code, $data->product_name, $data->price, $data->stock)) {
        echo json_encode(["message" => "Incomplete product data"]);
        http_response_code(400);
        exit();
    }

    $db = (new Database())->getConnection();

    $query = "INSERT INTO product (product_code, product_name, price, stock) VALUES (?, ?, ?, ?)";
    $stmt = $db->prepare($query);

    if ($stmt->execute([$data->product_code, $data->product_name, $data->price, $data->stock])) {
        echo json_encode(["message" => "Product created successfully"]);
        http_response_code(201);
    } else {
        echo json_encode(["message" => "Failed to create product"]);
        http_response_code(500);
    }

} catch (Exception $e) {
    echo json_encode(["message" => "Unauthorized", "error" => $e->getMessage()]);
    http_response_code(401);
}
?>
