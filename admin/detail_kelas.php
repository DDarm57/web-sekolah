<?php include '../admin/template/header.php' ?>

<?php
$id_kelas = $_GET['id_kelas'];
include '../admin/koneksi.php';
$get_kelas = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM kelas WHERE id_kelas='$id_kelas'"));
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Detail Kelas <?= $get_kelas['nama_kelas']; ?></h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="data_kelas.php">Data Kelas</a></li>
                        <li class="breadcrumb-item active">Detail Kelas <?= $get_kelas['nama_kelas']; ?></li>
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
                    <h3 class="card-title">Data Kelas <?= $get_kelas['nama_kelas']; ?></h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>NISN</th>
                                <th>NAMA SISWA</th>
                                <th>KELAS</th>
                                <th>JURUSAN</th>
                            </tr>
                        </thead>
                        <?php
                        include '../admin/koneksi.php';
                        $query_akademik = mysqli_query($conn, "SELECT * FROM data_akademik INNER JOIN tahun_akademik ON tahun_akademik.id_tahunAkd = data_akademik.id_thnAkd INNER JOIN data_siswa ON data_siswa.id_siswa = data_akademik.id_siswa INNER JOIN kelas ON kelas.id_kelas = data_akademik.id_kelas INNER JOIN program_studi ON program_studi.id_Pstudi = data_akademik.id_Pstudi WHERE kelas.id_kelas = '$id_kelas' AND tahun_akademik.status = 'aktif'");
                        // $cek_data = mysqli_fetch_all($query_akademik);
                        // var_dump($cek_data);
                        ?>
                        <tbody>
                            <?php $n = 1;
                            while ($row = mysqli_fetch_array($query_akademik)) : ?>
                                <tr>
                                    <td><?= $n++; ?></td>
                                    <td><?= $row['nisn']; ?></td>
                                    <td><?= $row['nama_siswa']; ?></td>
                                    <td>KELAS <?= $row['nama_kelas']; ?></td>
                                    <td><?= $row['nama_studi']; ?></td>
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