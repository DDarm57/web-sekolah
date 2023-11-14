<?php include "../siswa/layout/header.php"; ?>

<?php
$id_siswa = $get_kegiatanSiswa['id_siswa'];
$id_kegiatan = $get_kegiatanSiswa['id_kegiatan'];

$get_siswa = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM data_siswa WHERE id_siswa='$id_siswa'"));
$get_kegiatan = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM data_kegiatan WHERE id_kegiatan='$id_kegiatan'"));

?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Home</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container">
            <div class="card">
                <div class="card-header">Profil</div>
                <div class="card-body">
                    <div class="d-flex flex-column align-items-center text-center">
                        <img src="https://png.pngtree.com/png-vector/20190704/ourlarge/pngtree-vector-user-young-boy-avatar-icon-png-image_1538408.jpg" alt="Admin" class="img-thumbnail" width="200">
                        <div class="mt-3">
                            <h4><?= $get_siswa['nama_siswa']; ?></h4>
                            <p class="text-secondary mb-1"><?= $get_kegiatan['nama_kegiatan']; ?></p>
                            <p class="text-muted font-size-sm"><?= $get_siswa['alamat']; ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include "../siswa/layout/footer.php"; ?>