<?php
// app/models/Product.php
class Product {
    private $conn;
    private $table = 'product';

    public $product_code;
    public $product_name;
    public $price;
    public $stock;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getAll() {
        $query = "SELECT * FROM " . $this->table;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function getByCode($product_code) {
        $query = "SELECT * FROM " . $this->table . " WHERE product_code = :product_code";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':product_code', $product_code);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create() {
        $query = "INSERT INTO " . $this->table . " (product_code, product_name, price, stock) 
                  VALUES (:product_code, :product_name, :price, :stock)";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':product_code', $this->product_code);
        $stmt->bindParam(':product_name', $this->product_name);
        $stmt->bindParam(':price', $this->price);
        $stmt->bindParam(':stock', $this->stock);

        return $stmt->execute();
    }

    public function update() {
        $query = "UPDATE " . $this->table . " SET product_name = :product_name, price = :price, stock = :stock 
                  WHERE product_code = :product_code";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':product_code', $this->product_code);
        $stmt->bindParam(':product_name', $this->product_name);
        $stmt->bindParam(':price', $this->price);
        $stmt->bindParam(':stock', $this->stock);

        return $stmt->execute();
    }

    public function delete() {
        // Cek apakah product_code masih dipakai di sales
        $query = "SELECT COUNT(*) FROM sales WHERE product_code = :product_code";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':product_code', $this->product_code);
        $stmt->execute();
        $count = $stmt->fetchColumn();
    
        if ($count > 0) {
            echo "Produk ini masih digunakan dalam transaksi penjualan. Tidak bisa dihapus.";
            return false;
        }
    
        // Kalau nggak dipakai, baru hapus
        $query = "DELETE FROM " . $this->table . " WHERE product_code = :product_code";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':product_code', $this->product_code);
    
        return $stmt->execute();
    }
    
    }
    ?>