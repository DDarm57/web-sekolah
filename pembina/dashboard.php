<?php include "../pembina/layout_pembina/header.php" ?>

<?php
include "../pembina/koneksi.php";
$id_kegiatan = $get_pembina["mengajar_kegiatan"];
$kegiatan = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM data_kegiatan WHERE id_kegiatan='$id_kegiatan'"));
?>

<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    </div>

    <!-- Content Row -->
    <div class="row">
        <!-- Earnings (Monthly) Card Example -->
        <div class="col-sm-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Data Siswa (<?= $kegiatan["nama_kegiatan"]; ?>)</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= mysqli_num_rows(mysqli_query($conn, "SELECT id_kegiatan FROM ekstrakurikuler WHERE id_kegiatan='$id_kegiatan'")); ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-sm-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Nilai Belum Divalidasi</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= mysqli_num_rows(mysqli_query($conn, "SELECT id_kegiatan,status_validasi FROM ekstrakurikuler WHERE id_kegiatan='$id_kegiatan' AND status_validasi='validasi nilai'")); ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-3">
            <div class="card">
                <div class="card-body">
                    <div class="text-center">
                        <img src="../admin/gambar/pembina/<?= $get_pembina["gambar_pembina"]; ?>" alt="gambar pembina" class="rounded-circle" width="150">
                        <div class="mt-4">
                            <h5><?= $get_pembina["nama_pembina"]; ?></h5>
                            <p class="card-text"><?= $get_pembina["nip"]; ?></p>
                            <a href="profile.php" class="btn btn-primary"><i class="fas fa-pen"></i> Edit</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Content Row -->

</div>
<!-- /.container-fluid -->
<?php include "../pembina/layout_pembina/footer.php" ?>