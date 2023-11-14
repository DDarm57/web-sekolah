<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.4.0/css/responsive.bootstrap4.min.css">

    <title>Profil Sekolah</title>
</head>

<body>
    <?php include 'template_pendaftaran/navbar.php'; ?>
    <?php 
    include 'admin/koneksi.php';
    $get_profilSekolah = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM profil_sekolah"));
    ?>
    <div class="container">
            <h3 class="mt-4">PROFIL SEKOLAH</h3>
    <div class="main-body">
          <div class="row gutters-sm">
            <div class="col-md-4 mb-3">
              <div class="card">
                <div class="card-body">
                  <div class="d-flex flex-column align-items-center text-center">
                    <img src="admin/gambar/<?= $get_profilSekolah['gmb_kepSek']; ?>" alt="Admin" class="rounded-circle" width="150">
                    <div class="mt-3">
                      <h4><?= $get_profilSekolah['kepala_sekolah']; ?></h4>
                      <p class="text-secondary mb-1">Kepala Sekolah</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-8">
              <div class="card mb-3">
                <div class="card-body">
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">NPSN</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      <?= $get_profilSekolah['npsn'];?>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Nama Sekolah</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                    <?= $get_profilSekolah['nama_sekolah'];?>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Telepon</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                    <?= $get_profilSekolah['telp_sekolah'];?>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Email</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                    <?= $get_profilSekolah['email_sekolah'];?>
                    </div>
                  </div>
                  <hr>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="card">
            <div class="card-header">Visi-Misi</div>
            <div class="card-body">
                <?= $get_profilSekolah['visi_misi']; ?>
            </div>
        </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.6.2.js" integrity="sha256-pkn2CUZmheSeyssYw3vMp1+xyub4m+e+QK4sQskvuo4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.4.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.4.0/js/responsive.bootstrap4.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#example').DataTable();
        });
    </script>
</body>

</html>