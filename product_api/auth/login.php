<?php
include_once '../config/Database.php';
include_once '../jwt/JwtHandler.php';
header('Content-Type: application/json');

$data = json_decode(file_get_contents("php://input"));

if (!isset($data->username) || !isset($data->password)) {
    echo json_encode(["message" => "Username or password missing"]);
    exit();
}

$db = (new Database())->getConnection();

$query = "SELECT * FROM users WHERE username = ?";
$stmt = $db->prepare($query);
$stmt->execute([$data->username]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user || !password_verify($data->password, $user['PASSWORD'])) {
    echo json_encode(["message" => "Invalid credentials"]);
    exit();
}

$jwt = new JwtHandler();
$token = $jwt->encode(["user_id" => $user['id']]);

echo json_encode(["token" => $token]);
?>