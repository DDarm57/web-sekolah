<?php include '../admin/template/header.php'; ?>

<?php
require '../admin/functions/update.php';
?>

<?php if (isset($_POST['update_berita'])) { ?>
    <?php if (update_berita($_POST) > 0) { ?>
        <script>
            Swal.fire({
                title: 'Sukses',
                text: "Data berhasil di update",
                icon: 'success',
                showCancelButton: false,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'OK'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = 'data_berita.php';
                }
            })
        </script>
    <?php } else { ?>
        <script>
            Swal.fire({
                title: 'Gagal',
                text: "Data gagal di update",
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
                        <li class="breadcrumb-item">Data Berita</li>
                        <li class="breadcrumb-item active">Form Edit Berita</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <?php
    include '../admin/koneksi.php';
    $id_berita = $_GET['id_berita'];
    $get_data = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM data_berita WHERE id_berita='$id_berita'"));
    ?>
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Form Edit Berita</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <form action="#" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="id_berita" id="id_berita" value="<?= $get_data['id_berita']; ?>">
                        <input type="hidden" name="g_lamaBerita" id="" value="<?= $get_data['gambar_berita']; ?>">
                        <div class="form-group">
                            <label for="judul_berita">Judul</label>
                            <input type="text" name="judul_berita" id="judul_berita" class="form-control" value="<?= $get_data['judul_berita']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="deskripsi_berita">Deskripsi Berita</label>
                            <textarea name="deskripsi_berita" id="summernote"><?= $get_data['deskripsi_berita']; ?></textarea>
                        </div>
                        <?php
                        include '../admin/koneksi.php';
                        $query = mysqli_query($conn, "SELECT * FROM kategori_berita");
                        ?>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Kategori Berita</label>
                                    <select class="selectpicker form-control" name="id_kategoriBerita" data-live-search="true" title="Pilih Kategori Berita" required>
                                        <?php while ($row = mysqli_fetch_array($query)) : ?>
                                            <option <?= ($row['id_kategoriBerita'] == $get_data['id_kategoriBerita'] ? 'selected' : ''); ?> value="<?= $row['id_kategoriBerita']; ?>"><?= $row['nama_kategori']; ?></option>
                                        <?php endwhile; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="tgl_publish">Tanggal Upload</label>
                                    <input type="date" name="tgl_publish" id="tgl_publish" class="form-control" value="<?= $get_data['tgl_publish']; ?>">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <label for="gambar_berita">Gambar</label>
                                <div class="form-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input form-control" name="file" id="file_image">
                                        <label class="custom-file-label"><?= $get_data['gambar_berita']; ?></label>
                                    </div>
                                    <small>jpg, png, jpeg</small>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <img src="./gambar/gambar_berita/<?= $get_data['gambar_berita']; ?>" alt="" class="img-thumbnail" id="imgPreview" style="width: 150px; height: 150px; object-fit: cover;">
                            </div>
                        </div>
                        <div class="mt-2">
                            <button type="submit" name="update_berita" class="btn btn-primary">Simpan</button>
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