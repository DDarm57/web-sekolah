<?php include '../admin/template/header.php' ?>

<?php
if (isset($_POST['save_pembina'])) {
    require '../admin/functions/tambah.php';
    save_pembina($_POST);
}


?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Data Pembina</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="data_pembina.php">Data Pembina</a></li>
                        <li class="breadcrumb-item active">Tambah Data Pembina</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">

            <div class="card mt-2">
                <div class="card-header">
                    <h3 class="card-title">Form Tambah Data Pembina</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="nama_pembina">Nama Pembina</label>
                                    <input type="text" name="nama_pembina" id="nama_pembina" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="nip_pembina">NIP</label>
                                    <input type="text" name="nip_pembina" id="nip_pembina" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="alamat_pembina">Alamat</label>
                                    <input type="text" name="alamat_pembina" id="alamat_pembina" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="no_hp">No HP</label>
                                    <input type="number" name="no_hp" id="no_hp" class="form-control" required>
                                </div>
                            </div>
                            <?php
                            include '../admin/koneksi.php';
                            $query_kegiatan = mysqli_query($conn, "SELECT * FROM data_kegiatan");
                            ?>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="mengajar_kegiatan">Mengajar Kegiatan</label>
                                    <select class="selectpicker form-control" name="mengajar_kegiatan" data-live-search="true" title="Kegiatan" required>
                                        <?php while ($row = mysqli_fetch_array($query_kegiatan)) : ?>
                                            <option value="<?= $row['id_kegiatan']; ?>"><?= $row['nama_kegiatan']; ?></option>
                                        <?php endwhile; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <label for="username">Username <small>(Digunakan pada saat login halaman pembina)</small></label>
                                <input type="text" name="username" id="username" class="form-control" value="pembina" required>
                            </div>
                            <div class="col-sm-6">
                                <label for="password">Password <small>(Digunakan pada saat login halaman pembina)</small></label>
                                <input type="text" name="password" id="password" class="form-control" value="<?= rand(00000, 99999); ?>" required>
                            </div>
                            <div class="col-sm-6">
                                <label for="gambar_berita">Gambar</label>
                                <div class="form-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input form-control" name="file" id="file_image">
                                        <label class="custom-file-label">Choose file...</label>
                                    </div>
                                    <small>jpg, png, jpeg</small>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <a href="">
                                    <img src="./gambar/gambar_berita/default.jpg" alt="" class="img-thumbnail mb-2" id="imgPreview" style="width: 150px; height: 150px; object-fit: cover;">
                                </a>
                            </div>
                            <div class="col-sm-6">
                                <button type="submit" name="save_pembina" class="btn btn-primary">Simpan</button>
                            </div>
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