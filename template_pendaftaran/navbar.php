<!-- Image and text -->
<?php
include 'admin/koneksi.php';
$query_edit = mysqli_query($conn, "SELECT * FROM profil_sekolah ORDER BY id_profilSekolah ASC LIMIT 1");
$get_data = mysqli_fetch_array($query_edit);
?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand" href="#">
            <img src="admin/gambar/<?= $get_data['logo_sekolah']; ?>" width="30" height="30" class="d-inline-block align-top" alt="">
            <?= $get_data['nama_sekolah']; ?>
        </a>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
                <a class="nav-item nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
                <a class="nav-item nav-link" href="detail_pendaftaran.php">Detail Pendaftaran</a>
                <a class="nav-item nav-link" href="#"></a>
            </div>
        </div>
    </div>
</nav>