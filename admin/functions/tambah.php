<?php
include '../admin/koneksi.php';

function tambah_psb($data)
{
    global $conn;
    $no_pendaftaran = $data['no_pendaftaran'];
    $nisn = $data['nisn'];
    $nama_siswa = $data['nama_siswa'];
    $tempat_lahir = $data['tempat_lahir'];
    $tgl_lahir = $data['tgl_lahir'];
    $nama_ortu = $data['nama_ortu'];
    $alamat_rumah = $data['alamat_rumah'];
    $no_hp = $data['no_hp'];
    $pekerjaan_ortu = $data['pekerjaan_ortu'];
    $asal_sekolah = $data['asal_sekolah'];
    $jurusan = $data['jurusan'];
    $scan_ijazah = "default.jpg";
    $scan_kk = "default.jpg";
    $scan_ktpOrtu = "default.jpg";
    $scan_nisn = "default.jpg";
    $status_pendaftaran = 'valid';
    $date_now = date('Y-m-d H:i:s');

    $old = [
        "nisn" => $nisn,
        "nama_siswa" => $nama_siswa,
        "tempat_lahir" => $tempat_lahir,
        "tgl_lahir" => $tgl_lahir,
        "nama_ortu" => $nama_ortu,
        "alamat_rumah" => $alamat_rumah,
        "no_hp" => $no_hp,
        "pekerjaan_ortu" => $pekerjaan_ortu,
        "asal_sekolah" => $asal_sekolah,
        "jurusan" => $jurusan,

    ];

    $cek_data = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM psb_siswa WHERE nisn='$nisn'"));
    $id_thnAkd = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM tahun_akademik WHERE status='aktif'"));
    if (isset($cek_data)) {
        $msg = [
            'error' => "Data dengan NISN : " . $nisn . " sudah terdaftar",
            'old' => $old,
        ];
        $get =  json_encode($msg);
        $get_json = json_decode($get);
        return $get_json;
    } else {
        $get_idthnAkd = $id_thnAkd['id_tahunAkd'];
        mysqli_query($conn, "INSERT INTO psb_siswa (id_thnAkd,no_pendaftaran,nisn,nama_siswa,tempat_lahir,tgl_lahir,nama_ortu,alamat_rumah,no_hp,pekerjaan_ortu,asal_sekolah,jurusan,scan_ijazah,scan_kk,scan_ktpOrtu,scan_nisn,status_pendaftaran,created_at,updated_at) VALUES ('$get_idthnAkd','$no_pendaftaran','$nisn', '$nama_siswa', '$tempat_lahir', '$tgl_lahir', '$nama_ortu', '$alamat_rumah', '$no_hp', '$pekerjaan_ortu', '$asal_sekolah', '$jurusan', '$scan_ijazah', '$scan_kk', '$scan_ktpOrtu', '$scan_nisn', '$status_pendaftaran','$date_now', '$date_now')");

        if (mysqli_affected_rows($conn) > 0) {
            echo '<div class="alert alert-success" role="alert">
            Data berhasil di tambahkan
          </div>';
        } else {
            echo '<div class="alert alert-danger" role="alert">
            Data gagal di simpan. Silahkan cek kembali data
          </div>';
        }
    }
}

function tambah_berita($data)
{
    global $conn;

    $judul_berita = $data['judul_berita'];
    $deskripsi_berita = $data['deskripsi_berita'];
    $id_kategoriBerita = $data['id_kategoriBerita'];
    $tgl_publish = $data['tgl_publish'];
    $date_now = date('Y-m-d H:i:s');
    $nama_gambar = rand(1009, 9999) . '_' . $_FILES['file']['name'];

    mysqli_query($conn, "INSERT INTO data_berita (id_kategoriBerita ,judul_berita, deskripsi_berita, gambar_berita, tgl_publish, created_at, updated_at) VALUES ('$id_kategoriBerita','$judul_berita', '$deskripsi_berita','$nama_gambar', '$tgl_publish', '$date_now', '$date_now')");
    $temp_name = $_FILES['file']['tmp_name'];
    $lokasi_file = './gambar/gambar_berita/';

    move_uploaded_file($temp_name, $lokasi_file . $nama_gambar);
    return mysqli_affected_rows($conn);
}

