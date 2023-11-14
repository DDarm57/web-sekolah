<?php include '../admin/template/header.php' ?>

<?php
if (isset($_POST['update_kelasSiswa'])) {
    require '../admin/functions/update.php';
    update_kelasSiswa($_POST);
}
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Atur Kelas Siswa</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="data_kelas.php">Data Kelas</a></li>
                        <li class="breadcrumb-item active">Atur Kelas Siswa</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="alert alert-warning alert-dismissible mb-2">
                <h5><i class="icon fas fa-exclamation-triangle"></i>Peringatan!</h5>
                <strong>Jika siswa belum mendapatkan kelas otomatis siswa yang baru mendaftar tidak akan terbaca di data akademik!</strong><br>
                Halaman ini bertujuan untuk siswa yang belum mendapatkan kelas sesudah mendaftar menjadi siswa baru. Silahkan atur kelas beberapa siswa di bawah.
            </div>
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Data Siswa</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <form action="#" method="POST">
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th><input type="checkbox" id="centang-semua"></th>
                                    <th>No</th>
                                    <th>NISN</th>
                                    <th>Nama Siswa</th>
                                    <th>Tempat & Tgl Lahir</th>
                                    <th>Alamat</th>
                                    <th>Kelas</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <?php
                            include '../admin/koneksi.php';
                            $query = mysqli_query($conn, "SELECT * FROM data_siswa WHERE status = 'no_kelas' ORDER BY data_siswa.id_siswa DESC");
                            $query_kelas = mysqli_query($conn, "SELECT * FROM kelas WHERE nama_kelas = 'X'");
                            ?>
                            <tbody>
                                <?php $n = 1;
                                while ($row = mysqli_fetch_array($query)) : ?>
                                    <tr>
                                        <td><input type="checkbox" class="centangID" name="id_siswa[]" value="<?= $row['id_siswa']; ?>" required></td>
                                        <td><?= $n++; ?></td>
                                        <td><?= $row['nisn']; ?></td>
                                        <td><?= $row['nama_siswa']; ?></td>
                                        <td><?= $row['tempat_lahir'] . ", " . $row['tgl_lahir']; ?></td>
                                        <td><?= $row['alamat']; ?></td>
                                        <td>
                                            <select class="selectpicker form-control" name="id_kelas[]" data-live-search="true" title="Pilih Kelas" required>
                                                <?php while ($rw = mysqli_fetch_array($query_kelas)) : ?>
                                                    <option value="<?= $rw['id_kelas']; ?>"><?= $rw['nama_kelas']; ?></option>
                                                <?php endwhile; ?>
                                            </select>
                                        </td>
                                        <td>
                                            <strong>
                                                <p style="text-transform:uppercase" class="text-<?= ($row['status'] == 'aktif' ? 'success bg-success rounded' : 'danger bg-danger rounded'); ?> text-center"><?= $row['status']; ?></p>
                                            </strong>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                        <div class="mt-2 text-right">
                            <button type="submit" name="update_kelasSiswa" class="btn btn-sm btn-primary">Tetapkan Kelas</button>
                        </div>
                    </form>
                </div>
                <!-- /.card-body -->
            </div>
        </div><!-- /.container-fluid -->
        <!-- /.content -->
    </section>
</div>


<?php include '../admin/template/footer.php' ?>