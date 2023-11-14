<?php
require '../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

include '../admin/koneksi.php';

function imp_dataSiswa($data)
{
    global $conn;
    $get_tahunAkd = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM tahun_akademik WHERE status='aktif'"));
    $id_thnAkd = $get_tahunAkd['id_tahunAkd'];

    $jurusan = $data['jurusan'];
    $file = $_FILES['file']['tmp_name'];
    $path = $_FILES['file']['name'];
    if ($file) {
        $ext = pathinfo($path, PATHINFO_EXTENSION);
        if ($ext == 'xls') {
            $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
        } else {
            $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
        }
        $reader->setReadDataOnly(true);
        // lokasi file excel
        $spreadsheet = $reader->load($file);
        $worksheet = $spreadsheet->getActiveSheet();
        $rows = $worksheet->toArray();

        // var_dump($rows);
        $no_gagal = 0;
        $no_berhasil = 0;
        $kelas_gagal = 0;
        $isi_dbSiswa = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM data_siswa"));
        foreach ($rows as $key => $value) {
            if ($key == 0) {
                continue;
            } elseif ($value[2] == "") {
                continue;
            }

            $nisn = $value[1];
            $nama_siswa = $value[2];
            $tempat_lahir = $value[3];
            $tgl_lahir = $value[4];
            $nama_ortu = $value[5];
            $alamat_rumah = $value[6];
            $no_hp = $value[7];
            $pekerjaan_ortu = $value[8];
            $asal_sekolah = $value[9];
            $kelas = $value[10];
            $scan_ijazah = 'default.jpg';
            $scan_kk = 'default.jpg';
            $scan_ktpOrtu = 'default.jpg';
            $scan_nisn = 'default.jpg';
            $status_pendaftaran = 'valid';
            $date_now = date('Y-m-d H:i:s');

            $cek_data = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM data_siswa WHERE nisn='$nisn'"));
            $get_kelas = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM kelas WHERE nama_kelas='$kelas'"));
            $id_kelas = $get_kelas['id_kelas'];

            if ($cek_data) {
                $no_gagal++;
            } else {
                if ($get_kelas) {
                    //INSERT KE DATA SISWA
                    $insert_siswa = mysqli_query($conn, "INSERT INTO data_siswa (nisn,nama_siswa,tempat_lahir,tgl_lahir,alamat,status,created_at,updated_at) VALUES ('$nisn', '$nama_siswa', '$tempat_lahir', '$tgl_lahir', '$alamat_rumah', 'aktif', '$date_now', '$date_now')");
                    $id_siswa = mysqli_insert_id($conn);
                    var_dump($id_siswa);
                    if (!$insert_siswa) {
                        echo ("Pesan" . mysqli_error($conn));
                    }
                    //INSERT KE DATA AKADEMIK
                    $bulan_sekarang = date('Y-m');
                    $insert_akademik = mysqli_query($conn, "INSERT INTO data_akademik (id_thnAkd,id_siswa,id_kelas,id_Pstudi,bulan_tahun) VALUES ('$id_thnAkd', '$id_siswa', '$id_kelas', '$jurusan', '$bulan_sekarang')");
                    if (!$insert_akademik) {
                        echo ("Pesan" . mysqli_error($conn));
                    }
                    //INSERT KE PSB SISWA
                    $no_pendaftaran = date('Y') . rand(10000, 99999) . $isi_dbSiswa++;
                    mysqli_query($conn, "INSERT INTO psb_siswa (id_thnAkd,no_pendaftaran,nisn,nama_siswa,tempat_lahir,tgl_lahir,nama_ortu,alamat_rumah,no_hp,pekerjaan_ortu,asal_sekolah,jurusan,scan_ijazah,scan_kk,scan_ktpOrtu,scan_nisn,status_pendaftaran,created_at,updated_at) VALUES ('$id_thnAkd','$no_pendaftaran','$nisn', '$nama_siswa', '$tempat_lahir', '$tgl_lahir', '$nama_ortu', '$alamat_rumah', '$no_hp', '$pekerjaan_ortu', '$asal_sekolah', '$jurusan', '$scan_ijazah', '$scan_kk', '$scan_ktpOrtu', '$scan_nisn', '$status_pendaftaran','$date_now', '$date_now')");
                    $no_berhasil++;
                } else {
                    $kelas_gagal++;
                }
            }
        }
        echo "<script>
    Swal.fire({
        title: 'INFO',
        text: 'Data berita berhasil di import = " . $no_berhasil . " | Gagal = " . $no_gagal . " | Kelas tidak valid = " . $kelas_gagal . "',
        icon: 'info',
        showCancelButton: false,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'OK'
    }).then((result) => {
        if (result.isConfirmed) {
            let timerInterval
            Swal.fire({
                title: 'Kembali ke data siswa!',
                html: 'I will close in <b></b> milliseconds.',
                timer: 2000,
                timerProgressBar: true,
                didOpen: () => {
                    Swal.showLoading()
                    const b = Swal.getHtmlContainer().querySelector('b')
                    timerInterval = setInterval(() => {
                        b.textContent = Swal.getTimerLeft()
                    }, 100)
                },
                willClose: () => {
                    clearInterval(timerInterval)
                }
            }).then((result) => {
                /* Read more about handling dismissals below */
                if (result.dismiss === Swal.DismissReason.timer) {
                    window.location.href = 'data_siswa.php';
                }
            })
        }
    })
    </script>";
    } else {
        echo "<script>
        Swal.fire({
            title: 'Gagal',
            text: 'File kosong',
            icon: 'error',
            showCancelButton: false,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'OK'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = 'data_siswa.php';
            }
        })
    </script>";
    }
}

