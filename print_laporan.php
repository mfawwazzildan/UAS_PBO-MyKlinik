<?php
require_once "model/pasien_model.php";
require_once "model/dokter_model.php";
require_once "model/pelayanan_model.php";
require_once "model/laporan_model.php";

$pasien = new Pasien();
$dokter = new Dokter();

$pelayanan = new PelayananMedis($pasien, $dokter);

$laporan = new Laporan();

// Dependency
$data = $laporan->cetakLaporan($pelayanan);
$total = $laporan->totalPendapatan($pelayanan);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Laporan Pelayanan Medis</title>
</head>
<body onload="window.print()">

<h2 align="center">Laporan Pelayanan Medis</h2>

<table border="1" width="100%" cellspacing="0" cellpadding="5">
    <tr>
        <th>No</th>
        <th>Pasien</th>
        <th>Dokter</th>
        <th>Tanggal</th>
        <th>Keluhan</th>
        <th>Biaya</th>
    </tr>

    <?php $no = 1; ?>
    <?php while($row = $data->fetch_assoc()) : ?>
    <tr>
        <td><?= $no++ ?></td>
        <td><?= $row['pasien'] ?></td>
        <td><?= $row['dokter'] ?></td>
        <td><?= $row['tanggal'] ?></td>
        <td><?= $row['keluhan'] ?></td>
        <td>Rp <?= number_format($row['biaya'],0,',','.') ?></td>
    </tr>
    <?php endwhile; ?>

    <tr>
        <td colspan="5"><b>Total Pendapatan</b></td>
        <td>
            <b>Rp <?= number_format($total,0,',','.') ?></b>
        </td>
    </tr>
</table>

</body>
</html>