<?php
include_once '../config/Database.php';

$db = (new Database())->getConnection();
$username = 'testuser';
$password = password_hash('password123', PASSWORD_DEFAULT);

$query = "UPDATE users SET password = ? WHERE username = ?";
$stmt = $db->prepare($query);
$stmt->execute([$password, $username]);

echo "Password updated!";
?>