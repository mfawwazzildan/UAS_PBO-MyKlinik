<?php
require_once "klinik.php";
require_once "pasien_model.php"; 
require_once "dokter_model.php";

class PelayananMedis extends Klinik
{

    private $pasienModel;
    private $dokterModel;

    public function __construct(Pasien $pasien, Dokter $dokter)
    {
        parent::__construct("pelayanan_medis");
        
        $this->pasienModel = $pasien;
        $this->dokterModel = $dokter;
    }

    public function info()
    {
        return "Data Pelayanan Medis";
    }

    public function getAll()
    {
        return $this->conn->query("
            SELECT pm.*, p.nama AS pasien, d.nama AS dokter
            FROM pelayanan_medis pm
            JOIN pasien p ON pm.pasien_id = p.id
            JOIN dokter d ON pm.dokter_id = d.id
        ");
    }

    public function getPasien()
    {
        return $this->pasienModel->getAll(); 
    }

    public function getDokter()
    {
        return $this->dokterModel->getAll(); 
    }

    public function getByIdPelayanan($id)
    {
        return $this->conn->query("
            SELECT * FROM pelayanan_medis
            WHERE id='$id'
        ");
    }
}