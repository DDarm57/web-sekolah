<?php

include '../koneksi.php';

$query = mysqli_query($conn, "SELECT no_pendaftaran,nisn,nama_siswa,status_lulus FROM pengumuman_psb INNER JOIN psb_siswa ON pengumuman_psb.id_pendaftaran = psb_siswa.id_pendaftaran");

while ($row = mysqli_fetch_assoc($query)) {
    $data[] = $row;
}

echo json_encode($data);
