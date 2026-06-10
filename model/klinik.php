<?php
require_once "model.php";

class Klinik extends Model {
    protected $table;

    public function __construct($table) {
        parent::__construct();
        $this->table = $table;
    }

    public function getAll() {
        return $this->conn->query("SELECT * FROM {$this->table}");
    }

    public function getById($id) {
        return $this->conn->query("SELECT * FROM {$this->table} WHERE id='$id'");
    }

    public function delete($id) {
        return $this->conn->query("DELETE FROM {$this->table} WHERE id='$id'");
    }

    public function insert($data) {
        $fields = implode(",", array_keys($data));
        $values = implode("','", array_values($data));

        return $this->conn->query(
            "INSERT INTO {$this->table} ($fields) VALUES ('$values')"
        );
    }

    public function updateData($id, $data) {    
    $set = "";

    foreach ($data as $key => $value) {
        $set .= "$key='$value',";
    }

    $set = rtrim($set, ",");

    return $this->conn->query(
        "UPDATE {$this->table} SET $set WHERE id='$id'"
    );
}

    public function info() {
        return "Manajemen Klinik";
    }
}
?>