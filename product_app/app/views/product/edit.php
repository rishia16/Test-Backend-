<!DOCTYPE html>
<html>
<head>
    <title>Edit Product</title>
</head>
<body>
    <h2>Edit Product</h2>
    <?php
    require_once '../../controllers/ProductController.php';
    $controller = new ProductController();
    $product = $controller->getByCode($_GET['code']);

    if (!$product) {
        echo "<p>Product not found.</p>";
        exit;
    }
    ?>

    <form method="POST" action="update.php">
        <input type="hidden" name="product_code" value="<?php echo $product['product_code']; ?>">
        <label>Product Name:</label><input type="text" name="product_name" value="<?php echo $product['product_name']; ?>" required><br>
        <label>Price:</label><input type="number" name="price" value="<?php echo $product['price']; ?>" required><br>
        <label>Stock:</label><input type="number" name="stock" value="<?php echo $product['stock']; ?>" required><br>
        <button type="submit">Update</button>
    </form>
</body>
</html>
