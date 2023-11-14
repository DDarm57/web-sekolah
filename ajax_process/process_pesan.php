<?php
include '../admin/koneksi.php';

$name = $_POST['name'];
$email = $_POST['email'];
$subject = $_POST['subject'];
$message = $_POST['message'];
$date_now = date('Y-m-d H:i:s');

mysqli_query($conn, "INSERT INTO pesan_user (name,email,subject,message,created_at) VALUES ('$name', '$email', '$subject', '$message','$date_now')");
sleep(1);
if (mysqli_affected_rows($conn)) {
    echo 'Pesan berhasil di kirim';
} else {
    echo 'Pesan gagal di kirim cek kembali';
}
