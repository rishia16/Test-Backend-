<?php
include_once '../config/Database.php';
header('Content-Type: application/json');

$data = json_decode(file_get_contents("php://input"));
$db = (new Database())->getConnection();

if (!isset($data->username) || !isset($data->password)) {
    echo json_encode(["message" => "Username or password missing"]);
    exit();
}

$query = "INSERT INTO users (username, password) VALUES (?, ?)";
$stmt = $db->prepare($query);
$stmt->execute([$data->username, password_hash($data->password, PASSWORD_DEFAULT)]);

echo json_encode(["message" => "User registered successfully"]);
?>