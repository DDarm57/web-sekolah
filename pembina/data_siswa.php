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

if (isset($_GET['daftarkan'], $_GET['password'], $_GET['id_kegiatan'])) {
    require '../pembina/pembina_controller/tambah.php';
    tambah_siswaEkstra($_GET);
}
?>
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data Siswa</h1>
        <p class="d-none d-sm-inline-block"><a href="dashboard.php">Dashboard</a> / <strong>Data Siswa</strong></p>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <form action="">
                <div class="input-group mb-3">
                    <select class="selectpicker form-control" name="id_tahunAkd" data-live-search="true" title="Tahun Akademik" required>
                        <?php while ($row = mysqli_fetch_array($query)) : ?>
                            <option <?= ($row['id_tahunAkd'] == $id_tahunSelected ? 'selected' : ''); ?> value="<?= $row['id_tahunAkd']; ?>"><?= $row['tahun']; ?></option>
                        <?php endwhile; ?>
                    </select>
                    <div class="input-group-append">
                        <button class="btn btn-outline-primary" type="submit"><i class="fas fa-search"></i></button>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-sm-6">
            <button type="button" class="btn btn-primary mb-2" data-toggle="modal" data-target="#exampleModal">
                Daftarkan Siswa
            </button>
        </div>
    </div>
    <?php
    if (isset($_POST['cek_siswa'])) {
        require '../pembina/pembina_controller/tambah.php';
        cek_siswa($_POST);
    }
    ?>
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
                                    <strong>
                                        <p style="text-transform:uppercase" class="text-<?= ($row['status'] == 'aktif' ? 'success bg-success rounded' : 'danger bg-danger rounded'); ?> text-center text-light"><?= $row['status']; ?></p>
                                    </strong>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Daftar Ekstrakurikuler</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" method="post">
                <input type="hidden" name="id_kegiatan" id="" value="<?= $kegiatan; ?>">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nisn">NISN <small>(Sebagai Username Login)</small></label>
                        <input type="number" name="nisn" id="nisn" class="form-control" placeholder="Masukan NISN">
                    </div>
                    <div class="form-group">
                        <label for="password">Password <small>(Password dibuat otomatis)</small></label>
                        <input type="text" name="password" id="password" class="form-control" placeholder="Buat Password" value="<?= rand(00000, 99999); ?>">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" name="cek_siswa" class="btn btn-primary">Cek NISN</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- /.container-fluid -->
<?php include "../pembina/layout_pembina/footer.php" ?>