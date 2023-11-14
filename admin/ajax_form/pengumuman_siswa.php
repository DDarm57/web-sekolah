<?php
include '../koneksi.php';
$date_now = date('Y-m-d H:i:s');

if (isset($_POST['id_pendaftaran'])) {
    $id_pendaftaran = $_POST['id_pendaftaran'];
    $jml_data = count($id_pendaftaran);

    if ($_POST['status_lulus'] == 'lulus') {
        $status_lulus = 'lulus';
    } elseif ($_POST['status_lulus'] == 'tidak lulus') {
        $status_lulus = 'tidak lulus';
    }
    $id_tahunAkd = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM tahun_akademik WHERE status='aktif'"));
    $id_akademik = $id_tahunAkd['id_tahunAkd'];
    $n = 1;
    for ($i = 0; $i < $jml_data; $i++) {
        $id_pend = $id_pendaftaran[$i];
        $cek_kelulusan = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM pengumuman_psb WHERE id_pendaftaran='$id_pend'"));
        $pesan_noPend = mysqli_fetch_array(mysqli_query($conn, "SELECT no_pendaftaran FROM psb_siswa WHERE id_pendaftaran='$id_pend'"));
        if (isset($cek_kelulusan) != null) {

            echo    '
            <div class="alert alert-danger alert-dismissible fade show gagal" role="alert">
            <strong>Holy guacamole!</strong> <p class="isi-pesanError" >Data sudah di update NO PENDAFTARAN :' . $pesan_noPend['no_pendaftaran'] . '</p>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>';
            sleep(1);

            $gagal = $n++;
        } elseif (isset($cek_kelulusan) == null) {
            $get_psbSiswa = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM psb_siswa WHERE id_pendaftaran='$id_pendaftaran[$i]'"));
            var_dump($get_psbSiswa);
            // $nisn = $get_psbSiswa['nisn'];
            // $nama_siswa = $get_psbSiswa['nama_siswa'];
            // $tempat_lahir = $get_psbSiswa['tempat_lahir'];
            // $tgl_lahir = $get_psbSiswa['tgl_lahir'];
            // $alamat = $get_psbSiswa['alamat_rumah'];
            // $status = 'no_kelas';
            // mysqli_query($conn, "INSERT INTO data_siswa (nisn,nama_siswa,tempat_lahir,tgl_lahir,alamat,status,created_at,updated_at) VALUES ('$nisn','$nama_siswa','$tempat_lahir','$tgl_lahir','$status','$date_now','$date_now')");
            // mysqli_query($conn, "INSERT INTO pengumuman_psb (id_pendaftaran,id_tahunAkd,status_lulus) VALUES ('$id_pendaftaran[$i]', '$id_akademik', '$status_lulus')");
            // echo '
            //     <div class="alert alert-success alert-dismissible fade show sukses" role="alert">
            //     <strong>Holy guacamole!</strong> <p class="isi-pesanError" >Data berhasil di update NO PENDAFTARAN :' . $pesan_noPend['no_pendaftaran'] . '</p>
            //     <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            //         <span aria-hidden="true">&times;</span>
            //     </button>
            //     </div>';
            // sleep(1);
            $berhasil = $n++;
        }

        if (isset($gagal)) {
            $jml_gagal = $gagal;
        } else {
            $jml_gagal = 0;
        }

        if (isset($berhasil)) {
            $jml_berhasil = $berhasil;
        } else {
            $jml_berhasil = 0;
        }
    }
    $pesan = 'jumlah data berhasil di update ' . $jml_berhasil . ' data | jumlah data gagal di update ' . $jml_gagal . ' data';
    if (mysqli_affected_rows($conn) > 0) {
        sleep(1);
        echo "<script>
        Swal.fire({
            title: 'Sukses',
            text: '$pesan',
            icon: 'success',
            showCancelButton: false,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'OK'
        })</script>";
    } else {
        sleep(1);
        echo "<script>Swal.fire({
            title: 'Gagal',
            text: 'Data gagal di update',
            icon: 'error',
            showCancelButton: false,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'OK'
        })</script>";
    }
} else {
    sleep(1);
    echo "<script>Swal.fire({
        title: 'Gagal',
        text: 'Tidak ada data dipilih',
        icon: 'error',
        showCancelButton: false,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'OK'
    })</script>";
}
