
<?php
// app/controllers/ProductController.php
require_once __DIR__ . '/../../config/Database.php';
require_once __DIR__ . '/../models/Product.php';

class ProductController {
    private $product;

    public function __construct() {
        $database = new Database();
        $db = $database->getConnection();
        $this->product = new Product($db);
    }

    public function index() {
        return $this->product->getAll()->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getByCode($code) {
        return $this->product->getByCode($code);
    }

    public function create($data) {
        $this->product->product_code = $data['product_code'];
        $this->product->product_name = $data['product_name'];
        $this->product->price = $data['price'];
        $this->product->stock = $data['stock'];

        if ($this->product->create()) {
            header('Location: /product_app/public/index.php');
        } else {
            echo "Failed to add product.";
        }
    }

    public function update($data) {
        $this->product->product_code = $data['product_code'];
        $this->product->product_name = $data['product_name'];
        $this->product->price = $data['price'];
        $this->product->stock = $data['stock'];

        if ($this->product->update()) {
            header('Location: /product_app/public/index.php');
        } else {
            echo "Failed to update product.";
        }
    }

    public function delete($product_code) {
        $this->product->product_code = $product_code;

        if ($this->product->delete()) {
            header('Location: /product_app/public/index.php');
        } else {
            echo "Failed to delete product.";
        }
    }
}
