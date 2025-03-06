<?php
// app/models/Sales.php
class Sales {
    private $conn;
    private $table = 'sales';

    public $sales_reference;
    public $sales_date;
    public $product_code;
    public $quantity;
    public $price;
    public $subtotal;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Get all sales records
    public function getAll() {
        $query = "SELECT * FROM " . $this->table;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Get a single sales record by reference
    public function getByReference($sales_reference) {
        $query = "SELECT * FROM " . $this->table . " WHERE sales_reference = :sales_reference";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':sales_reference', $sales_reference);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Create a new sales record
    public function create() {
        $query = "INSERT INTO " . $this->table . " (sales_reference, sales_date, product_code, quantity, price, subtotal) 
                  VALUES (:sales_reference, :sales_date, :product_code, :quantity, :price, :subtotal)";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':sales_reference', $this->sales_reference);
        $stmt->bindParam(':sales_date', $this->sales_date);
        $stmt->bindParam(':product_code', $this->product_code);
        $stmt->bindParam(':quantity', $this->quantity);
        $stmt->bindParam(':price', $this->price);
        $stmt->bindParam(':subtotal', $this->subtotal);

        return $stmt->execute();
    }

    // Update an existing sales record
    public function update() {
        $query = "UPDATE " . $this->table . " SET sales_date = :sales_date, product_code = :product_code, quantity = :quantity, price = :price, subtotal = :subtotal 
                  WHERE sales_reference = :sales_reference";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':sales_reference', $this->sales_reference);
        $stmt->bindParam(':sales_date', $this->sales_date);
        $stmt->bindParam(':product_code', $this->product_code);
        $stmt->bindParam(':quantity', $this->quantity);
        $stmt->bindParam(':price', $this->price);
        $stmt->bindParam(':subtotal', $this->subtotal);

        return $stmt->execute();
    }

    // Delete a sales record
    public function delete($sales_reference) {
        $query = "DELETE FROM " . $this->table . " WHERE sales_reference = :sales_reference";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':sales_reference', $sales_reference);

        return $stmt->execute();
    }
}
?>