<?php include '../admin/template/header.php' ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Data Pesan</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Data Pesan</li>
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
                    <h3 class="card-title">Data Pesan</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Subjek</th>
                                <th>Pesan</th>
                            </tr>
                        </thead>
                        <?php
                        include '../admin/koneksi.php';
                        $query = mysqli_query($conn, "SELECT * FROM pesan_user");
                        ?>
                        <tbody>
                            <?php $n = 1;
                            while ($row = mysqli_fetch_array($query)) : ?>
                                <tr>
                                    <td><?= $n++; ?></td>
                                    <td><?= $row['name']; ?></td>
                                    <td><?= $row['email']; ?></td>
                                    <td><?= $row['subject']; ?></td>
                                    <td><?= $row['message']; ?></td>
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
                                <small id="rules-studi">Nama studi tidak boleh sama dengan data yang tersimpan</small>
                            </div>
                            <div class="form-group">
                                <label for="deskripsi_studi">Deskripsi</label>
                                <textarea name="deskripsi_studi" id="summernote" class="form-control">-</textarea>
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
                                <button type="submit" class="btn btn-sm btn-primary" name="tambah_studi" id="t-dataStudi">Tambah</button>
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