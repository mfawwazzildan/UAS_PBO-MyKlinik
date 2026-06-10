<?php
require_once "USER.php";

class Admin extends User {
    protected $table = "admin";

    public function info() {
        return "Data Administrasi Sistem (Admin)";
    }

    public function tampil() {
        return $this->conn->query("SELECT * FROM {$this->table}");
    }

    public function tambah($username, $password) {
        $password = md5($password);
        return $this->conn->query("
            INSERT INTO {$this->table} (username, password)
            VALUES ('$username','$password')
        ");
    }

    public function hapus($id) {
        return $this->conn->query("DELETE FROM {$this->table} WHERE id='$id'");
    }

    public function getById($id) {
        return $this->conn->query("SELECT * FROM {$this->table} WHERE id='$id'");
    }

    public function update($id, $username, $password = null) {
        if (!empty($password)) {
            $password = md5($password);
            return $this->conn->query("UPDATE {$this->table} SET username='$username', password='$password' WHERE id='$id'");
        } else {
            return $this->conn->query("UPDATE {$this->table} SET username='$username' WHERE id='$id'");
        }
    }
}
?>