<?php include '../admin/template/header.php' ?>

<?php if (isset($_POST['simpan_kegiatan'])) { ?>
    <?php
    require '../admin/functions/tambah.php';
    ?>
    <?php simpan_kegiatan($_POST) ?>
<?php } ?>

<?php

if (isset($_GET['id_kegiatan']) != null) {
    require '../admin/functions/hapus.php';
    hapus_kegiatan($_GET);
}

?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Data Kegiatan (Ekstrakurikuler)</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Data Kegiatan</li>
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
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" id="tambah-kegiatan">
                    <i class="fas fa-plus"></i> Tambah
                </button>
            </div>
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Data Kegiatan</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="example2" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Kegiatan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <?php
                        include '../admin/koneksi.php';
                        $query = mysqli_query($conn, "SELECT * FROM data_kegiatan");
                        ?>
                        <tbody>
                            <?php $n = 1;
                            while ($row = mysqli_fetch_array($query)) : ?>
                                <tr>
                                    <td><?= $n++; ?></td>
                                    <td><?= $row['nama_kegiatan']; ?></td>
                                    <td>
                                        <a href="detail_kegiatan.php?id_kegiatan=<?= $row['id_kegiatan']; ?>" class="btn btn-sm btn-info"><i class="fas fa-info"></i> Detail</a>
                                        <a href="data_kegiatan.php?id_kegiatan=<?= $row['id_kegiatan']; ?>" class="btn btn-sm btn-danger hapus"><i class="fas fa-trash"></i></a>
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
                <h5 class="modal-title" id="exampleModalLabel">Tambah Kegiatan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card">
                    <div class="card-body">
                        <form action="" method="POST" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="nama_kegiatan">Nama Kegiatan</label>
                                <input type="text" name="nama_kegiatan" id="nama_kegiatan" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="deskripsi_kegiatan">Deskripsi</label>
                                <textarea name="deskripsi_kegiatan" id="deskripsi_kegiatan" cols="30" rows="10" class="form-control"></textarea>
                            </div>
                            <div class="mt-2">
                                <button type="button" name="simpan_kegiatan" class="btn btn-primary">Simpan</button>
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