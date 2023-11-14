<?php
session_start();

include '../admin/koneksi.php';

$username = $_POST['username'];
$password = $_POST['password'];

$cek_data = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM admin WHERE username='$username' AND password='$password'"));
sleep(1);
if (isset($cek_data)) {
  $_SESSION['log'] = true;
  $_SESSION['id_admin'] = $cek_data['id_admin'];
  $_SESSION['username'] = $cek_data['username'];
  $_SESSION['password'] = $cek_data['password'];
  $_SESSION['user_name'] = $cek_data['user_name'];
  $msg = [
    'login' => 'admin/dashboard.php',
    'pesan' => '<div class="alert alert-success" role="alert">
    Login Sukses
  </div>'
  ];
  echo json_encode($msg);
  sleep(1);
} else {
  $msg = [
    'pesan' => '<div class="alert alert-danger" role="alert">
    Username atau Password Salah
  </div>',
  ];
  echo json_encode($msg);
  sleep(1);
}
