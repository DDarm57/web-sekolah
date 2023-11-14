<?php include '../admin/template/header.php' ?>


<?php if (isset($_POST['tambah_galeri'])) { ?>
    <?php
    require '../admin/functions/tambah.php';
    ?>
    <?php tambah_galeri($_POST) ?>
<?php } ?>

<?php if (isset($_POST['edit_galeri'])) { ?>
    <?php
    require '../admin/functions/update.php';
    ?>
    <?php update_galeri($_POST) ?>
<?php } ?>
<?php if (isset($_POST['reset-pw'])) { ?>
    <?php
    require '../admin/functions/update.php';
    ?>
    <?php reset_password($_POST) ?>
<?php } ?>

<?php if (isset($_GET['id_galeri'])) { ?>
    <?php
    require '../admin/functions/hapus.php';
    ?>
    <?php hapus_galeri($_GET) ?>
<?php } ?>

<?php if (isset($_POST['edit_kepsek'])) { ?>
    <?php
    require '../admin/functions/update.php';
    ?>
    <?php update_kepsek($_POST) ?>
<?php } ?>

<?php if (isset($_POST['edit_psb'])) { ?>
    <?php
    require '../admin/functions/update.php';
    ?>
    <?php update_psb($_POST) ?>
<?php } ?>

