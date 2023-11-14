<?php

include '../koneksi.php';

$id_pendaftaran = $_POST['id_pendaftaran'];
$status_pendaftaran = $_POST['status_pendaftaran'];

//Cek apakah siswa sudah dinyatakan lulus atau tidak
$cek_data = mysqli_fetch_array(mysqli_query($conn, "SELECT id_pendaftaran, status_lulus FROM pengumuman_psb WHERE id_pendaftaran = $id_pendaftaran"));

if (isset($cek_data)) {
    sleep(1);
    echo 'Data ini sudah di nyatakan ' . $cek_data['status_lulus'] . ' silahkan cek data di bagian pengumuman PSB';
} else {
    if ($status_pendaftaran == 'valid') {
        $cek_status = mysqli_fetch_array(mysqli_query($conn, "SELECT status_pendaftaran FROM psb_siswa WHERE id_pendaftaran='$id_pendaftaran'"));
        if ($cek_status['status_pendaftaran'] == 'valid') {
            // $msg = [
            //     'error' => 'Data sudah di validasi ke valid',
            // ];
            // echo json_encode($msg);
            sleep(1);
            echo 'Data sudah di validasi ke valid';
        } else {
            mysqli_query($conn, "UPDATE psb_siswa SET status_pendaftaran='valid' WHERE id_pendaftaran='$id_pendaftaran'");
            // $msg = [
            //     'sukses' => 'Data berhasil di validasi ke valid'
            // ];
            // echo json_encode($msg);
            sleep(1);
            echo 'Data berhasil di validasi ke valid';
        }
    } elseif ($status_pendaftaran == 'tidak valid') {
        $cek_status = mysqli_fetch_array(mysqli_query($conn, "SELECT status_pendaftaran FROM psb_siswa WHERE id_pendaftaran='$id_pendaftaran'"));
        $pesan = $_POST['pesan'];
        if ($cek_status['status_pendaftaran'] == 'tidak valid') {
            // $msg = [
            //     'error' => 'Data sudah di validasi ke tidak valid',
            // ];
            // echo json_encode($msg);
            sleep(1);
            echo 'Data sudah di validasi ke tidak valid';
        } else {
            mysqli_query($conn, "UPDATE psb_siswa SET status_pendaftaran='tidak valid', pesan='$pesan' WHERE id_pendaftaran='$id_pendaftaran'");
            // $msg = [
            //     'sukses' => 'Data berhasil di validasi ke tidak valid',
            // ];
            // echo json_encode($msg);
            sleep(1);
            echo 'Data berhasil di validasi ke tidak valid';
        }
    } else {
        // $msg = [
        //     'error' => 'Ajax Error',
        // ];
        // echo json_encode($msg);
        sleep(1);
        echo 'Ajax Error';
    }
}
