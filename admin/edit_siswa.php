<?php include '../admin/template/header.php'; ?>
<?php
include '../admin/koneksi.php';

$id_siswa = $_GET['id_siswa'];
$get_siswa = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM data_siswa WHERE id_siswa='$id_siswa'"));
$get_dataAkd = mysqli_fetch_array(mysqli_query($conn, "SELECT id_siswa,id_Pstudi FROM data_akademik WHERE id_siswa='$id_siswa'"));

if (isset($_POST['update_siswa'])) {
    require '../admin/functions/update.php';
    update_siswa($_POST);
}

?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Edit Siswa</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Edit Siswa</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Form Edit Siswa</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <form action="" method="POST">
                        <input type="hidden" name="id_siswa" id="" value="<?= $get_siswa['id_siswa']; ?>">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="nisn">NISN</label>
                                    <input type="number" name="nisn" id="nisn" class="form-control" value="<?= $get_siswa['nisn']; ?>" readonly>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="nama_siswa">Nama Siswa</label>
                                    <input type="text" name="nama_siswa" id="nama_siswa" class="form-control" value="<?= $get_siswa['nama_siswa']; ?>" required>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="tempat_lahir">Tempat Lahir</label>
                                    <input type="text" name="tempat_lahir" id="tempat_lahir" class="form-control" value="<?= $get_siswa['tempat_lahir']; ?>" required>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="tgl_lahir">Tgl Lahir</label>
                                    <input type="date" name="tgl_lahir" id="tgl_lahir" class="form-control" value="<?= $get_siswa['tgl_lahir']; ?>" required>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="alamat_rumah">Alamat Rumah</label>
                                    <input type="text" name="alamat" id="alamat" class="form-control" value="<?= $get_siswa['alamat']; ?>" required>
                                </div>
                            </div>
                            <?php
                            $query_studi = mysqli_query($conn, "SELECT * FROM program_studi")
                            ?>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="jurusan">Jurusan</label>
                                    <select class="selectpicker form-control" name="jurusan" data-live-search="true" title="Pilih Jurusan" id="jurusan" required>
                                        <?php while ($row = mysqli_fetch_array($query_studi)) : ?>
                                            <option <?= $get_dataAkd['id_Pstudi'] == $row['id_Pstudi'] ? "selected" : ""; ?> value="<?= $row['id_Pstudi']; ?>"><?= $row['nama_studi']; ?></option>
                                        <?php endwhile; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="mt-2">
                            <button type="submit" name="update_siswa" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
                <!-- /.card-body -->
            </div>
        </div><!-- /.container-fluid -->
        <!-- /.content -->
    </section>
</div>

<!-- /.container-fluid -->
<?php include '../admin/template/footer.php'; ?>