function tambah_Kberita($data)
{
    global $conn;

    $nama_kategori = $data['nama_kategori'];
    $deskripsi = $data['deskripsi'];
    $date_now = date('Y-m-d H:i:s');

    $cek_data = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM kategori_berita WHERE nama_kategori='$nama_kategori'"));


    if (isset($cek_data)) {
        echo " <script>
        Swal.fire({
            title: 'Gagal',
            text: 'Data sudah ada di database',
            icon: 'error',
            showCancelButton: false,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'OK'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = 'kategori_berita.php';
            }
        })
    </script>";
    } else {

        mysqli_query($conn, "INSERT INTO kategori_berita (nama_kategori, deskripsi, created_at, updated_at) VALUES ('$nama_kategori', '$deskripsi', '$date_now', '$date_now')");
        // return mysqli_affected_rows($conn);
        if (mysqli_affected_rows($conn) > 0) {
            echo "<script>
            Swal.fire({
                title: 'Sukses',
                text: 'Data berhasil di tambahkan',
                icon: 'success',
                showCancelButton: false,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'OK'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = 'kategori_berita.php';
                }
            })
        </script>";
        } else {
            echo " <script>
        Swal.fire({
            title: 'Gagal',
            text: 'Data gagal di tambahkan',
            icon: 'error',
            showCancelButton: false,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'OK'
        })
    </script>";
        }
    }
}
function tambah_studi()
{
    global $conn;

    $nama_studi = $_POST['nama_studi'];
    $deskripsi_studi = $_POST['deskripsi_studi'];
    $date_now = date('Y-m-d H:i:s');
    $cek_data = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM program_studi WHERE nama_studi='$nama_studi'"));

    if (isset($cek_data)) {
        echo "<script>
        Swal.fire({
            title: 'Gagal',
            text: 'Data sudah ada di database',
            icon: 'error',
            showCancelButton: false,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'OK'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = 'data_studi.php';
            }
        })
    </script>";
    } else {
        if ($_FILES['file']['name'] != null) {
            $gambar_studi = rand(1000, 9999) . '_' . $_FILES['file']['name'];
            $tmpName_studi = $_FILES['file']['tmp_name'];
            move_uploaded_file($tmpName_studi, './gambar/' . $gambar_studi);
        } else {
            $gambar_studi = 'default.jpg';
        }
        mysqli_query($conn, "INSERT INTO program_studi (nama_studi, deskripsi_studi, gambar_studi, created_at, updated_at) VALUES ('$nama_studi', '$deskripsi_studi', '$gambar_studi', '$date_now', '$date_now')");
        if (mysqli_affected_rows($conn) > 0) {
            echo "<script>
            Swal.fire({
                title: 'Sukses',
                text: 'Data berhasil di tambahkan',
                icon: 'success',
                showCancelButton: false,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'OK'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = 'data_studi.php';
                }
            })
        </script>";
        } else {
            echo " <script>
        Swal.fire({
            title: 'Gagal',
            text: 'Data gagal di tambah',
            icon: 'error',
            showCancelButton: false,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'OK'
        })
    </script>";
        }
    }
}

function tambah_galeri($data)
{
    global $conn;

    $judul_gambar = $data['judul_gambar'];
    $deskripsi_gambar = $data['deskripsi_gambar'];
    $date_now = date('Y-m-d H:i:s');

    $nama_gambar = rand(1009, 9999) . '_' . $_FILES['file']['name'];

    mysqli_query($conn, "INSERT INTO galeri (judul_gambar, deskripsi_gambar, gambar, created_at, updated_at) VALUES ('$judul_gambar', '$deskripsi_gambar', '$nama_gambar', '$date_now', '$date_now')") or die(mysqli_error($conn));

    if (mysqli_affected_rows($conn) > 0) {

        $temp_name = $_FILES['file']['tmp_name'];
        $lokasi_file = '../admin/gambar/galeri/';
        move_uploaded_file($temp_name, $lokasi_file . $nama_gambar);

        echo "<script>
            Swal.fire({
                title: 'Sukses',
                text: 'Data galeri berhasil di tambahkan',
                icon: 'success',
                showCancelButton: false,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'OK'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = 'settings.php';
                }
            })
        </script>";
    } else {
        echo " <script>
        Swal.fire({
            title: 'Gagal',
            text: 'Data galeri gagal di tambah',
            icon: 'error',
            showCancelButton: false,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'OK'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = 'settings.php';
            }
        })
    </script>";
    }
}

function tambah_tahunAkd($data)
{
    global $conn;

    $tahun1 = $data['tahun1'];
    $tahun2 = $data['tahun2'];
    $status = 'tidak aktif';

    $tahun = $tahun1 . '/' . $tahun2;

    $get_data = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM tahun_akademik WHERE tahun='$tahun'"));

    if (isset($get_data) != null) {
        echo "<script>
        Swal.fire({
            title: 'Gagal',
            text: 'Data sudah ada di database',
            icon: 'error',
            showCancelButton: false,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'OK'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = 'tahun_akademik.php';
            }
        })
    </script>";
    } else {
        mysqli_query($conn, "INSERT INTO tahun_akademik (tahun,status) VALUES ('$tahun', '$status')");

        if (mysqli_affected_rows($conn) > 0) {
            echo "<script>
            Swal.fire({
                title: 'Sukses',
                text: 'Data galeri berhasil di tambahkan',
                icon: 'success',
                showCancelButton: false,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'OK'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = 'tahun_akademik.php';
                }
            })
        </script>";
        } else {
            echo " <script>
        Swal.fire({
            title: 'Gagal',
            text: 'Data galeri gagal di tambah',
            icon: 'error',
            showCancelButton: false,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'OK'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = 'tahun_akademik.php';
            }
        })
    </script>";
        }
    }
}

