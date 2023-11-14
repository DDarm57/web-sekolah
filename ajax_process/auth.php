<?php

session_start();

include '../pembina/koneksi.php';

$username = $_POST['username'];
$password = $_POST['password'];

$cek_log = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM users WHERE username = '$username' AND password = '$password'"));
if (isset($cek_log)) {
  sleep(1);
  $_SESSION['user_log'] = true;
  $_SESSION['id_user'] = $cek_log['id_user'];
  $_SESSION['username'] = $cek_log['username'];
  $_SESSION['password'] = $cek_log['password'];
  $_SESSION['level'] = $cek_log['level'];
  $_SESSION['created-at'] = $cek_log['created_at'];

  if ($cek_log['level'] == 1) {
    $msg = [
      'login' => 'pembina/dashboard.php',
      'pesan' => '<div class="alert alert-success" role="alert">
          Login Sukses, Sebagai Pembina
        </div>'
    ];
  } elseif ($cek_log['level'] == 2) {
    $msg = [
      'login' => 'siswa/jadwal_kegiatan.php',
      'pesan' => '<div class="alert alert-success" role="alert">
          Login Sukses, Sebagai Siswa
        </div>'
    ];
  }

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
