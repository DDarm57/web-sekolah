<?php include '../admin/template/header.php' ?>

<?php
include '../admin/koneksi.php';
$id_pembina = $_GET['id_pembina'];

$get_pembina = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM data_pembina WHERE id_pembina='$id_pembina'"));
// var_dump($get_pembina);
if (isset($_POST['update_pembina'])) {
    require '../admin/functions/update.php';
    update_pembina($_POST);
}

?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Edit Pembina (<?= $get_pembina['nama_pembina']; ?>)</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="data_pembina.php">Data Pembina</a></li>
                        <li class="breadcrumb-item active">Edit Pembina (<?= $get_pembina['nama_pembina']; ?>)</li>
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
                    <h3 class="card-title">Form Edit Pembina</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <form action="" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="id_pembina" id="" value="<?= $id_pembina; ?>">
                        <input type="hidden" name="gambar_lama" id="" value="<?= $get_pembina['gambar_pembina']; ?>">
                        <input type="hidden" name="pembina_userid" id="" value="<?= $get_pembina['pembina_userid']; ?>">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="nama_pembina">Nama Pembina</label>
                                    <input type="text" name="nama_pembina" id="nama_pembina" class="form-control" value="<?= $get_pembina['nama_pembina']; ?>" required>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="nip_pembina">NIP</label>
                                    <input type="text" name="nip_pembina" id="nip_pembina" class="form-control" value="<?= $get_pembina['nip']; ?>" required>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="alamat_pembina">Alamat</label>
                                    <input type="text" name="alamat_pembina" id="alamat_pembina" class="form-control" value="<?= $get_pembina['alamat_pembina']; ?>" required>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="no_hp">No HP</label>
                                    <input type="number" name="no_hp" id="no_hp" class="form-control" value="<?= $get_pembina['no_hp']; ?>" required>
                                </div>
                            </div>
                            <?php
                            $query_kegiatan = mysqli_query($conn, "SELECT * FROM data_kegiatan");
                            ?>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="mengajar_kegiatan">Mengajar Kegiatan</label>
                                    <select class="selectpicker form-control" name="mengajar_kegiatan" data-live-search="true" title="Kegiatan" required disabled>
                                        <?php while ($row = mysqli_fetch_array($query_kegiatan)) : ?>
                                            <option <?= ($get_pembina['mengajar_kegiatan'] == $row['id_kegiatan'] ? "selected" : ""); ?> value="<?= $row['id_kegiatan']; ?>"><?= $row['nama_kegiatan']; ?></option>
                                        <?php endwhile; ?>
                                    </select>
                                </div>
                            </div>
                            <?php
                            $id_user = $get_pembina['pembina_userid'];
                            $get_pembinaUser = mysqli_fetch_array(mysqli_query($conn, "SELECT id_user,username,password FROM users WHERE id_user='$id_user'"));
                            ?>
                            <div class="col-sm-6">
                                <label for="username">Username <small>(Digunakan pada saat login halaman pembina)</small></label>
                                <input type="text" name="username" id="username" class="form-control" value="<?= $get_pembinaUser['username']; ?>" required>
                            </div>
                            <div class="col-sm-6">
                                <label for="password">Password <small>(Digunakan pada saat login halaman pembina)</small></label>
                                <input type="text" name="password" id="password" class="form-control" value="<?= $get_pembinaUser['password']; ?>" required>
                            </div>
                            <div class="col-sm-6">
                                <label for="gambar_berita">Gambar</label>
                                <div class="form-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input form-control" name="file" id="file_image">
                                        <label class="custom-file-label"><?= $get_pembina['gambar_pembina']; ?></label>
                                    </div>
                                    <small>jpg, png, jpeg</small>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <a href="">
                                    <img src="./gambar/pembina/<?= $get_pembina['gambar_pembina']; ?>" alt="" class="img-thumbnail mb-2" id="imgPreview" style="width: 150px; height: 150px; object-fit: cover;">
                                </a>
                            </div>
                            <div class="col-sm-6">
                                <button type="submit" name="update_pembina" class="btn btn-primary">Simpan</button>
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