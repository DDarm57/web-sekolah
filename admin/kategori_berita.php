<?php include '../admin/template/header.php' ?>

<?php if (isset($_POST['tambah_Kberita'])) { ?>
    <?php
    require '../admin/functions/tambah.php';
    ?>
    <?php tambah_Kberita($_POST) ?>
<?php } ?>

<?php if (isset($_POST['edit_Kberita'])) { ?>
    <?php
    require '../admin/functions/update.php';
    ?>
    <?php update_Kberita($_POST) ?>
<?php } ?>

<?php if (isset($_GET['id_kategoriBerita'])) { ?>
    <?php
    require '../admin/functions/hapus.php';
    ?>
    <?php hapus_Kberita($_GET) ?>
<?php } ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Data Kategori Berita</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Data Kategori Berita</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="mb-2">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" id="tambah_Kberita">
                    <i class="fas fa-plus"></i> Tambah
                </button>
            </div>
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Data Kategori Berita</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kategori</th>
                                <th>Deskripsi</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            include './koneksi.php';
                            $query = mysqli_query($conn, "SELECT * FROM kategori_berita");
                            $n = 1;
                            while ($row = mysqli_fetch_array($query)) : ?>
                                <tr>
                                    <td><?= $n++; ?></td>
                                    <td><?= $row['nama_kategori']; ?></td>
                                    <td>
                                        <div class="desk">
                                            <?= $row['deskripsi']; ?>
                                        </div>
                                        <!-- <a href="#" data-toggle="modal" class="deskpripsi" data-target="#exampleModaldetail">Full Deskripsi</a> -->
                                    </td>
                                    <td>
                                        <a href="#" class="btn btn-warning edit-kategori" data-toggle="modal" data-target="#exampleModal" data-id_kategori="<?= $row['id_kategoriBerita']; ?>" data-nama_kategori="<?= $row['nama_kategori']; ?>" data-deskripsi="<?= $row['deskripsi']; ?>"><i class="fas fa-pen"></i></a>
                                        <a href="kategori_berita.php?id_kategoriBerita=<?= $row['id_kategoriBerita']; ?>" class="btn btn-danger hapus-kategori"><i class="fas fa-trash"></i></a>
                                    </td>
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

<!-- Modal -->
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
                <div class="card">
                    <div class="card-body">
                        <form action="#" method="POST" id="form-Kberita">
                            <input type="hidden" name="id_kategoriBerita" id="id_kategoriBerita">
                            <div class="form-group">
                                <label for="nama_kategori">Nama Kategori</label>
                                <input type="text" name="nama_kategori" id="nama_kategori" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="deskripsi">Deskripsi</label>
                                <textarea name="deskripsi" id="deskripsi" cols="30" rows="10" class="form-control"></textarea>
                            </div>
                            <div class="mt-2">
                                <button type="submit" class="btn btn-sm btn-primary" name="tambah_Kberita" id="t-dataKat">Tambah</button>
                            </div>
                        </form>
                    </div>
                    <!-- <div class="overlay" id="loader-card">
                        <i class="fas fa-2x fa-sync-alt fa-spin"></i>
                    </div> -->
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<?php include '../admin/template/footer.php' ?>