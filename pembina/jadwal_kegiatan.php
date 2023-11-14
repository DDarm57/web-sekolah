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
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Jadwal Kegiatan</h1>
        <p class="d-none d-sm-inline-block"><a href="dashboard.php">Dashboard</a> / <strong>Jadwal Kegiatan</strong></p>
    </div>
    <!-- Button trigger modal -->
    <div class="row">
        <div class="col-sm-6">
            <form action="" method="get">
                <div class="input-group mb-3">
                    <input type="month" name="bulan" id="" class="form-control" value="<?= $bulan; ?>">
                    <div class="input-group-append">
                        <button class="btn btn-outline-primary" type="submit"><i class="fas fa-search"></i></button>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-sm-6">
            <button type="button" class="btn btn-primary mb-2" data-toggle="modal" data-target="#exampleModal">
                Tambah Jadwal
            </button>
        </div>
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
                            <th>Tanggal</th>
                            <th>Jam</th>
                            <th>Materi</th>
                            <th>Keterangan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <?php
                    $kegiatan = $get_pembina['mengajar_kegiatan'];
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
                                    <a href="" class="btn btn-warning edit-jadwal" data-id_jadwal="<?= $row['id_jadwal']; ?>" data-waktu="<?= $row['waktu']; ?>" data-tanggal="<?= $row['tanggal']; ?>" data-materi="<?= $row['materi']; ?>" data-keterangan="<?= $row['keterangan']; ?>" data-toggle="modal" data-target="#exampleModaledit"><i class="fas fa-pen"></i></a>
                                    <a href="jadwal_kegiatan.php?id_jadwal=<?= $row['id_jadwal']; ?>" class="btn btn-danger hapus"><i class="fas fa-trash"></i></a>
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
                <h5 class="modal-title" id="exampleModalLabel">TAMBAH JADWAL</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" method="post">
                <input type="hidden" name="id_kegiatan" id="" value="<?= $kegiatan; ?>">
                <div class="modal-body modal-editJadwal">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="tanggal">Tanggal</label>
                                <input type="date" name="tanggal" id="tanggal" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="waktu">Jam</label>
                                <input type="time" name="waktu" id="waktu" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="materi">Materi</label>
                        <input type="text" name="materi" id="materi" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="keterangan">Keterangan</label>
                        <textarea name="keterangan" id="keterangan" class="form-control" cols="30" rows="10" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" name="tambah_jadwal" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal edit jadwal -->
<div class="modal fade" id="exampleModaledit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">EDIT JADWAL</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" method="post">
                <div class="modal-body">
                    <input type="hidden" name="id_kegiatan" value="<?= $kegiatan; ?>">
                    <input type="hidden" name="id_jadwal" class="id_jadwal">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="tanggal">Tanggal</label>
                                <input type="date" name="tanggal" id="tanggal" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="waktu">Jam</label>
                                <input type="time" name="waktu" id="waktu" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="materi">Materi</label>
                        <input type="text" name="materi" id="materi" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="keterangan">Keterangan</label>
                        <textarea name="keterangan" id="keterangan" class="form-control" cols="30" rows="10" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" name="update_jadwal" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- /.container-fluid -->
<?php include "../pembina/layout_pembina/footer.php" ?>