<?php if (isset($_POST['status_psb'])) { ?>
    <?php
    require '../admin/functions/update.php';
    ?>
    <?php status_psb($_POST) ?>
<?php } ?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Settings</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item">Settings</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-3">
                    <a href="#" data-toggle="modal" data-target="#exampleModalKepsek">
                        <div class="callout callout-info">
                            <h5>Kepala Sekolah</h5>
                            <p>
                                <i class="fas fa-wrench"></i>
                                <i class="fas fa-user-tie"></i>
                            </p>
                        </div>
                    </a>
                </div>
                <div class="col-sm-3">
                    <a href="edit_profilSekolah.php">
                        <div class="callout callout-info">
                            <h5>Profile Sekolah</h5>
                            <p>
                                <i class="fas fa-wrench"></i>
                                <i class="fas fa-school"></i>
                            </p>
                        </div>
                    </a>
                </div>
                <div class="col-sm-3">
                    <a href="#" data-toggle="modal" data-target="#exampleModal" id="sosial_media">
                        <div class="callout callout-info">
                            <h5>Sosial Media</h5>
                            <p>
                                <i class="fas fa-wrench"></i>
                                <i class="fab fa-facebook"></i>
                                <i class="fab fa-instagram-square"></i>
                                <i class="fab fa-twitter"></i>
                                <i class="fab fa-google-plus-square"></i>
                            </p>
                        </div>
                    </a>
                </div>
                <div class="col-sm-3">
                    <a href="#" id="galeri">
                        <div class="callout callout-info">
                            <h5>Galery</h5>
                            <p>
                                <i class="fas fa-wrench"></i>
                                <i class="fas fa-images"></i>
                            </p>
                        </div>
                    </a>
                </div>
                <div class="col-sm-3">
                    <a href="#" data-toggle="modal" data-target="#exampleModaluser">
                        <div class="callout callout-info">
                            <h5>RESET PASSWORD</h5>
                            <p>
                                <i class="fas fa-wrench"></i>
                                <i class="fas fa-lock"></i>
                            </p>
                        </div>
                    </a>
                </div>
                <div class="col-sm-3">
                    <?php
                    include '../admin/koneksi.php';
                    $get_psb = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM psb"));
                    ?>
                    <a href="#" data-toggle="modal" data-target="#exampleModalpsb" id="t-psb">
                        <div class="callout callout-warning bg-<?= ($get_psb['status'] == 'aktif' ? 'success' : 'danger'); ?>">
                            <h5 style="text-transform:uppercase">PSB ONLINE | <?= $get_psb['status']; ?></h5>
                            <p>
                                <i class="fas fa-wrench"></i>
                                <i class="fas fa-user-plus"></i>
                            </p>
                        </div>
                    </a>
                </div>
            </div>
            <!-- Modal reset password -->
            <div class="modal fade" id="exampleModaluser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Reset Password (Admin)</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="" method="POST">
                                <div class="form-group">
                                    <label for="password">Password (Lama)</label>
                                    <input type="text" name="password_lama" id="password" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="password">Password (Baru)</label>
                                    <input type="text" name="password_baru" id="password" class="form-control" required>
                                </div>
                                <div class="mt-2">
                                    <button type="submit" name="reset-pw" onclick="return confirm('Yakin ingin reset password')" class="btn btn-sm btn-primary">RESET</button>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
            <div id="tabel-galeri" hidden>
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between">
                            Tabel Galeri
                            <a href="#" data-toggle="modal" data-target="#exampleModalgaleri" class="btn btn-sm btn-primary" id="t-galeri">Tambah</a>
                        </div>
                    </div>
                    <div class="card-body" style="overflow-x: auto;">
                        <table id="example1" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Judul Gambar</th>
                                    <th>Deskripsi Gambar</th>
                                    <th>Gambar</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <?php
                            include '../admin/koneksi.php';
                            $query = mysqli_query($conn, "SELECT * FROM galeri");
                            ?>
                            <tbody>
                                <?php $n = 1;
                                while ($row = mysqli_fetch_array($query)) : ?>
                                    <tr>
                                        <td><?= $n++; ?></td>
                                        <td><?= $row['judul_gambar']; ?></td>
                                        <td>
                                            <div class="desk">
                                                <?= $row['deskripsi_gambar']; ?>
                                            </div>
                                        </td>
                                        <td><img src="./gambar/galeri/<?= $row['gambar']; ?>" alt="" class="img-thumbnail" style="width: 150px; height: 150px; object-fit: cover;"></td>
                                        <td>
                                            <div class="btn-group">
                                                <a href="#" class="btn btn-warning edit-galeri" data-id_galeri="<?= $row['id_galeri']; ?>" data-judul_galeri="<?= $row['judul_gambar']; ?>" data-desk_galeri="<?= $row['deskripsi_gambar']; ?>" data-gambar="<?= $row['gambar']; ?>" data-toggle="modal" data-target="#exampleModalgaleri"><i class="fas fa-pen"></i></a>
                                                <a href="settings.php?id_galeri=<?= $row['id_galeri']; ?>" class="btn btn-danger hapus-galeri"><i class="fas fa-trash"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
        <!-- /.content -->
    </section>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModalKepsek" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php include '../admin/koneksi.php';
            $kepsek = mysqli_fetch_array(mysqli_query($conn, "SELECT id_profilSekolah, kepala_sekolah, gmb_kepSek FROM profil_sekolah"));
            ?>
            <div class="modal-body">
                <div class="card">
                    <div class="card-header">Profil Kepala Sekolah</div>
                    <div class="card-body">
                        <form action="#" method="POST" enctype="multipart/form-data" id="form-kepsek">
                            <input type="hidden" name="id_profilSekolah" id="" value="<?= $kepsek['id_profilSekolah']; ?>">
                            <input type="hidden" name="g_lamaKepsek" id="" value="<?= $kepsek['gmb_kepSek']; ?>">
                            <div class="d-flex justify-content-center">
                                <img src="./gambar/<?= $kepsek['gmb_kepSek']; ?>" alt="" id="imgPreview" class="img-thumbnail" width="250">
                            </div>
                            <div class="form-group">
                                <label for="gambar_berita">Gambar</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input form-control" name="file" id="file_image">
                                    <label class="custom-file-label"><?= $kepsek['gmb_kepSek']; ?></label>
                                </div>
                                <small>jpg, png, jpeg</small>
                            </div>
                            <div class="form-group">
                                <label for="kepala_sekolah">Kepala Sekolah</label>
                                <input type="text" name="kepala_sekolah" id="kepala_sekolah" class="form-control" value="<?= $kepsek['kepala_sekolah']; ?>">
                            </div>
                            <div class="mt-2">
                                <button type="submit" name="edit_kepsek" class="btn btn-sm btn-primary">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- modal edit social media -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card mt-2">
                    <div class="card-header">Tabel Sosial Media</div>
                    <div class="card-body">
                        <form action="#" method="POST" id="form">
                            <input type="hidden" name="id_sosialMedia" id="id_sosialMedia">
                            <div class="form_tambahSosial">
                                <div class="form-group">
                                    <label for="tipe_sosialMedia">Tipe Sosial Media</label>
                                    <select name="tipe_sosialMedia" class="form-control selectpicker" id="tipe_sosialMedia" data-live-search="true" title="Tipe Sosial Media">
                                        <option value="facebook">Facebook</option>
                                        <option value="instagram">Instagram</option>
                                        <option value="twitter">Twitter</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="link_sosialMedia">Link Sosial Media</label>
                                    <input type="link" name="link_sosialMedia" id="link_sosialMedia" class="form-control">
                                    <div class="invalid-feedback validasi"></div>
                                </div>
                                <div class="mt-2">
                                    <button type="submit" class="btn btn-sm btn-primary" id="btn-form">Simpan</button>
                                </div>
                            </div>
                        </form>

                        <table class="table table-bordered table-responsive mt-2">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Tipe</th>
                                    <th scope="col">Link</th>
                                    <th scope="col">Tautan di klik</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="tbl_sosialMedia">

                            </tbody>
                        </table>
                        <div class="overlay" id="loader-tabel">
                            <i class="fas fa-2x fa-sync-alt fa-spin"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" id="btn-close">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- modal edit social media -->
