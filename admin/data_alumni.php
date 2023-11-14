<?php include '../admin/template/header.php' ?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Data Alumni</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Data Alumni</li>
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
                    <h3 class="card-title">Data Kelas</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>NISN</th>
                                <th>NAMA SISWA</th>
                                <th>TGL LAHIR</th>
                                <th>ALAMAT</th>
                                <th>STATUS</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $query = mysqli_query($conn, "SELECT * FROM data_siswa INNER JOIN data_akademik ON data_siswa.id_siswa = data_akademik.id_siswa WHERE status='lulus' ORDER BY data_siswa.id_siswa DESC"); ?>
                            <?php $n = 1;
                            while ($row = mysqli_fetch_array($query)) : ?>
                                <tr>
                                    <td><?= $n++; ?></td>
                                    <td><?= $row['nisn']; ?></td>
                                    <td><?= $row['nama_siswa']; ?></td>
                                    <td><?= $row['tempat_lahir'] . ", " . $row['tgl_lahir']; ?></td>
                                    <td><?= $row['alamat']; ?></td>
                                    <td>
                                        <strong>
                                            <p style="text-transform:uppercase" class="text-<?= ($row['status'] == 'lulus' ? 'success bg-success rounded' : 'danger bg-danger rounded'); ?> text-center"><?= $row['status']; ?></p>
                                        </strong>
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