function simpan_kelas($data)
{
    global $conn;

    $nama_kelas = $data['nama_kelas'];
    $jumlah_bangku = $data['jumlah_bangku'];

    $cek_kelas = mysqli_fetch_array(mysqli_query($conn, "SELECT nama_kelas FROM kelas WHERE nama_kelas='$nama_kelas'"));
    if ($cek_kelas) {
        echo " <script>
        Swal.fire({
            title: 'Gagal',
            text: 'Data kelas gagal di tambah! kelas sudah ada di data.',
            icon: 'error',
            showCancelButton: false,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'OK'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = 'data_kelas.php';
            }
        })
    </script>";
    } else {
        mysqli_query($conn, "INSERT INTO kelas (nama_kelas,jumlah_bangku,status) VALUES ('$nama_kelas','$jumlah_bangku', 'aktif')");
        echo "<script>
        Swal.fire({
            title: 'Sukses',
            text: 'Data kelas berhasil di tambahkan',
            icon: 'success',
            showCancelButton: false,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'OK'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = 'data_kelas.php';
            }
        })
    </script>";
    }
}

// EKSTRAKURIKULER

function simpan_kegiatan($data)
{
    global $conn;

    $nama_kegiatan = $data['nama_kegiatan'];
    $deskrips_kegiatan = $data['deskripsi_kegiatan'];
    if ($deskrips_kegiatan == "") {
        $deskrips_kegiatan == "NULL";
    } else {
        $deskrips_kegiatan = $data['deskripsi_kegiatan'];
    }

    if ($nama_kegiatan != null) {
        mysqli_query($conn, "INSERT INTO data_kegiatan (nama_kegiatan) VALUES ('$nama_kegiatan')");
        if (mysqli_affected_rows($conn) > 0) {
            echo "<script>
            Swal.fire({
                title: 'Sukses',
                text: 'Data kegiatan berhasil di tambahkan',
                icon: 'success',
                showCancelButton: false,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'OK'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = 'data_kegiatan.php';
                }
            })
        </script>";
        } else {
            echo "<script>
            Swal.fire({
                title: 'Gagal',
                text: 'Data gagal ditambah',
                icon: 'error',
                showCancelButton: false,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'OK'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = 'data_kegiatan.php';
                }
            })
        </script>";
        }
    } else {
        if ($nama_kegiatan == "") {
            echo "<script>
            Swal.fire({
                title: 'Gagal',
                text: 'Nama kegiatan tidak boleh kosong.',
                icon: 'error',
                showCancelButton: false,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'OK'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = 'data_kegiatan.php';
                }
            })
        </script>";
        }
    }
}

function save_pembina($data)
{
    global $conn;

    $nama_pembina = $data['nama_pembina'];
    $nip_pembina = $data['nip_pembina'];
    $alamat_pembina = $data['alamat_pembina'];
    $no_hp = $data['no_hp'];
    $id_kegiatan = $data['mengajar_kegiatan'];
    if (isset($data['file'])) {
        $nama_gambar = rand(1009, 9999) . '_' . $data['file']['name'];
    } else {
        $nama_gambar = "default.jpg";
    }
    $username = $data['username'];
    $password = $data['password'];
    $date_now = date('Y-m-d H:i:s');

    $cek_pembina = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM data_pembina WHERE nip='$nip_pembina'"));

    if (isset($cek_pembina)) {
        echo "<script>
        Swal.fire({
            title: 'Gagal',
            text: 'Data pembina dengan nip " . $nip_pembina . " sudah ada di data pembina',
            icon: 'error',
            showCancelButton: false,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'OK'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = 'data_pembina.php';
            }
        })
    </script>";
    } else {
        mysqli_query($conn, "INSERT INTO users (username,password,level,created_at,updated_at) VALUES ('$username','$password','1','$date_now', '$date_now')");

        $pembina_userid = mysqli_insert_id($conn);

        mysqli_query($conn, "INSERT INTO data_pembina (pembina_userid,nip,nama_pembina,alamat_pembina,no_hp,mengajar_kegiatan,gambar_pembina,status,created_at,updated_at) VALUES ('$pembina_userid', '$nip_pembina', '$nama_pembina', '$alamat_pembina', '$no_hp', '$id_kegiatan', '$nama_gambar', 'aktif', '$date_now', '$date_now')");

        if (mysqli_affected_rows($conn) > 0) {
            if (isset($data['file'])) {
                $temp_name = $_FILES['file']['tmp_name'];
                $lokasi_file = '../admin/gambar/pembina/';
                move_uploaded_file($temp_name, $lokasi_file . $nama_gambar);
            }

            echo "<script>
            Swal.fire({
                title: 'Sukses',
                text: 'Data pembina berhasil di tambahkan',
                icon: 'success',
                showCancelButton: false,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'OK'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = 'data_pembina.php';
                }
            })
        </script>";
        } else {
            echo "<script>
            Swal.fire({
                title: 'Gagal',
                text: 'Data gagal ditambah',
                icon: 'error',
                showCancelButton: false,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'OK'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = 'data_pembina.php';
                }
            })
        </script>";
        }
    }
}
