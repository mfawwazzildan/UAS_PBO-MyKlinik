<?php
require_once "koneksi.php";

class Model {
    protected $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->conn;
    }

    public function info() {
        return "Model Induk";
    }
}
?>