<?php
require_once "pelayanan_model.php";

class Laporan
{
    public function cetakLaporan(PelayananMedis $pelayanan)
    {
        return $pelayanan->getAll();
    }

    public function totalPendapatan(PelayananMedis $pelayanan)
    {
        $data = $pelayanan->getAll();

        $total = 0;

        while ($row = $data->fetch_assoc()) {
            $total += $row['biaya'];
        }

        return $total;
    }
}
?>