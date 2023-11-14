<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ADMIN SMK MIFTAHUL ULUM</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../admin/assets/plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="../admin/assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="../admin/assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- JQVMap -->
    <link rel="stylesheet" href="../admin/assets/plugins/jqvmap/jqvmap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../admin/assets/dist/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="../admin/assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="../admin/assets/plugins/daterangepicker/daterangepicker.css">
    <!-- summernote -->
    <link rel="stylesheet" href="../admin/assets/plugins/summernote/summernote-bs4.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="../admin/assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="../admin/assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="../admin/assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

    <!-- summernote -->
    <link rel="stylesheet" href="../admin/assets/plugins/summernote/summernote-bs4.min.css">

    <link rel="stylesheet" href="../admin/assets/bootstrap-select/dist/css/bootstrap-select.css">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">
    <!-- Toastr -->
    <link rel="stylesheet" href="../admin/assets/plugins/toastr/toastr.min.css">
    <!-- dt table online -->
    <!-- <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css"> -->

</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <style>
        .loader {
            border: 16px solid #f3f3f3;
            /* Light grey */
            border-top: 16px solid #3498db;
            /* Blue */
            border-radius: 50%;
            width: 120px;
            height: 120px;
            animation: spin 2s linear infinite;
        }

        .loader_image {
            border: 10px solid #f3f3f3;
            /* Light grey */
            border-top: 10px solid #3498db;
            /* Blue */
            border-radius: 50%;
            width: 70px;
            height: 70px;
            animation: spin 2s linear infinite;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        /* .table tr th {
            text-transform: uppercase;
        } */

        @-webkit-keyframes blinker {
            from {
                opacity: 1.0;
            }

            to {
                opacity: 0.3;
            }
        }

        .blink {
            text-decoration: blink;
            -webkit-animation-name: blinker;
            -webkit-animation-duration: 0.8s;
            -webkit-animation-iteration-count: infinite;
            -webkit-animation-timing-function: ease-in-out;
            -webkit-animation-direction: alternate;
        }
    </style>

    <div class="wrapper">
        <?php
        date_default_timezone_set("Asia/Jakarta");
        ob_start();
        session_start();

        $log = $_SESSION['log'];

        if ($log != true) {
            header('location: ../login.php');
        }

        ?>

        <!-- Preloader -->
        <!-- <div class="preloader flex-column justify-content-center align-items-center">
            <div class="loader"></div>
        </div> -->

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light bg-warning">
            <!-- Left navbar links -->
            <ul class="navbar-nav">

                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <!-- <li class="nav-item d-none d-sm-inline-block">
                    <a href="index3.html" class="nav-link">Home</a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="#" class="nav-link">Contact</a>
                </li> -->
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Navbar Search -->
                <!-- <li class="nav-item">
                    <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                        <i class="fas fa-search"></i>
                    </a>
                    <div class="navbar-search-block">
                        <form class="form-inline">
                            <div class="input-group input-group-sm">
                                <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                                <div class="input-group-append">
                                    <button class="btn btn-navbar" type="submit">
                                        <i class="fas fa-search"></i>
                                    </button>
                                    <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </li> -->

                <!-- Messages Dropdown Menu -->

                <!-- Notifications Dropdown Menu -->

                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
                <!-- <li class="nav-item">
                    <a class="nav-link" data-widget="control-sidebar" data-controlsidebar-slide="true" href="#" role="button">
                        <i class="fas fa-th-large"></i>
                    </a>
                </li> -->
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="index3.html" class="brand-link">
                <img src="../admin/assets/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">Admin WEB</span>
            </a>

            <!-- Sidebar -->
            <?php include '../admin/template/sidebar.php' ?>
            <!-- /.sidebar -->
        </aside>