<?php include '../admin/template/header.php' ?>

<style>
    td {
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .desk p {
        height: 22px;
        width: 300px;
        padding: 0;
        overflow: hidden;
        position: relative;
        display: inline-block;
        margin: 0 5px 0 5px;
        text-align: left;
        text-decoration: none;
        text-overflow: ellipsis;
        white-space: nowrap;
        color: #000;
    }
</style>

<?php if (isset($_POST['tambah_studi'])) { ?>
    <?php
    require '../admin/functions/tambah.php';
    ?>
    <?php tambah_studi($_POST) ?>
<?php } ?>
<?php if (isset($_POST['edit_studi'])) { ?>
    <?php
    require '../admin/functions/update.php';
    ?>
    <?php update_studi($_POST) ?>
<?php } ?>
<?php if (isset($_GET['id_Pstudi'])) { ?>
    <?php
    require '../admin/functions/hapus.php';
    ?>
    <?php hapus_studi($_GET) ?>
<?php } ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Data Program Studi</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Data Program Studi</li>
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
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" id="tambah-studi">
                    <i class="fas fa-plus"></i> Tambah
                </button>
            </div>
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Data Program Studi</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="example2" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Studi</th>
                                <th>Deskripsi</th>
                                <th>Gambar</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <?php
                        include '../admin/koneksi.php';
                        $query = mysqli_query($conn, "SELECT * FROM program_studi");
                        ?>
                        <tbody>
                            <?php $n = 1;
                            while ($row = mysqli_fetch_array($query)) : ?>
                                <tr>
                                    <td><?= $n++; ?></td>
                                    <td><?= $row['nama_studi']; ?></td>
                                    <td>
                                        <div class="desk">
                                            <?= $row['deskripsi_studi']; ?>
                                        </div>
                                    </td>
                                    <td><img src="./gambar/<?= $row['gambar_studi']; ?>" alt="" class="img-thumbnail" id="imgPreview" style="width: 150px; height: 150px; object-fit: cover;"></td>
                                    <td>
                                        <a href="#" class="btn btn-warning edit-studi" data-toggle="modal" data-target="#exampleModal" data-id_Pstudi="<?= $row['id_Pstudi']; ?>" data-nama_studi="<?= $row['nama_studi']; ?>" data-desk_studi="<?= $row['deskripsi_studi']; ?>" data-gambar_studi="<?= $row['gambar_studi']; ?>"><i class="fas fa-pen"></i></a>
                                        <a href="data_studi.php?id_Pstudi=<?= $row['id_Pstudi']; ?>" class="btn btn-danger hapus-studi"><i class="fas fa-trash"></i></a>
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
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card">
                    <div class="card-body">
                        <form action="#" method="POST" id="form-studi" enctype="multipart/form-data">
                            <input type="hidden" name="id_Pstudi" id="id_Pstudi">
                            <input type="hidden" name="gLama_studi" id="gLama_studi">
                            <div class="form-group">
                                <label for="nama_studi">Nama Studi</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="nama_studi" name="nama_studi" placeholder="Username" aria-describedby="inputGroupPrepend" disabled readonly>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroupPrepend"><a href="#" id="edit-namaStudi">Edit</a></span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="deskripsi_studi">Deskripsi</label>
                                <textarea name="deskripsi_studi" id="desk_studi" class="form-control"></textarea>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <label for="gambar_studi">Gambar</label>
                                    <div class="form-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input form-control" name="file" id="file_image">
                                            <label class="custom-file-label">Choose file...</label>
                                        </div>
                                        <small>jpg, png, jpeg</small>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <img src="./gambar/default.jpg" alt="" class="img-thumbnail" id="imgPreview" style="width: 150px; height: 150px; object-fit: cover;">
                                </div>
                            </div>
                            <div class="mt-2">
                                <button type="submit" class="btn btn-sm btn-primary" name="tambah_studi" id="t-dataStudi">Simpan</button>
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