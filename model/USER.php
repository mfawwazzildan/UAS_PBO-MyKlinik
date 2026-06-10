<?php
require_once "model.php";

class User extends Model {

    protected $table = "admin";

    public function info() {
        return "User";
    }

    public function login($username, $password) {
        $password = md5($password);

        $query = "SELECT * FROM {$this->table}
                  WHERE username='$username' AND password='$password'";

        $result = $this->conn->query($query);

        return $result->num_rows > 0;
    }

}
?>