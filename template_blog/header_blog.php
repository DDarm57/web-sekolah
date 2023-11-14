<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="TemplateMo">
    <meta property="og:url" content="https://www.your-domain.com/your-page.html" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="Your Website Title" />
    <meta property="og:description" content="Your description" />
    <meta property="og:image" content="https://www.your-domain.com/path/image.jpg" />
    <link rel="stylesheet" href="admin/assets/plugins/fontawesome-free/css/all.min.css">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900" rel="stylesheet">

    <title>SMK MIFTAHUL ULUM</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">


    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="assets/css/fontawesome.css">
    <link rel="stylesheet" href="assets/css/templatemo-edu-meeting.css">
    <link rel="stylesheet" href="assets/css/owl.css">
    <link rel="stylesheet" href="assets/css/lightbox.css">
    <!--

TemplateMo 569 Edu Meeting

https://templatemo.com/tm-569-edu-meeting

-->
</head>

<body>
    <style>
        .text {
            white-space: nowrap;
            text-overflow: ellipsis;
            overflow: hidden;


            @supports (-webkit-line-clamp: 2) {
                overflow: hidden;
                text-overflow: ellipsis;
                white-space: initial;
                display: -webkit-box;
                -webkit-line-clamp: 2;
                -webkit-box-orient: vertical;
            }
        }
    </style>
    <?php
    include 'admin/koneksi.php';
    $fb = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM sosial_media WHERE tipe_sosialMedia='facebook'"));
    $twit = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM sosial_media WHERE tipe_sosialMedia='twitter'"));
    $ig = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM sosial_media WHERE tipe_sosialMedia='instagram'"));
    ?>


    <!-- Sub Header -->
    <div class="sub-header">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-sm-8">
                    <div class="left-content">
                        <p>This is an educational <em>HTML CSS</em> template by TemplateMo website.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-4">
                    <div class="right-icons">
                        <ul>
                            <li><a href="<?= $fb['link_sosialMedia']; ?>" target="_blank"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="<?= $twit['link_sosialMedia']; ?>" target="_blank"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="<?= $ig['link_sosialMedia']; ?>" target="_blank"><i class="fa fa-instagram"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ***** Header Area Start ***** -->
    <header class="header-area header-sticky">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <nav class="main-nav">
                        <!-- ***** Logo Start ***** -->
                        <a href="index.php" class="logo">
                            SMK MIFTAHUL ULUM
                        </a>
                        <!-- ***** Logo End ***** -->
                        <!-- ***** Menu Start ***** -->
                        <?php include 'template_blog/navbar_blog.php' ?>
                        <a class='menu-trigger'>
                            <span>Menu</span>
                        </a>
                        <!-- ***** Menu End ***** -->
                    </nav>
                </div>
            </div>
        </div>
    </header>