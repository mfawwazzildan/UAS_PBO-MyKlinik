<?php
session_start();

if (!isset($_SESSION['login'])) {
  header("Location: login.php");
  exit;
}
require_once "model/pelayanan_model.php";
require_once "model/pasien_model.php";
require_once "model/dokter_model.php";

$pasienObj = new Pasien();
$dokterObj = new Dokter();
$pm = new PelayananMedis($pasienObj, $dokterObj);
$data = $pm->getAll();
$no = 1;
if (isset($_POST['tambah'])) {
  $pm->insert([
    'pasien_id' => $_POST['pasien_id'],
    'dokter_id' => $_POST['dokter_id'],
    'tanggal' => $_POST['tanggal'],
    'keluhan' => $_POST['keluhan'],
    'biaya' => $_POST['biaya']
  ]);

  header("Location: pelayanan_medis.php");
  exit;
}

if (isset($_POST['edit'])) {
  $pm->updateData($_POST['id'], [
    'pasien_id' => $_POST['pasien_id'],
    'dokter_id' => $_POST['dokter_id'],
    'tanggal' => $_POST['tanggal'],
    'keluhan' => $_POST['keluhan'],
    'biaya' => $_POST['biaya']
  ]);

  header("Location: pelayanan_medis.php");
  exit;
}

if (isset($_POST['hapus'])) {
  $pm->delete($_POST['id']);

  header("Location: pelayanan_medis.php");
  exit;
}
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

          <button class="btn btn-success mb-2"
            data-bs-toggle="modal"
            data-bs-target="#modalTambah">
            Tambah Data
          </button>
          <a href="print_laporan.php" target="_blank" class="btn btn-warning mb-2">
            Cetak Laporan
          </a>
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-body">
                  <div class="d-md-flex align-items-center">
                    <div>
                      <h4 class="card-title"><?php echo $pm->info() ?></h4>
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
                          <th scope="col" class="px-0 text-muted">Tools</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php while ($row = $data->fetch_assoc()) { ?>
                          <tr>
                            <td class="px-0"><?= $no++ ?></td>
                            <td class="px-0"> <?= $row['pasien'] ?></td>
                            <td class="px-0"> <?= $row['dokter'] ?></td>
                            <td class="px-0"> <?= $row['keluhan'] ?></td>
                            <td class="px-0">RP. <?= number_format($row['biaya']) ?></td>
                            <td class="px-0"> <?= $row['tanggal'] ?></td>
                            <td class="px-0">

                              <button class="btn btn-warning"
                                data-bs-toggle="modal"
                                data-bs-target="#edit<?= $row['id'] ?>">
                                <i class="ti ti-edit"></i>
                              </button>

                              <button class="btn btn-danger"
                                data-bs-toggle="modal"
                                data-bs-target="#hapus<?= $row['id'] ?>">
                                <i class="ti ti-trash"></i>
                              </button>

                            </td>
                          </tr>

                          <!-- Modal Edit -->
                          <div class="modal fade" id="edit<?= $row['id'] ?>">
                            <div class="modal-dialog">
                              <div class="modal-content">

                                <form method="POST">

                                  <input type="hidden"
                                    name="id"
                                    value="<?= $row['id'] ?>">

                                  <div class="modal-header">
                                    <h5>Edit Pelayanan</h5>
                                  </div>

                                  <div class="modal-body">

                                    <div class="mb-3">
                                      <label>Pasien</label>
                                      <select name="pasien_id" class="form-control" required>
                                        <?php
                                        $pasienEdit = $pm->getPasien();

                                        while ($p = $pasienEdit->fetch_assoc()) {
                                        ?>
                                          <option value="<?= $p['id'] ?>"
                                            <?= ($p['id'] == $row['pasien_id']) ? 'selected' : '' ?>>
                                            <?= $p['nama'] ?>
                                          </option>
                                        <?php } ?>
                                      </select>
                                    </div>

                                    <div class="mb-3">
                                      <label>Dokter</label>
                                      <select name="dokter_id" class="form-control" required>
                                        <?php
                                        $dokterEdit = $pm->getDokter();

                                        while ($d = $dokterEdit->fetch_assoc()) {
                                        ?>
                                          <option value="<?= $d['id'] ?>"
                                            <?= ($d['id'] == $row['dokter_id']) ? 'selected' : '' ?>>
                                            <?= $d['nama'] ?>
                                          </option>
                                        <?php } ?>
                                      </select>
                                    </div>

                                    <div class="mb-3">
                                      <label>Keluhan</label>
                                      <textarea name="keluhan"
                                        class="form-control"
                                        required><?= $row['keluhan'] ?></textarea>
                                    </div>

                                    <div class="mb-3">
                                      <label>Biaya</label>
                                      <input type="number"
                                        name="biaya"
                                        class="form-control"
                                        value="<?= $row['biaya'] ?>"
                                        required>
                                    </div>

                                    <div class="mb-3">
                                      <label>Tanggal</label>
                                      <input type="date"
                                        name="tanggal"
                                        class="form-control"
                                        value="<?= $row['tanggal'] ?>"
                                        required>
                                    </div>
                                  </div>

                                  <div class="modal-footer">
                                    <button type="submit"
                                      name="edit"
                                      class="btn btn-warning">
                                      Update
                                    </button>
                                  </div>

                                </form>

                              </div>
                            </div>
                          </div>

                          <!-- Modal Hapus -->
                          <div class="modal fade" id="hapus<?= $row['id'] ?>">
                            <div class="modal-dialog modal-sm">
                              <div class="modal-content">

                                <form method="POST">

                                  <input type="hidden"
                                    name="id"
                                    value="<?= $row['id'] ?>">

                                  <div class="modal-body text-center">

                                    <h5>Yakin hapus data?</h5>

                                    <button type="submit"
                                      name="hapus"
                                      class="btn btn-danger">
                                      Hapus
                                    </button>

                                  </div>

                                </form>

                              </div>
                            </div>
                          </div>

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

    <div class="modal fade" id="modalTambah">
      <div class="modal-dialog">
        <div class="modal-content">

          <form method="POST">

            <div class="modal-header">
              <h5 class="modal-title">Tambah Pelayanan Medis</h5>
            </div>

            <div class="modal-body">

              <div class="mb-3">
                <label>Pasien</label>
                <select name="pasien_id" class="form-control" required>
                  <option value="">-- Pilih Pasien --</option>

                  <?php
                  $pasien = $pm->getPasien();

                  while ($p = $pasien->fetch_assoc()) {
                  ?>
                    <option value="<?= $p['id'] ?>">
                      <?= $p['nama'] ?>
                    </option>
                  <?php } ?>

                </select>
              </div>

              <div class="mb-3">
                <label>Dokter</label>
                <select name="dokter_id" class="form-control" required>
                  <option value="">-- Pilih Dokter --</option>

                  <?php
                  $dokter = $pm->getDokter();

                  while ($d = $dokter->fetch_assoc()) {
                  ?>
                    <option value="<?= $d['id'] ?>">
                      <?= $d['nama'] ?>
                    </option>
                  <?php } ?>

                </select>
              </div>

              <div class="mb-3">
                <label>Tanggal</label>
                <input type="date" name="tanggal" class="form-control" required>
              </div>

              <div class="mb-3">
                <label>Keluhan</label>
                <textarea name="keluhan" class="form-control" required></textarea>
              </div>

              <div class="mb-3">
                <label>Biaya</label>
                <input type="number" name="biaya" class="form-control" required>
              </div>

            </div>

            <div class="modal-footer">
              <button type="submit" name="tambah" class="btn btn-success">
                Simpan
              </button>
            </div>

          </form>

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