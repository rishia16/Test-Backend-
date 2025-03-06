<!DOCTYPE html>
<html>
<head>
    <title>Create Product</title>
</head>
<body>
    <h2>Create Product</h2>
    <form method="POST" action="store.php">
        <label>Product Code:</label><input type="text" name="product_code" required><br>
        <label>Product Name:</label><input type="text" name="product_name" required><br>
        <label>Price:</label><input type="number" name="price" required><br>
        <label>Stock:</label><input type="number" name="stock" required><br>
        <button type="submit">Save</button>
    </form>
</body>
</html>