<?php include '../admin/template/header.php' ?>

<?php
if (isset($_GET['id_pembina'])) {
    require '../admin/functions/hapus.php';
    hapus_pembina($_GET);
}
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Data Pembina</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Data Pembina</li>
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
                    <div class="d-flex justify-content-between">
                        <div class="card-title">Data Pembina</div>
                        <a href="tambah_pembina.php" class="btn btn-sm btn-primary"><i class="fas fa-user-plus"></i> Tambah Data Pembina</a>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>NIP</th>
                                <th>Nama Pembina</th>
                                <th>Alamat</th>
                                <th>No HP</th>
                                <th>Mengajar</th>
                                <th>Gambar</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <?php
                        include '../admin/koneksi.php';
                        $query = mysqli_query($conn, "SELECT * FROM data_pembina INNER JOIN data_kegiatan ON data_pembina.mengajar_kegiatan = data_kegiatan.id_kegiatan ORDER BY data_pembina.id_pembina DESC");
                        ?>
                        <tbody>
                            <?php $n = 1;
                            while ($row = mysqli_fetch_array($query)) : ?>
                                <tr>
                                    <td><?= $n++; ?></td>
                                    <td><?= $row['nip']; ?></td>
                                    <td><?= $row['nama_pembina']; ?></td>
                                    <td><?= $row['alamat_pembina']; ?></td>
                                    <td><?= $row['no_hp']; ?></td>
                                    <td><?= $row['nama_kegiatan']; ?></td>
                                    <td><a href="" class="cek_gambar" data-nama="<?= $row['nama_pembina']; ?>" data-nama_gambar="<?= $row['gambar_pembina']; ?>">Cek Gambar</a></td>
                                    <td>
                                        <strong>
                                            <p style="text-transform:uppercase" class="text-<?= ($row['status'] == 'aktif' ? 'success bg-success rounded' : 'danger bg-danger rounded'); ?> text-center"><?= $row['status']; ?></p>
                                        </strong>
                                    </td>
                                    <td>
                                        <a href="edit_pembina.php?id_pembina=<?= $row['id_pembina']; ?>" class="btn btn-sm btn-warning"><i class="fas fa-pen"></i></a>
                                        <a href="data_pembina.php?id_pembina=<?= $row['id_pembina']; ?>" class="btn btn-sm btn-danger hapus"><i class="fas fa-trash"></i></a>
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