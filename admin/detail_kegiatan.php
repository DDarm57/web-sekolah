<?php include '../admin/template/header.php' ?>

<?php
$id_kegiatan = $_GET['id_kegiatan'];
include '../admin/koneksi.php';
$get_kegiatan = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM data_kegiatan WHERE id_kegiatan='$id_kegiatan'"));

if (isset($_POST['edit_kegiatan'])) {
    require '../admin/functions/update.php';
    update_kegiatan($_POST);
}
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Detail Kegiatan <?= $get_kegiatan['nama_kegiatan']; ?></h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="data_kegiatan.php">Data kegiatan</a></li>
                        <li class="breadcrumb-item active">Detail Kegiatan <?= $get_kegiatan['nama_kegiatan']; ?></li>
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
                    <h3 class="card-title">Edit Data Kegiatan <?= $get_kegiatan['nama_kegiatan']; ?></h3>
                </div>
                <div class="card-body">
                    <form action="" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="id_kegiatan" id="id_kegiatan" value="<?= $get_kegiatan['id_kegiatan']; ?>">
                        <div class="form-group">
                            <label for="nama_kegiatan">Nama Kegiatan</label>
                            <input type="text" name="nama_kegiatan" id="nama_kegiatan" class="form-control" value="<?= $get_kegiatan['nama_kegiatan']; ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="deskripsi_kegiatan">Deskripsi</label>
                            <textarea name="deskripsi_kegiatan" id="summernote" class="form-control desk_kegiatan"><?= $get_kegiatan['deskripsi_kegiatan']; ?></textarea>
                        </div>
                        <div class="mt-2">
                            <button type="button" class="btn btn-primary btn-Ekegiatan">Edit</button>
                            <button type="submit" name="edit_kegiatan" class="btn btn-primary btn-Ukegiatan" hidden>Update</button>
                        </div>
                    </form>
                </div>
            </div>
            <?php
            $get_pembina = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM data_pembina WHERE mengajar_kegiatan = '$id_kegiatan'"));
            ?>
            <div class="card">
                <?php if (!$get_pembina) : ?>
                    <div class="card-header">
                        <h3 class="card-title">Pembina Kegiatan <?= $get_kegiatan['nama_kegiatan']; ?></h3>
                    </div>
                    <div class="card-body">
                        <h3>Tidak ada pembina yang menajar <?= $get_kegiatan['nama_kegiatan']; ?></h3>
                    </div>
                <?php else : ?>
                    <div class="card-header">
                        <h3 class="card-title">Pembina Kegiatan <?= $get_kegiatan['nama_kegiatan']; ?></h3>
                    </div>
                    <div class="row gutters-sm">
                        <div class="col-md-4 mb-2">
                            <div class="card-body">
                                <div class="d-flex flex-column align-items-center text-center">
                                    <img src="../admin/gambar/pembina/<?= $get_pembina['gambar_pembina']; ?>" alt="Admin" class="img-thumbnail" width="200">
                                    <div class="mt-3">
                                        <h4><?= $get_pembina['nama_pembina']; ?></h4>
                                        <p class="text-secondary mb-1"><?= $get_kegiatan['nama_kegiatan']; ?></p>
                                        <p class="text-muted font-size-sm"><?= $get_pembina['alamat_pembina']; ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">NIP</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <?= $get_pembina['nip']; ?>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Nama</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <?= $get_pembina['nama_pembina']; ?>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Alamat</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <?= $get_pembina['alamat_pembina']; ?>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">No HP</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <?= $get_pembina['no_hp']; ?>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Status</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <strong>
                                            <p style="text-transform:uppercase" class="text-<?= ($get_pembina['status'] == 'aktif' ? 'success' : 'danger'); ?>"><?= $get_pembina['status']; ?></p>
                                        </strong>
                                    </div>
                                </div>
                                <hr>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Data Siswa Kegiatan <?= $get_kegiatan['nama_kegiatan']; ?></h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>NISN</th>
                                <th>NAMA SISWA</th>
                            </tr>
                        </thead>
                        <?php
                        include '../admin/koneksi.php';
                        $query_akademik = mysqli_query($conn, "SELECT * FROM ekstrakurikuler INNER JOIN data_siswa ON data_siswa.id_siswa = ekstrakurikuler.id_siswa INNER JOIN tahun_akademik ON tahun_akademik.id_tahunAkd = ekstrakurikuler.id_thnAkd WHERE ekstrakurikuler.id_kegiatan = '$id_kegiatan' AND tahun_akademik.status = 'aktif'");
                        // $cek_data = mysqli_fetch_all($query_akademik);
                        // var_dump($cek_data);
                        ?>
                        <tbody>
                            <?php $n = 1;
                            while ($row = mysqli_fetch_array($query_akademik)) : ?>
                                <tr>
                                    <td><?= $n++; ?></td>
                                    <td><?= $row['nisn']; ?></td>
                                    <td><?= $row['nama_siswa']; ?></td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
        </div><!-- /.container-fluid -->
        <!-- /.content -->
    </section>
</div>


<?php include '../admin/template/footer.php' ?>