function imp_psbSiswa($data)
{
    global $conn;
    $get_tahunAkd = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM tahun_akademik WHERE status='aktif'"));
    $get_data = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM psb ORDER BY id_psb ASC LIMIT 1"));
    if ($get_data['status'] == 'aktif') {
        if ($get_data['tgl_tutup'] >= date('Y-m-d')) {
            $id_thnAkd = $get_tahunAkd['id_tahunAkd'];
            $jurusan = $data['jurusan'];
            $file = $_FILES['file']['tmp_name'];
            $path = $_FILES['file']['name'];
            if ($file) {

                $ext = pathinfo($path, PATHINFO_EXTENSION);

                if ($ext == 'xls') {
                    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
                } else {
                    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
                }
                $reader->setReadDataOnly(true);
                // lokasi file excel
                $spreadsheet = $reader->load($file);
                $worksheet = $spreadsheet->getActiveSheet();
                $rows = $worksheet->toArray();

                // var_dump($rows);
                $no_gagal = 0;
                $no_berhasil = 0;
                $isi_dbPsb = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM psb_siswa"));
                foreach ($rows as $key => $value) {
                    if ($key == 0) {
                        continue;
                    } elseif ($value[2] == "") {
                        continue;
                    }

                    $nisn = $value[1];
                    $nama_siswa = $value[2];
                    $tempat_lahir = $value[3];
                    $tgl_lahir = $value[4];
                    $nama_ortu = $value[5];
                    $alamat_rumah = $value[6];
                    $no_hp = $value[7];
                    $pekerjaan_ortu = $value[8];
                    $asal_sekolah = $value[9];
                    $scan_ijazah = 'default.jpg';
                    $scan_kk = 'default.jpg';
                    $scan_ktpOrtu = 'default.jpg';
                    $scan_nisn = 'default.jpg';
                    $status_pendaftaran = 'valid';
                    $date_now = date('Y-m-d H:i:s');

                    $cek_data = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM psb_siswa WHERE nisn='$nisn'"));

                    if ($cek_data) {
                        $no_gagal++;
                    } else {
                        //INSERT KE PSB SISWA
                        $no_pendaftaran = date('Y') . rand(10000, 99999) . $isi_dbPsb++;
                        mysqli_query($conn, "INSERT INTO psb_siswa (id_thnAkd,no_pendaftaran,nisn,nama_siswa,tempat_lahir,tgl_lahir,nama_ortu,alamat_rumah,no_hp,pekerjaan_ortu,asal_sekolah,jurusan,scan_ijazah,scan_kk,scan_ktpOrtu,scan_nisn,status_pendaftaran,created_at,updated_at) VALUES ('$id_thnAkd','$no_pendaftaran','$nisn', '$nama_siswa', '$tempat_lahir', '$tgl_lahir', '$nama_ortu', '$alamat_rumah', '$no_hp', '$pekerjaan_ortu', '$asal_sekolah', '$jurusan', '$scan_ijazah', '$scan_kk', '$scan_ktpOrtu', '$scan_nisn', '$status_pendaftaran','$date_now', '$date_now')");
                        $no_berhasil++;
                    }
                }
                echo "<script>
            Swal.fire({
                title: 'INFO',
                text: 'Data berita berhasil di import = " . $no_berhasil . " | Gagal = " . $no_gagal . "',
                icon: 'info',
                showCancelButton: false,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'OK'
            }).then((result) => {
                if (result.isConfirmed) {
                    let timerInterval
                    Swal.fire({
                        title: 'Kembali ke data siswa!',
                        html: 'Kembali <b></b> milliseconds.',
                        timer: 2000,
                        timerProgressBar: true,
                        didOpen: () => {
                            Swal.showLoading()
                            const b = Swal.getHtmlContainer().querySelector('b')
                            timerInterval = setInterval(() => {
                                b.textContent = Swal.getTimerLeft()
                            }, 100)
                        },
                        willClose: () => {
                            clearInterval(timerInterval)
                        }
                    }).then((result) => {
                        /* Read more about handling dismissals below */
                        if (result.dismiss === Swal.DismissReason.timer) {
                            window.location.href = 'siswa_psb.php';
                        }
                    })
                }
            })
            </script>";
            } else {
                echo "<script>
                Swal.fire({
                    title: 'Gagal',
                    text: 'File kosong',
                    icon: 'error',
                    showCancelButton: false,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = 'siswa_psb.php';
                    }
                })
            </script>";
            }
        } else {
            echo "<script>
            Swal.fire({
                title: 'Gagal',
                text: 'Masa Pendaftaran Sudah Melewati Tanggal Yang Ditentukan. Silahkan Atur Dibagian Setting',
                icon: 'error',
                showCancelButton: false,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'OK'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = 'siswa_psb.php';
                }
            })
        </script>";
        }
    } else {
        echo "<script>
            Swal.fire({
                title: 'Gagal',
                text: 'Pendaftaran Belum Dibuka. Silahkan Atur Dibagian Setting',
                icon: 'error',
                showCancelButton: false,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'OK'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = 'siswa_psb.php';
                }
            })
        </script>";
    }
}
