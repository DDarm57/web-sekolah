<?php include '../admin/template/header.php'; ?>

<?php
require '../admin/functions/update.php';
?>

<?php if (isset($_POST['update_profil'])) { ?>
    <?php if (edit_profilSekolah($_POST) > 0) { ?>
        <script>
            Swal.fire({
                title: 'Sukses',
                text: "Data berhasil di ubah",
                icon: 'success',
                showCancelButton: false,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'OK'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = 'settings.php';
                }
            })
        </script>
    <?php } else { ?>
        <script>
            Swal.fire({
                title: 'Gagal',
                text: "Data gagal di ubah",
                icon: 'error',
                showCancelButton: false,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'OK'
            })
        </script>
    <?php } ?>
<?php } ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Form Tambah Berita</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item">Settings</li>
                        <li class="breadcrumb-item active">Form Edit Profil Sekolah</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <?php
    include '../admin/koneksi.php';
    $query_edit = mysqli_query($conn, "SELECT * FROM profil_sekolah ORDER BY id_profilSekolah DESC LIMIT 1");
    $get_data = mysqli_fetch_array($query_edit);
    ?>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Form Edit Profil Sekolah</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <form action="#" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="id_profilSekolah" id="" value="<?= $get_data['id_profilSekolah']; ?>">
                        <input type="hidden" name="gmbLama_logo" id="" value="<?= $get_data['logo_sekolah']; ?>">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="nama_sekolah">Nama Sekolah</label>
                                    <input type="text" name="nama_sekolah" id="nama_sekolah" class="form-control" value="<?= $get_data['nama_sekolah']; ?>">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="alamat_sekolah">Alamat Sekolah</label>
                                    <input type="text" name="alamat_sekolah" id="alamat_sekolah" class="form-control" value="<?= $get_data['alamat_sekolah']; ?>">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="npsn">NPSN</label>
                                    <input type="number" name="npsn" id="npsn" class="form-control" value="<?= $get_data['npsn']; ?>">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="telp_sekolah">Telp Sekolah</label>
                                    <input type="number" name="telp_sekolah" id="telp_sekolah" class="form-control" value="<?= $get_data['telp_sekolah']; ?>">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="email_sekolah">Email Sekolah</label>
                                    <input type="email" name="email_sekolah" id="email_sekolah" class="form-control" value="<?= $get_data['email_sekolah']; ?>">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="visi_misi">Visi Misi</label>
                            <textarea name="visi_misi" id="summernote"><?= $get_data['visi_misi']; ?></textarea>
                        </div>
                        <div class="row">
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="">Gambar Logo</label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input form-control" name="file" id="file_image">
                                        <label for="" class="custom-file-label"><?= $get_data['logo_sekolah']; ?></label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <img src="../admin/gambar/<?= $get_data['logo_sekolah']; ?>" alt="" class="img-thumbnail" id="imgPreview" style="width: 150px; height: 150px; object-fit: cover;">
                            </div>
                        </div>
                        <div class="mt-2">
                            <button type="submit" name="update_profil" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
                <!-- /.card-body -->
            </div>
        </div><!-- /.container-fluid -->
        <!-- /.content -->
    </section>
</div>

<?php include '../admin/template/footer.php'; ?>