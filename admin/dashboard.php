<?php include '../admin/template/header.php' ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Dashboard</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard v1</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <?php
    include '../admin/koneksi.php';
    $get_thnAkd = mysqli_fetch_array(mysqli_query($conn, "SELECT id_tahunAkd FROM tahun_akademik WHERE status='aktif'"));
    $count_jurusan = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM program_studi"));
    $count_Kberita = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM kategori_berita"));
    $count_berita = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM data_berita"));
    $id_thnAkd = $get_thnAkd['id_tahunAkd'];
    // var_dump($get_thnAkd);
    $count_psbSiswa = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM psb_siswa WHERE id_thnAkd='$id_thnAkd'"));
    ?>
    <!-- Main content -->
    <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3><?= $count_jurusan; ?></h3>

                        <p>Jumlah Jurusan</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-school"></i>
                    </div>
                    <a href="data_studi.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3><?= $count_Kberita; ?></h3>

                        <p>Kategori Berita</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-list"></i>
                    </div>
                    <a href="kategori_berita.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3><?= $count_berita; ?></h3>
                        <p>Data Berita</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-th"></i>
                    </div>
                    <a href="data_berita.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3><?= $count_psbSiswa; ?></h3>
                        <p>Siswa Mendaftar</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-user-plus"></i>
                    </div>
                    <a href="siswa_psb.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3><?= mysqli_num_rows(mysqli_query($conn, "SELECT * FROM data_siswa")); ?></h3>
                        <p>Data Siswa</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-user"></i>
                    </div>
                    <a href="siswa_psb.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3><?= mysqli_num_rows(mysqli_query($conn, "SELECT * FROM data_pembina")); ?></h3>
                        <p>Data Pembina</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-user-tie"></i>
                    </div>
                    <a href="siswa_psb.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3><?= mysqli_num_rows(mysqli_query($conn, "SELECT * FROM data_kegiatan")); ?></h3>
                        <p>Kegiatan Ekstrakurikuler</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-running"></i>
                    </div>
                    <a href="siswa_psb.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3><?= mysqli_num_rows(mysqli_query($conn, "SELECT * FROM data_alumni")); ?></h3>

                        <p>Data Alumni</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-graduation-cap"></i>
                    </div>
                    <a href="siswa_psb.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
        </div>
    </div><!-- /.container-fluid -->
    <!-- /.content -->
</div>

<?php include '../admin/template/footer.php' ?>