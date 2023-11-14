<?php
include '../admin/koneksi.php';

$cek = $_POST['cek'];

$query = mysqli_query($conn, "SELECT * FROM psb_siswa WHERE no_pendaftaran LIKE '%$cek' OR nisn LIKE '$cek%'");
$get_data = mysqli_fetch_array($query);
sleep(1);
?>

<?php if (isset($get_data)) { ?>
    <?php
    $jurusan = $get_data['jurusan'];
    $get_jurusan = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM program_studi WHERE id_Pstudi='$jurusan'")); ?>

    <?php if ($get_data['status_pendaftaran'] == 'tidak valid') { ?>
        <div class="d-flex justify-content-center">
            <img src="gambar/tidak_valid.jpg" alt="" style="width: 200px;">
        </div>
        <div class="d-flex justify-content-center">
            <h4 class="text-danger" style="text-transform:uppercase"><strong>Data <?= $get_data['status_pendaftaran']; ?></strong></h4>
        </div>
        <div class="mt-2">
            <?= $get_data['pesan']; ?>
        </div>
    <?php } else { ?>
        <div class="d-flex justify-content-center">
            <?php if ($get_data['status_pendaftaran'] == 'valid') : ?>
                <img src="gambar/valid.jpg" alt="" style="width: 200px;">
            <?php endif; ?>
            <?php if ($get_data['status_pendaftaran'] == 'sedang divalidasi') : ?>
                <img src="gambar/divalidasi.jpg" alt="" style="width: 200px;">
            <?php endif; ?>
        </div>
        <div class="d-flex justify-content-center">
            <h4 style="text-transform:uppercase" class="text-<?= ($get_data['status_pendaftaran'] == 'valid' ? 'success' : 'warning'); ?>"><strong>Data <?= $get_data['status_pendaftaran']; ?></strong></h4>
        </div>
        <div class="mt-2">
            <h5><a href="detail_pendaftaran.php" class="btn btn-primary">Kembali Ke Detail Pendaftaran</a></h5>
        </div>
    <?php } ?>
<?php } else { ?>
    <div class="d-flex justify-content-center">
        <img src="gambar/kosong.jpg" alt="" style="width: 200px;">
    </div>
    <div class="d-flex justify-content-center">
        <h5>Data Tidak Ditemukan</h5>
    </div>
    <button class="btn btn-primary mt-2" onClick="window.location.reload();">Reload</button>
<?php }; ?>