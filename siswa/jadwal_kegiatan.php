<?php include "../siswa/layout/header.php"; ?>
<?php
include '../siswa/koneksi.php';
$query = mysqli_query($conn, "SELECT * FROM tahun_akademik");
$get_tahunAkd = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM tahun_akademik WHERE status='aktif'"));
if (isset($_GET['id_tahunAkd'])) {
    $id_tahunSelected = $_GET['id_tahunAkd'];
} else {
    $id_tahunSelected = $get_tahunAkd['id_tahunAkd'];
}

if (isset($_POST['tambah_jadwal'])) {
    require '../pembina/pembina_controller/tambah.php';
    tambah_jadwal($_POST);
}

if (isset($_GET['id_jadwal'])) {
    require '../pembina/pembina_controller/hapus.php';
    hapus_jadwal($_GET);
}

if (isset($_POST['update_jadwal'])) {
    require '../pembina/pembina_controller/update.php';
    update_jadwal($_POST);
}

if (isset($_GET['bulan'])) {
    $bulan = $_GET['bulan'];
} else {
    $bulan = date("Y-m");
}
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Jadwal Kegiatan</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="home.php">Home</a></li>
                        <li class="breadcrumb-item active">Jadwal dan Nilai Kegiatan</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container">
            <form action="" method="get">
                <div class="input-group mb-3">
                    <input type="month" name="bulan" id="" class="form-control" value="<?= $bulan; ?>">
                    <div class="input-group-append">
                        <button class="btn btn-outline-primary" type="submit"><i class="fas fa-search"></i></button>
                    </div>
                </div>
            </form>
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Jadwal dan Nilai</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal</th>
                                    <th>Jam</th>
                                    <th>Materi</th>
                                    <th>Keterangan</th>
                                    <th>Nilai</th>
                                </tr>
                            </thead>
                            <?php
                            $kegiatan = $get_kegiatanSiswa['id_kegiatan'];
                            // $id_tahunAkd = $_GET['id_tahunAkd'];
                            $query = mysqli_query($conn, "SELECT * FROM jadwal_ekstra INNER JOIN tahun_akademik ON tahun_akademik.id_tahunAkd = jadwal_ekstra.id_thnAkd WHERE tanggal LIKE '$bulan%' AND id_kegiatan = '$kegiatan'");
                            ?>
                            <tbody>
                                <?php $n = 1;
                                while ($row = mysqli_fetch_array($query)) : ?>
                                    <tr>
                                        <td><?= $n++; ?></td>
                                        <td><?= $row['tanggal']; ?></td>
                                        <td><?= $row['waktu']; ?></td>
                                        <td><?= $row['materi']; ?></td>
                                        <td><?= $row['keterangan']; ?></td>
                                        <td>
                                            <?php
                                            $id_jadwal = $row['id_jadwal'];
                                            $id_siswa = $get_kegiatanSiswa['id_siswa'];
                                            $get_nilai = mysqli_fetch_array(mysqli_query($conn, "SELECT id_jadwal,nilai FROM nilai_ekstra WHERE id_jadwal='$id_jadwal' AND id_siswa='$id_siswa'"));
                                            echo $get_nilai['nilai'];
                                            ?>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php include "../siswa/layout/footer.php"; ?>