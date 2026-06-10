<?php
session_start();

if(!isset($_SESSION['login'])){
    header("Location: login.php");
    exit;
}
require_once "model/pelayanan_model.php";
require_once "model/pasien_model.php";
require_once "model/dokter_model.php";

$pasienObj = new Pasien();
$dokterObj = new Dokter();

$pm = new PelayananMedis($pasienObj, $dokterObj);

$dataPM = $pm->getAll();
$dataPasien = $pasienObj->getAll();
$dataDokter = $dokterObj->getAll();

$no = 1;
?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>MyKlinik</title>
  <link rel="shortcut icon" type="image/png" href="./assets/images/logos/myklinik.png" />
  <link rel="stylesheet" href="./assets/css/styles.min.css" />
</head>

<body>
  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full">
    <?php
       include 'navbar/navbar.php';
       include 'navbar/header.php'
       ?>
    <div class="body-wrapper">
      <div class="body-wrapper-inner">
        <div class="container-fluid">
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-body"> 
                   <div class="d--md-flex justify-content-center align-items-center">
                    <h2 class="text-center">Selamat Datang <?php echo $_SESSION['username'] ?> </h2>
                  </div>
                </div>
              </div>
              <div class="card">
                <div class="card-body">
                   <div class="d-md-flex align-items-center">
                    <div>
                      <h4 class="card-title">Data Pasien</h4>
                    </div>
                  </div>
                  <div class="table-responsive mt-4">
                    <table class="table mb-0 text-nowrap varient-table align-middle fs-3">
                      <thead>
                        <tr>
                          <th scope="col" class="px-0 text-muted">
                            NO
                          </th>
                          <th scope="col" class="px-0 text-muted">Nama</th>
                          <th scope="col" class="px-0 text-muted">Alamat</th>
                          <th scope="col" class="px-0 text-muted">Nomer HP</th>
                        </tr>
                      </thead>
                     <tbody>
                        <?php while($row = $dataPasien->fetch_assoc()) { ?>
                        <tr>
                            <td class="px-0"><?= $no++ ?></td>
                            <td class="px-0"><?= $row['nama'] ?></td>
                            <td class="px-0"><?= $row['alamat'] ?></td>
                            <td class="px-0"><?= $row['no_hp'] ?></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                    </table>
                  </div>
                </div>
              </div>
              <div class="card">
                <div class="card-body">
                   <div class="d-md-flex align-items-center">
                    <div>
                      <h4 class="card-title">Data Dokter</h4>
                    </div>
                  </div>
                  <div class="table-responsive mt-4">
                    <table class="table mb-0 text-nowrap varient-table align-middle fs-3">
                      <thead>
                        <tr>
                          <th scope="col" class="px-0 text-muted">NO</th>
                          <th scope="col" class="px-0 text-muted">Nama</th>
                          <th scope="col" class="px-0 text-muted">Spesialis</th>
                          <th scope="col" class="px-0 text-muted">Nomer HP</th>
                        </tr>
                      </thead>
                     <tbody>
                        <?php while($row = $dataDokter->fetch_assoc()) { ?>
                        <tr>
                            <td class="px-0"><?= $no++ ?></td>
                            <td class="px-0"><?= $row['nama'] ?></td>
                            <td class="px-0"><?= $row['spesialis'] ?></td>
                            <td class="px-0"><?= $row['no_hp'] ?></td>
                            <td class="px-0">
                        </tr>
                        <?php } ?>
                    </tbody>
                    </table>
                  </div>
                </div>
              </div>
              <div class="card">
                <div class="card-body">
                  <div class="d-md-flex align-items-center">
                    <div>
                      <h4 class="card-title">Data Pelayanan Medis</h4>
                    </div>
                  </div>
                  <div class="table-responsive mt-4">
                     <table class="table mb-0 text-nowrap varient-table align-middle fs-3">
                      <thead>
                        <tr>
                        <th scope="col" class="px-0 text-muted">NO</th>
                          <th scope="col" class="px-0 text-muted">Pasien</th>
                          <th scope="col" class="px-0 text-muted">Dokter</th>
                          <th scope="col" class="px-0 text-muted">Keluhan</th>
                          <th scope="col" class="px-0 text-muted">Biaya</th>
                          <th scope="col" class="px-0 text-muted">Tanggal</th>
                        </tr>
                      </thead>
                      <tbody>
                          <?php while($row = $dataPM->fetch_assoc()) { ?>
                       <tr>
                        <td class="px-0"><?= $no++ ?></td>
                        <td class="px-0"> <?= $row['pasien'] ?></td>
                        <td class="px-0"> <?= $row['dokter'] ?></td>
                        <td class="px-0"> <?= $row['keluhan'] ?></td>
                        <td class="px-0">Rp.  <?= number_format($row['biaya']) ?></td>
                        <td class="px-0"> <?= $row['tanggal'] ?></td>
                        </tr>
                        <?php } ?>

                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="py-6 px-6 text-center">
        </div>
      </div>
    </div>
  </div>
  <script src="./assets/libs/jquery/dist/jquery.min.js"></script>
  <script src="./assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="./assets/js/sidebarmenu.js"></script>
  <script src="./assets/js/app.min.js"></script>
  <script src="./assets/libs/apexcharts/dist/apexcharts.min.js"></script>
  <script src="./assets/libs/simplebar/dist/simplebar.js"></script>
  <script src="./assets/js/dashboard.js"></script>
  <!-- solar icons -->
  <script src="https://cdn.jsdelivr.net/npm/iconify-icon@1.0.8/dist/iconify-icon.min.js"></script>
</body>

</html>
                   