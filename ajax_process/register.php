<?php

date_default_timezone_set("Asia/Jakarta");

include '../pembina/koneksi.php';

$nisn = $_POST['nisn'];
$id_kegiatan = $_POST['id_kegiatan'];
$password = $_POST['password'];
$date_now = date('Y-m-d H:i:s');

$cek_dataSiswa = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM data_siswa WHERE nisn='$nisn'"));
$get_thnAkd = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM tahun_akademik WHERE status='aktif'"));
$id_thnAkd = $get_thnAkd['id_tahunAkd'];
if (isset($cek_dataSiswa)) {
    $id_siswa = $cek_dataSiswa["id_siswa"];
    $cek_esktra = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM ekstrakurikuler WHERE id_siswa='$id_siswa'"));
    if ($cek_esktra) {
        $msg = [
            'pesan' => '<div class="alert alert-danger" role="alert">
                         Data Ditemukan :
                         <hr>
                            <table>
                                <tr>
                                    <td>Nama</td>
                                    <td>:</td>
                                    <td>' . $cek_dataSiswa['nama_siswa'] . '</td>
                                </tr>
                                <tr>
                                    <td>Tgl Lahir</td>
                                    <td>:</td>
                                    <td>' . $cek_dataSiswa['tgl_lahir'] . '</td>
                                </tr>
                                <tr>
                                    <td>Alamat</td>
                                    <td>:</td>
                                    <td>' . $cek_dataSiswa['alamat'] . '</td>
                                </tr>
                            </table>
                            <hr>
                            Data sudah terdaftar di ekstrakurikuler silahkan login.
                        '
        ];
    } else {
        $cek_pembina = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM data_pembina WHERE mengajar_kegiatan='$id_kegiatan'"));
        if ($cek_pembina) {
            if ($password == null) {
                $msg = [
                    'inp_pw' => true,
                    'pesan' => '<div class="alert alert-info" role="alert">
                         Data Ditemukan :
                         <hr>
                            <table>
                                <tr>
                                    <td>Nama</td>
                                    <td>:</td>
                                    <td>' . $cek_dataSiswa['nama_siswa'] . '</td>
                                </tr>
                                <tr>
                                    <td>Tgl Lahir</td>
                                    <td>:</td>
                                    <td>' . $cek_dataSiswa['tgl_lahir'] . '</td>
                                </tr>
                                <tr>
                                    <td>Alamat</td>
                                    <td>:</td>
                                    <td>' . $cek_dataSiswa['alamat'] . '</td>
                                </tr>
                            </table>
                            <hr>
                            Jika Yakin Ingin Mendaftar, Silahkan Buat Password Dibawah Dan Klik Daftar Sekarang.
                        '
                ];
            } else {
                mysqli_query($conn, "INSERT INTO users (username,password,level,created_at,updated_at) VALUES ('$nisn','$password','2','$date_now','$date_now')");
                $siswa_userid = mysqli_insert_id($conn);
                $id_siswa = $cek_dataSiswa['id_siswa'];
                $id_pembina = $cek_pembina['id_pembina'];
                mysqli_query($conn, "INSERT INTO ekstrakurikuler (id_kegiatan,id_siswa,id_pembina,siswa_userid,status_validasi,id_thnAkd) VALUES ('$id_kegiatan','$id_siswa','$id_pembina','$siswa_userid', 'validasi nilai','$id_thnAkd')");
                $msg = [
                    'url' => 'login_ekstra.php',
                    'pesan' => '<div class="alert alert-success" role="alert">
                           Berhasil Mendaftar, Silahkan Login Kembali.
                        </div>'
                ];
            }
        } else {
            $msg = [
                'pesan' => '<div class="alert alert-danger" role="alert">
                        Kegiatan Ekstrakurikuler Yang Anda Pilih Belum Ada Pembina Kegiatan, Silahkan Tunggu Info Berikutnya.
                    </div>'
            ];
        }
    }
} else {
    $msg = [
        'pesan' => '<div class="alert alert-danger" role="alert">
            Data tidak di temukan
        </div>'
    ];
}

echo json_encode($msg);
sleep(1);
