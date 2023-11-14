<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Dashboard</title>

    <!-- Custom fonts for this template-->
    <link href="../pembina/assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../pembina/assets/css/sb-admin-2.min.css" rel="stylesheet">
    <link href="../pembina/assets/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">
        <?php session_start();

        $log = $_SESSION['user_log'];

        if ($log != true) {
            header('location: ../login_ekstra.php');
        } else {
            $level = $_SESSION['level'];
            if ($level != 1) {
                header('location: ../login_ekstra.php');
            } else {
                include '../pembina/koneksi.php';
                $id_user =  $_SESSION['id_user'];
                $get_pembina = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM data_pembina WHERE pembina_userid='$id_user'"));
            }
        }

        ?>

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <div class="sidebar-brand-icon">
                    <i class="fas fa-running"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Pembina <sup>Ekstrakurikuler</sup></div>
            </a>

            <?php include "../pembina/layout_pembina/sidebar.php" ?>

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Search -->
                    <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>
                        <?php
                        $id_kegiatan = $get_pembina['mengajar_kegiatan'];
                        $count_nilaiValidasi = mysqli_num_rows(mysqli_query($conn, "SELECT status_validasi FROM ekstrakurikuler WHERE id_kegiatan='$id_kegiatan' AND status_validasi='validasi nilai'"));
                        ?>
                        <?php if ($count_nilaiValidasi > 0) : ?>
                            <!-- Nav Item - Alerts -->
                            <li class="nav-item dropdown no-arrow mx-1">
                                <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-bell fa-fw"></i>
                                    <!-- Counter - Alerts -->
                                    <span class="badge badge-danger badge-counter"><?= $count_nilaiValidasi; ?></span>
                                </a>
                                <!-- Dropdown - Alerts -->
                                <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
                                    <h6 class="dropdown-header">
                                        Nilai Yang Belum Divalidasi
                                    </h6>
                                    <?php
                                    $query_siswaValidasi = mysqli_query($conn, "SELECT * FROM ekstrakurikuler INNER JOIN tahun_akademik ON tahun_akademik.id_tahunAkd = ekstrakurikuler.id_thnAkd INNER JOIN data_siswa ON data_siswa.id_siswa = ekstrakurikuler.id_siswa WHERE id_kegiatan = '$id_kegiatan' AND status_validasi='validasi nilai' ORDER BY id_ekstra DESC LIMIT 5");
                                    ?>
                                    <?php foreach ($query_siswaValidasi as $siswa_validasi) : ?>
                                        <a class="dropdown-item d-flex align-items-center" href="#">
                                            <div class="mr-3">
                                                <div class="icon-circle bg-primary">
                                                    <i class="fas fa-file-alt text-white"></i>
                                                </div>
                                            </div>
                                            <div>
                                                <?php
                                                $siswa_userid = $siswa_validasi['siswa_userid'];
                                                $get_siswaUser = mysqli_fetch_array(mysqli_query($conn, "SELECT id_user,created_at FROM users WHERE id_user='$siswa_userid'")); ?>
                                                <div class="small text-gray-500"><?= $get_siswaUser['created_at']; ?></div>
                                                <span class="font-weight-bold">Siswa Dengan NISN : <?= $siswa_validasi['nisn']; ?> || Nama : <?= $siswa_validasi['nama_siswa']; ?> Baru Mendaftar Kegiatan dan Nilai Belum Divalidasi</span>
                                            </div>
                                        </a>
                                    <?php endforeach; ?>
                                    <a class="dropdown-item text-center small text-gray-500" href="validasi_nilai.php">Halaman Validasi Nilai</a>
                                </div>
                            </li>
                        <?php endif; ?>

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= $get_pembina['nama_pembina']; ?></span>
                                <img class="img-profile rounded-circle" src="../admin/gambar/pembina/<?= $get_pembina['gambar_pembina']; ?>">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>
                    </ul>
                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->