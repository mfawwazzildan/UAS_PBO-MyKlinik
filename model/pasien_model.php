<?php
require_once "klinik.php";

class Pasien extends Klinik {

    public function __construct() {
        parent::__construct("pasien");
    }

    public function info() {
        return "Data Pasien";
    }
}
?>