<?php
include_once '../../config/Database.php';
header('Content-Type: application/json');

$db = (new Database())->getConnection();

// Ambil parameter
$name = isset($_GET['name']) ? "%" . $_GET['name'] . "%" : "%";
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$limit = 5; // Jumlah data per halaman
$offset = ($page - 1) * $limit;

try {
    $query = "SELECT * FROM product WHERE product_name LIKE ? LIMIT $limit OFFSET $offset";
    $stmt = $db->prepare($query);
    $stmt->execute([$name]);

    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Hitung total data
    $countQuery = "SELECT COUNT(*) AS total FROM product WHERE product_name LIKE ?";
    $countStmt = $db->prepare($countQuery);
    $countStmt->execute([$name]);
    $total = $countStmt->fetch(PDO::FETCH_ASSOC)['total'];

    echo json_encode([
        "page" => $page,
        "limit" => $limit,
        "total" => $total,
        "products" => $products
    ]);
} catch (Exception $e) {
    echo json_encode([
        "message" => "Error fetching products",
        "error" => $e->getMessage()
    ]);
}
?>
