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

<?php if (isset($_GET['id_berita'])) { ?>
    <?php
    require '../admin/functions/hapus.php';
    ?>
    <?php hapus_berita($_GET) ?>
<?php } ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Data Berita</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Data Berita</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="mb-2"><a href="tambah_berita.php" class="btn btn-primary"><i class="fas fa-plus"></i> Buat Berita</a></div>
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Data Berita</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="example2" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Judul</th>
                                <th>Deskripsi</th>
                                <th>Kategori</th>
                                <th>Tanggal Upload</th>
                                <th>View</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <?php
                        include '../admin/koneksi.php';
                        $query = mysqli_query($conn, "SELECT * FROM data_berita INNER JOIN kategori_berita ON data_berita.id_kategoriBerita = kategori_berita.id_kategoriBerita
                        ");
                        ?>
                        <tbody>
                            <?php $n = 1;
                            while ($row = mysqli_fetch_array($query)) : ?>
                                <tr>
                                    <td><?= $n++; ?></td>
                                    <td><?= $row['judul_berita']; ?></td>
                                    <td>
                                        <div class="desk">
                                            <?= $row['deskripsi_berita']; ?>
                                        </div>
                                    </td>
                                    <td><?= $row['nama_kategori']; ?></td>
                                    <td><?= $row['tgl_publish']; ?></td>
                                    <td><?= $row['view']; ?></td>
                                    <td>
                                        <a href=" edit_berita.php?id_berita=<?= $row['id_berita']; ?>" class="btn btn-warning"><i class="fas fa-pen"></i></a>
                                        <a href="data_berita.php?id_berita=<?= $row['id_berita']; ?>" class="btn btn-danger hapus-berita"><i class="fas fa-trash"></i></a>
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


<?php include '../admin/template/footer.php' ?>