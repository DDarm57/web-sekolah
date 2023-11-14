<?php include "../pembina/layout_pembina/header.php" ?>
<?php
include '../admin/koneksi.php';
$query = mysqli_query($conn, "SELECT * FROM tahun_akademik");
$get_tahunAkd = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM tahun_akademik WHERE status='aktif'"));
if (isset($_GET['id_tahunAkd'])) {
    $id_tahunSelected = $_GET['id_tahunAkd'];
} else {
    $id_tahunSelected = $get_tahunAkd['id_tahunAkd'];
}

if (isset($_GET['id_siswa'])) {
    require '../pembina/pembina_controller/update.php';
    update_statusValidasi($_GET);
}

?>
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Validasi Nilai</h1>
        <p class="d-none d-sm-inline-block"><a href="dashboard.php">Dashboard</a> / <strong>Validasi Nilai</strong></p>
    </div>


    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>NISN</th>
                            <th>Nama Siswa</th>
                            <th>Tempat & Tgl Lahir</th>
                            <th>Alamat</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <?php
                    $kegiatan = $get_pembina['mengajar_kegiatan'];
                    // $id_tahunAkd = $_GET['id_tahunAkd'];
                    $query = mysqli_query($conn, "SELECT * FROM ekstrakurikuler INNER JOIN tahun_akademik ON tahun_akademik.id_tahunAkd = ekstrakurikuler.id_thnAkd INNER JOIN data_siswa ON data_siswa.id_siswa = ekstrakurikuler.id_siswa WHERE id_kegiatan = '$kegiatan'");
                    ?>
                    <tbody>
                        <?php $n = 1;
                        while ($row = mysqli_fetch_array($query)) : ?>
                            <tr>
                                <td><?= $n++; ?></td>
                                <td><?= $row['nisn']; ?></td>
                                <td><?= $row['nama_siswa']; ?></td>
                                <td><?= $row['tempat_lahir'] . ", " . $row['tgl_lahir']; ?></td>
                                <td><?= $row['alamat']; ?></td>
                                <td>
                                    <?php if ($row['status_validasi'] == 'validasi nilai') : ?>
                                        <a href="validasi_nilai.php?id_siswa=<?= $row['id_siswa']; ?>" class="btn btn-danger btn-sm validasi">Validasi Sekarang</a>
                                    <?php else : ?>
                                        <strong>
                                            <p style="text-transform:uppercase" class="text-success bg-success rounded text-light text-center">VALID</p>
                                        </strong>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- /.container-fluid -->
<?php include "../pembina/layout_pembina/footer.php" ?>