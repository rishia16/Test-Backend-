<form method="POST" action="../../api/sales/create.php">
    <label>Product:</label>
    <select name="product_code">
        <?php
        $response = file_get_contents('http://localhost/product_api/api/product/read.php');
        $products = json_decode($response);
        foreach ($products as $product) {
            echo "<option value='{$product->product_code}'>{$product->product_name}</option>";
        }
        ?>
    </select>
    <label>Quantity:</label>
    <input type="number" name="quantity" required />
    <button type="submit">Save Sale</button>
    <a href="index.php">Cancel</a>
</form>