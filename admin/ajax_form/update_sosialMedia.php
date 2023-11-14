<?php
include '../koneksi.php';

$id_sosialMedia = $_POST['id_sosialMedia'];
$tipe_sosialMedia = $_POST['tipe_sosialMedia'];
$link_sosialMedia = $_POST['link_sosialMedia'];

$update = mysqli_query($conn, "UPDATE sosial_media SET tipe_sosialMedia='$tipe_sosialMedia', link_sosialMedia='$link_sosialMedia' WHERE id_sosialMedia='$id_sosialMedia'");
sleep(1);

if ($update) {
    echo 'Data berhasil di update';
} else {
    echo 'Data gagal di update';
}
