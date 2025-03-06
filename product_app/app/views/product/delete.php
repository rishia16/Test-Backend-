<?php
// app/views/product/delete.php

require_once '../../controllers/ProductController.php';

if (isset($_GET['code'])) {
    $controller = new ProductController();
    $controller->delete($_GET['code']);
} else {
    echo "Invalid product code.";
}
?>