<div class="modal fade" id="exampleModalgaleri" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body modal-galeri">
                <div class="card mt-2">
                    <div class="card-header">Form Galeri</div>
                    <div class="card-body">
                        <form action="" method="POST" id="form-galeri" enctype="multipart/form-data">
                            <input type="hidden" name="id_galeri" id="id_galeri">
                            <input type="hidden" name="g_lamaGaleri" id="g_lamaGaleri">
                            <div class="form-group">
                                <label for="judul_gambar">Judul Gambar</label>
                                <input type="text" name="judul_gambar" id="judul_gambar" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Deskripsi Gambar</label>
                                <textarea name="deskripsi_gambar" id="deskripsi_gambar" class="form-control"></textarea>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <label for="gambar_berita">Gambar</label>
                                    <div class="form-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input form-control" name="file" id="image_galeri" required>
                                            <label class="custom-file-label">Choose file...</label>
                                        </div>
                                        <small>jpg, png, jpeg</small>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <img src="./gambar/galeri/default.jpg" alt="" class="img-thumbnail" id="preview_galeri" style="width: 150px; height: 150px; object-fit: cover;">
                                </div>
                            </div>
                            <div class="mt-2">
                                <button type="submit" class="btn btn-sm btn-primary" name="tambah_galeri" id="btn-Sgaleri">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" id="btn-close">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal psb -->
<div class="modal fade" id="exampleModalpsb" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Informasi PSB ONLINE</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body modal-psb">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="alert alert-warning alert-dismissible">
                            <h5><i class="icon fas fa-exclamation-triangle"></i>Peringatan !</h5>
                            Klik Toggle Switch on/off di samping dan update jika membuka pendaftaran dan menutup pendaftaran online
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="callout callout-info mb-2">
                            <form action="#" method="POST" id="form-statusPsb">
                                <input type="hidden" name="id_psb" id="id_psb" value="<?= $get_psb['id_psb']; ?>">
                                <div class="d-flex justify-content-between">
                                    <?php if ($get_psb['status'] == 'aktif') : ?>
                                        <h3 style="text-transform:uppercase">PSB ONLINE | <strong class="text-<?= ($get_psb['status'] == 'aktif' ? 'success blink' : 'danger'); ?>"><?= $get_psb['status']; ?></strong></h3>
                                    <?php endif; ?>

                                    <?php if ($get_psb['status'] == 'tidak aktif') : ?>
                                        <h4 style="text-transform:uppercase">PSB ONLINE | <strong class="text-<?= ($get_psb['status'] == 'aktif' ? 'success blink' : 'danger'); ?>"><?= $get_psb['status']; ?></strong></h4>
                                    <?php endif; ?>
                                    <input type="checkbox" <?= ($get_psb['status'] == 'aktif' ? 'checked' : ''); ?> data-toggle="toggle" name="status" value="aktif" data-onstyle="outline-success" data-offstyle="outline-danger">
                                </div>
                                <div class="mt-4">
                                    <button type="submit" name="status_psb" class="btn btn-sm btn-primary" id="btn-statusPsb"><i class="fas fa-envelope"></i> Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <form action="#" method="POST">
                    <input type="hidden" name="id_psb" id="id_psb" value="<?= $get_psb['id_psb']; ?>">
                    <div class="form-group">
                        <label for="deskripsi">Deskripsi</label>
                        <textarea name="deskripsi" id="deskripsi" cols="30" rows="5" class="form-control"><?= $get_psb['deskripsi']; ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="">Persyaratan</label>
                        <textarea name="persyaratan" id="summernote"><?= $get_psb['persyaratan']; ?></textarea>
                    </div>
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="tgl_buka">Tanggal Buka</label>
                                <input type="date" name="tgl_buka" id="tgl_buka" class="form-control" value="<?= $get_psb['tgl_buka']; ?>">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="tgl_tutup">Tanggal Tutup</label>
                                <input type="date" name="tgl_tutup" id="tgl_tutup" class="form-control" value="<?= $get_psb['tgl_tutup']; ?>">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="tgl_tutup">Tanggal Pengumuman</label>
                                <input type="date" name="tgl_pengumuman" id="tgl_pengumuman" class="form-control" value="<?= $get_psb['tgl_pengumuman']; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="mt-2">
                        <button type="submit" name="edit_psb" class="btn btn-sm btn-primary" id="btn-psb" hidden>Simpan</button>
                    </div>
                </form>
                <div class="mt-2">
                    <button type="button" class="btn btn-sm btn-primary" id="edit-psb">Edit</button>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<?php include '../admin/template/footer.php' ?>