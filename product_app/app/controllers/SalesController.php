<?php
require_once __DIR__ . '/../models/Sales.php';
require_once __DIR__ . '/../../config/Database.php';



class SalesController {
    private $db;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
    }

    public function index() {
        $sales = new Sales($this->db);
        $allSales = $sales->getAll();
        include __DIR__ . '/../views/sales/index.php';
    }

    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $sales = new Sales($this->db);
            $sales->sales_reference = $_POST['sales_reference'];
            $sales->sales_date = $_POST['sales_date'];
            $sales->product_code = $_POST['product_code'];
            $sales->quantity = $_POST['quantity'];
            $sales->price = $_POST['price'];
            $sales->subtotal = $_POST['subtotal'];

            $sales->create();
            header('Location: /public/index.php?controller=sales&action=index');
        } else {
            include __DIR__ . '/../views/sales/create.php';
        }
    }

    public function delete($sales_reference) {
        $sales = new Sales($this->db);
        $sales->delete($sales_reference);
        header('Location: /public/index.php?controller=sales&action=index');
    }
}
?>
