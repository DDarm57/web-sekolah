<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ekstrakurikuler | MIFTAHUL ULUM</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="../admin/assets/plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../admin/assets/dist/css/adminlte.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="../admin/assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="../admin/assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="../admin/assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<?php session_start();

$log = $_SESSION['user_log'];

if ($log != true) {
    header('location: ../login_ekstra.php');
} else {
    $level = $_SESSION['level'];
    if ($level != 2) {
        header('location: ../login_ekstra.php');
    } else {
        include '../siswa/koneksi.php';
        $id_user =  $_SESSION['id_user'];
        $get_kegiatanSiswa = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM ekstrakurikuler WHERE siswa_userid='$id_user'"));
    }
}

?>

<body class="hold-transition layout-top-nav">
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand-md navbar-dark navbar-dark">
            <div class="container">
                <a href="../admin/assets/index3.html" class="navbar-brand">
                    <?php
                    $get_profilSekolah = mysqli_fetch_array(mysqli_query($conn, "SELECT logo_sekolah FROM profil_sekolah"));
                    ?>
                    <img src="../admin/gambar/<?= $get_profilSekolah['logo_sekolah']; ?>" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                    <span class="brand-text font-weight-light">Ekstrakurikuler Miftahul Ulum</span>
                </a>

                <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <?php include "../siswa/layout/navbar.php"; ?>

            </div>
        </nav>
        <!-- /.navbar -->