<!DOCTYPE html>
<html>
<head>
    <title>Product List</title>
</head>
<body>
<h2>Product List</h2>
    <a href="create.php">Tambah Produk</a>
    <table border="1">
        <tr>
            <th>Code</th>
            <th>Name</th>
            <th>Price</th>
            <th>Stock</th>
            <th>Action</th>
        </tr>
        <?php
        require_once '../../controllers/ProductController.php';
        $controller = new ProductController();
        $products = $controller->index();
        foreach ($products as $product) {
            echo "<tr>
                    <td>{$product['product_code']}</td>
                    <td>{$product['product_name']}</td>
                    <td>{$product['price']}</td>
                    <td>{$product['stock']}</td>
                    <td>
                        <a href='edit.php?code={$product['product_code']}'>Edit</a>
                        |
                        <a href='delete.php?code={$product['product_code']}' onclick=\"return confirm('Are you sure Delete this data?')\">Delete</a>
                        |
                    </td>
                  </tr>";
        }
        ?>
    </table>
</body>
</html>
