  <?php
  session_start();

  if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
  }
  require_once "model/admin_model.php";

  $user = new Admin();
  $data = $user->tampil();
  $no = 1;

  if (isset($_POST['tambah'])) {
    $user->tambah(
      $_POST['username'],
      $_POST['password']
    );

    header("Location: admin.php");
    exit;
  }

  if (isset($_POST['edit'])) {
    $user->update(
      $_POST['id'],
      $_POST['username'],
      $_POST['password']
    );

    header("Location: admin.php");
    exit;
  }

  if (isset($_POST['hapus'])) {
    $user->hapus($_POST['id']);

    header("Location: admin.php");
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
      ?>

      <div class="body-wrapper">
        <?php
        include 'navbar/header.php'
        ?>
        <div class="body-wrapper-inner">
          <div class="container-fluid">
            <button class="btn btn-success mb-2"
              data-bs-toggle="modal"
              data-bs-target="#modalTambah">
              Tambah Data
            </button>
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-body">
                    <div class="d-md-flex align-items-center">
                      <div>
                        <h4 class="card-title"><?php echo $user->info() ?></h4>
                      </div>
                    </div>
                    <div class="table-responsive mt-4">
                      <table class="table mb-0 text-nowrap varient-table align-middle fs-3">
                        <thead>
                          <tr>
                            <th scope="col" class="px-0 text-muted">NO</th>
                            <th scope="col" class="px-0 text-muted">Username</th>
                            <th scope="col" class="px-0 text-muted">Tools</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php while ($row = $data->fetch_assoc()) { ?>
                            <tr>
                              <td class="px-0"><?= $no++ ?></td>

                              <td class="px-0">
                                <?= $row['username'] ?>
                              </td>

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
                                      <h5 class="modal-title">Edit Admin</h5>
                                    </div>

                                    <div class="modal-body">

                                      <div class="mb-3">
                                        <label>Username</label>
                                        <input type="text"
                                          class="form-control"
                                          name="username"
                                          value="<?= $row['username'] ?>"
                                          required>
                                      </div>

                                      <div class="mb-3">
                                        <label>Password Baru</label>
                                        <input type="password"
                                          class="form-control"
                                          name="password">
                                        <small>Kosongkan jika tidak diubah</small>
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

                                      <button type="button"
                                        class="btn btn-secondary"
                                        data-bs-dismiss="modal">
                                        Batal
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
      <!-- Modal Tambah -->
      <div class="modal fade" id="modalTambah">
        <div class="modal-dialog">
          <div class="modal-content">

            <form method="POST">

              <div class="modal-header">
                <h5 class="modal-title">Tambah Admin</h5>
              </div>

              <div class="modal-body">

                <div class="mb-3">
                  <label>Username</label>
                  <input type="text"
                    name="username"
                    class="form-control"
                    required>
                </div>

                <div class="mb-3">
                  <label>Password</label>
                  <input type="password"
                    name="password"
                    class="form-control"
                    required>
                </div>

              </div>

              <div class="modal-footer">
                <button type="submit"
                  name="tambah"
                  class="btn btn-success">
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