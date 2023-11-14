<?php include '../admin/template/header.php' ?>


<?php if (isset($_POST['simpan_kelas'])) { ?>
    <?php
    require '../admin/functions/tambah.php';
    ?>
    <?php simpan_kelas($_POST) ?>
<?php } ?>

<?php
if (isset($_GET['id_kelas'])) {
    require '../admin/functions/hapus.php';
    hapus_kelas($_GET);
}

if (isset($_POST['update_kelas'])) {
    require '../admin/functions/update.php';
    update_kelas($_POST);
}

?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Data Kelas</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Data Kelas</li>
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
                <div class="d-flex justify-content-start">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" id="tambah-kelas">
                        <i class="fas fa-plus"></i> Tambah Kelas
                    </button>
                    <div class="px-2">
                        <a href="kenaikan_kelas.php" class="btn btn-primary">Atur Kenaikan Kelas</a>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Data Kelas</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="example2" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Kelas</th>
                                <th>Jumlah Bangku</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <?php
                        include '../admin/koneksi.php';
                        $query = mysqli_query($conn, "SELECT * FROM kelas");
                        ?>
                        <tbody>
                            <?php $n = 1;
                            while ($row = mysqli_fetch_array($query)) : ?>
                                <tr>
                                    <td><?= $n++; ?></td>
                                    <td><?= $row['nama_kelas']; ?></td>
                                    <td><?= $row['jumlah_bangku']; ?></td>
                                    <td><?= $row['status']; ?></td>
                                    <td>
                                        <a href="detail_kelas.php?id_kelas=<?= $row['id_kelas']; ?>" class="btn btn-sm btn-info"><i class="fas fa-info"></i> Detail</a>
                                        <a href="" class="btn btn-sm btn-warning edit_kelas" data-toggle="modal" data-target="#exampleModal" data-id_kelas="<?= $row['id_kelas']; ?>" data-nama_kelas="<?= $row['nama_kelas']; ?>" data-jml_bangku="<?= $row['jumlah_bangku']; ?>"><i class="fas fa-pen"></i></a>
                                        <a href="data_kelas.php?id_kelas=<?= $row['id_kelas']; ?>" class="btn btn-sm btn-danger hapus"><i class="fas fa-trash"></i></a>
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
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Kelas</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card">
                    <div class="card-body">
                        <form action="" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="id_kelas" id="id_kelas">
                            <div class="form-group">
                                <label for="">Nama Kelas</label>
                                <select class="selectpicker form-control" id="nama_kelas" name="nama_kelas" data-live-search="true" title="Nama Kelas" required>
                                    <option value="X">X</option>
                                    <option value="XI">XI</option>
                                    <option value="XII">XII</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="jumlah_bangku">Jumlah Bangku</label>
                                <input type="number" name="jumlah_bangku" id="jumlah_bangku" class="form-control" required>
                            </div>
                            <div class="mt-2">
                                <button type="submit" name="simpan_kelas" class="btn btn-primary btn-formKelas">Simpan</button>
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




<?php include '../admin/template/footer.php' ?>