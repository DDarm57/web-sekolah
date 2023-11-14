<?php include 'template_blog/header_blog.php' ?>
<!-- ***** Header Area End ***** -->

<?php
include 'admin/koneksi.php';
function tgl_indo($tanggal)
{
    $bulan = array(
        1 =>   'Januari',
        'Februari',
        'Maret',
        'April',
        'Mei',
        'Juni',
        'Juli',
        'Agustus',
        'September',
        'Oktober',
        'November',
        'Desember'
    );
    $pecahkan = explode('-', $tanggal);

    // variabel pecahkan 0 = tahun
    // variabel pecahkan 1 = bulan
    // variabel pecahkan 2 = tanggal

    return $pecahkan[2] . ' ' . $bulan[(int)$pecahkan[1]] . ' ' . $pecahkan[0];
}

$nama_studi = $_GET['jurusan'];
$get_data = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM program_studi WHERE nama_studi='$nama_studi'"))


?>

<section class="heading-page header-text" id="top">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h2><?= $get_data['nama_studi']; ?></h2>
            </div>
        </div>
    </div>
</section>

<section class="meetings-page" id="meetings">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="meeting-single-item">
                            <div class="thumb">
                                <div class="price">
                                    <span><?= $get_data['nama_studi']; ?></span>
                                </div>
                                <a href="#"><img src="admin/gambar/<?= $get_data['gambar_studi']; ?>" alt=""></a>
                            </div>
                            <div class="down-content">
                                <a href="#">
                                    <h4><?= $get_data['nama_studi']; ?></h4>
                                </a>
                                <p class="mt-4">
                                    <?= $get_data['deskripsi_studi']; ?>
                                </p>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="hours">
                                            <h5>Tanggal</h5>
                                            <p>Di Publish Pada jam : <?= date('H : i', strtotime($get_data['created_at'])); ?> <br>Di Update Pada Jam: <?= date('H : i', strtotime($get_data['updated_at'])); ?></p>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="location">
                                            <h5>Lokasi/Tanggal</h5>
                                            <p>Dusun Tlotok, Tlotok, Pakalongan,
                                                <br>Sampang - <?= date('Y-m-d', strtotime($get_data['created_at'])); ?>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <?php include 'template_blog/footer_blog.php' ?>