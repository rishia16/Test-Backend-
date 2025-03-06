<?php
require_once '../../controllers/ProductController.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller = new ProductController();
    $controller->create($_POST);
}

?>

