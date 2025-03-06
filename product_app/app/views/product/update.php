<?php
require_once '../../controllers/ProductController.php';

$controller = new ProductController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller->update($_POST);
}

$product = $controller->getByCode($_GET['product_code']);

if (!$product) {
    echo "<p>Product not found.</p>";
    exit;
}
?>
