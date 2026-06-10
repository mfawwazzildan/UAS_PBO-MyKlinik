<?php
require_once "klinik.php";

class Dokter extends Klinik {

    public function __construct() {
        parent::__construct("dokter");
    }

    public function info() {
        return "Data Dokter";
    }
}
?>