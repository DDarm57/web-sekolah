<?php
include '../koneksi.php';

if (isset($_GET['keywoard'])) {
    sleep(1);
    $keywoard = $_GET['keywoard'];
    $query = mysqli_query($conn, "SELECT * FROM pengumuman_psb INNER JOIN psb_siswa ON pengumuman_psb.id_pendaftaran = psb_siswa.id_pendaftaran WHERE no_pendaftaran LIKE '%$keywoard%' OR nisn LIKE '%$keywoard%' OR nama_siswa LIKE '%$keywoard%'");
} else {
    $query = mysqli_query($conn, "SELECT * FROM pengumuman_psb INNER JOIN psb_siswa ON pengumuman_psb.id_pendaftaran = psb_siswa.id_pendaftaran");
}
?>

<?php $n = 1;
while ($row = mysqli_fetch_array($query)) : ?>
    <tr>
        <td><?= $n++; ?></td>
        <td><?= $row['no_pendaftaran']; ?></td>
        <td><?= $row['nisn']; ?></td>
        <td><?= $row['nama_siswa']; ?></td>
        <td>
            <p class="<?= ($row['status_lulus'] == 'lulus' ? 'text-light bg-success rounded text-center' : 'text-light bg-danger rounded text-center'); ?>">
                <strong><?= $row['status_lulus']; ?></strong>
            </p>
        </td>
    </tr>
<?php endwhile; ?>