<?php

include '../admin/koneksi.php';

date_default_timezone_set("Asia/Jakarta");

$get_thnAkd = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM tahun_akademik WHERE status='aktif'"));
$id_thnAkd = $get_thnAkd['id_tahunAkd'];

function update_siswa($data)
{
    global $conn;

    $id_siswa = $data['id_siswa'];
    $nisn = $data['nisn'];
    $nama_siswa = $data['nama_siswa'];
    $tempat_lahir = $data['tempat_lahir'];
    $tgl_lahir  = $data['tgl_lahir'];
    $alamat = $data['alamat'];
    $date_now = date("Y-m-d H:i:s");

    mysqli_query($conn, "UPDATE data_siswa SET nama_siswa='$nama_siswa', tempat_lahir='$tempat_lahir', tgl_lahir='$tgl_lahir', alamat='$alamat', updated_at='$date_now' WHERE id_siswa='$id_siswa'");

    if (mysqli_affected_rows($conn) > 0) {
        echo "<script>
        Swal.fire({
            title: 'Sukses',
            text: 'Data berhasil di update',
            icon: 'success',
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
    } else {
        echo " <script>
        Swal.fire({
            title: 'Gagal',
            text: 'Data gagal di update',
            icon: 'error',
            showCancelButton: false,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'OK'
        })
    </script>";
    }
}

function naik_kelas($data)
{
    global $conn, $id_thnAkd;

    $tahun_sekarang = date("Y");
    $bulanSekarang = date("Y-m");
    $id_siswa = $data['id_siswa'];
    $jml_siswa = count($id_siswa);
    $no_gagal = 0;
    $no_berhasil = 0;

    if ($tahun_sekarang == date("Y")) {
        echo "
        <script>
        alert ('Data gagal di update karena data ini sudah ada du tahun akademik " . $tahun_sekarang . "');
        window.location.href = 'kenaikan_kelas.php'
        </script>
        ";
    } else {
        for ($i = 0; $i < $jml_siswa; $i++) {
            $get_idSiswa = $id_siswa[$i];
            $get_dataAkd = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM data_akademik WHERE id_siswa='$get_idSiswa' AND bulan_tahun LIKE '$tahun_sekarang%'"));
            //JIKA DI DATA AKADEMIK SAMA DENGAN BULAN SEKARANG MAKA KENAIKAN KELAS GAGAL DI UPDATE
            if (isset($get_dataAkd)) {
                //KELAS GAGAL DI UPDATE
                $no_gagal++;
            } else {
                $get_dataAkd = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM data_akademik WHERE id_siswa='$get_idSiswa'"));
                $id_Pstudi = $get_dataAkd['id_Pstudi'];
                //id_kelas yang ada di data akademik sebelumnya
                $id_kelasAkd = $get_dataAkd['id_kelas'];
                //ambil id berdasarkan kelas siswa sekarang
                $get_kelas = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM kelas WHERE id_kelas='$id_kelasAkd'"));
                //parsing kelas
                if ($get_kelas['nama_kelas'] == 'X') {
                    //jika kelas X naik ke kelas XI
                    $get_idKelas = mysqli_fetch_array(mysqli_query($conn, "SELECT id_kelas,nama_kelas FROM kelas WHERE nama_kelas='XI'"));
                    $id_kelas = $get_idKelas['id_kelas'];
                    $nama_kelas = $get_idKelas['nama_kelas'];
                } elseif ($get_kelas['nama_kelas'] == "XI") {
                    //jika kelas XI naik ke kelas XII
                    $get_idKelas = mysqli_fetch_array(mysqli_query($conn, "SELECT id_kelas,nama_kelas FROM kelas WHERE nama_kelas='XII'"));
                    $id_kelas = $get_idKelas['id_kelas'];
                    $nama_kelas = $get_idKelas['nama_kelas'];
                } elseif ($get_kelas['nama_kelas'] == "XII") {
                    //jika kelas XII maka update status lulus di data siswa
                    $status = "lulus";
                }

                if (isset($status)) {
                    //update data siswa lulus
                    mysqli_query($conn, "UPDATE data_siswa SET status='$status' WHERE id_siswa='$get_idSiswa'");
                } else {
                    mysqli_query($conn, "INSERT INTO data_akademik (id_thnAkd,id_siswa,id_kelas,id_Pstudi,bulan_tahun) VALUES ('$id_thnAkd', '$get_idSiswa', '$id_kelas', '$id_Pstudi', '$bulanSekarang')");
                    $no_berhasil++;
                }
                $no_gagal++;
            }
        }
        echo "
        <script>
        alert ('Data berhasil di update sebanyak " . $no_berhasil . " gaga " . $no_gagal . "');
        window.location.href = 'naik_kelas.php'
        </script>
        ";
    }



    //get data akademik berdasarkan tahun sekarang


}

function edit_profilSekolah($data)
{
    global $conn;

    $id_profileSekolah = $data['id_profilSekolah'];
    $nama_sekolah = $data['nama_sekolah'];
    $alamat_sekolah = $data['alamat_sekolah'];
    $telp_sekolah = $data['telp_sekolah'];
    $visi_misi = $data['visi_misi'];
    $email_sekolah = $data['email_sekolah'];
    $gmbLama_logo = $data['gmbLama_logo'];

    $query_update = mysqli_query($conn, "UPDATE profil_sekolah SET nama_sekolah='$nama_sekolah', alamat_sekolah='$alamat_sekolah', telp_sekolah='$telp_sekolah', visi_misi='$visi_misi', email_sekolah='$email_sekolah' WHERE id_profilSekolah='$id_profileSekolah'");

    // update gambar logo
    if ($_FILES['file']['error'] === 4) {
        $gambar_logo = $gmbLama_logo;
    } else {
        $gambar_logo = rand(1000, 9999) . '_' . $_FILES['file']['name'];
        $tmpName_logo = $_FILES['file']['tmp_name'];
        move_uploaded_file($tmpName_logo, './gambar/' . $gambar_logo);
        if ($gmbLama_logo != 'default.jpg') {
            unlink('../admin/gambar/' . $gmbLama_logo);
        }
        $update_gambarLogo = mysqli_query($conn, "UPDATE profil_sekolah SET logo_sekolah='$gambar_logo' WHERE id_profilSekolah='$id_profileSekolah'");
    }
    return mysqli_affected_rows($conn);
}

function update_berita($data)
{
    global $conn;

    $id_berita = $data['id_berita'];
    $judul_berita = $data['judul_berita'];
    $deskripsi_berita = $data['deskripsi_berita'];
    $id_kategoriBerita = $data['id_kategoriBerita'];
    $tgl_publish = $data['tgl_publish'];
    $date_now = date('Y-m-d H:i:s');
    $g_lamaBerita = $data['g_lamaBerita'];

    if ($_FILES['file']['error'] === 4) {
        $nama_gambar = $g_lamaBerita;
    } else {
        $nama_gambar = rand(1009, 9999) . '_' . $_FILES['file']['name'];
        $temp_name = $_FILES['file']['tmp_name'];
        $lokasi_file = './gambar/gambar_berita/';
        move_uploaded_file($temp_name, $lokasi_file . $nama_gambar);
        if ($g_lamaBerita != 'default.jpg') {
            unlink('./gambar/gambar_berita/' . $g_lamaBerita);
        }
        mysqli_query($conn, "UPDATE data_berita SET gambar_berita='$nama_gambar' WHERE id_berita='$id_berita'");
    }

    mysqli_query($conn, "UPDATE data_berita SET judul_berita='$judul_berita', deskripsi_berita='$deskripsi_berita', id_kategoriBerita='$id_kategoriBerita', tgl_publish='$tgl_publish' , created_at='$date_now' WHERE id_berita='$id_berita'");

    return mysqli_affected_rows($conn);
}

function update_Kberita($data)
{
    global $conn;

    $id_kategoriBerita = $data['id_kategoriBerita'];
    $nama_kategori = $data['nama_kategori'];
    $dekripsi = $data['deskripsi'];
    $date_now = date('Y-m-d H:i:s');

    $cek_data = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM kategori_berita WHERE id_kategoriBerita='$id_kategoriBerita'"));

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
        mysqli_query($conn, "UPDATE kategori_berita SET nama_kategori='$nama_kategori', deskripsi='$dekripsi', updated_at='$date_now' WHERE id_kategoriBerita='$id_kategoriBerita'");

        if (mysqli_affected_rows($conn) > 0) {
            echo "<script>
            Swal.fire({
                title: 'Sukses',
                text: 'Data berhasil di update',
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

function update_studi($data)
{
    global $conn;

    $id_Pstudi = $data['id_Pstudi'];
    $deskripsi_studi = $data['deskripsi_studi'];
    $gLama_studi = $data['gLama_studi'];
    $date_now = date('Y-m-d H:i:s');

    if (isset($data['nama_studi']) != null) {
        $nama_studi = $data['nama_studi'];
        $cek_data = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM program_studi WHERE nama_studi='$nama_studi'"));
    }


    if ($_FILES['file']['error'] === 4) {
        $gambar_studi = $gLama_studi;
    } else {
        $gambar_studi = rand(1000, 9999) . '_' . $_FILES['file']['name'];
        $tmpName_studi = $_FILES['file']['tmp_name'];
        move_uploaded_file($tmpName_studi, './gambar/' . $gambar_studi);
        if ($gLama_studi != 'default.jpg') {
            unlink('../admin/gambar/' . $gLama_studi);
        }
    }

    if (isset($data['nama_studi']) != null) {
        mysqli_query($conn, "UPDATE program_studi SET nama_studi='$nama_studi', deskripsi_studi='$deskripsi_studi', gambar_studi='$gambar_studi', updated_at='$date_now' WHERE id_Pstudi='$id_Pstudi'");
    } else {
        mysqli_query($conn, "UPDATE program_studi SET deskripsi_studi='$deskripsi_studi', gambar_studi='$gambar_studi', updated_at='$date_now' WHERE id_Pstudi='$id_Pstudi'");
    }

    if (mysqli_affected_rows($conn) > 0) {
        echo "<script>
            Swal.fire({
                title: 'Sukses',
                text: 'Data berhasil di update',
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
                text: 'Data gagal di update',
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
    }
}

function update_galeri($data)
{
    global $conn;

    $id_galeri = $data['id_galeri'];
    $judul_gambar = $data['judul_gambar'];
    $deskripsi_gambar = $data['deskripsi_gambar'];
    $g_lamaGaleri = $data['g_lamaGaleri'];
    $date_now = date('Y-m-d H:i:s');

    if ($_FILES['file']['error'] === 4) {
        $nama_gambar = $g_lamaGaleri;
    } else {
        $nama_gambar = rand(1000, 9999) . '_' . $_FILES['file']['name'];
        $tmpName_studi = $_FILES['file']['tmp_name'];
        move_uploaded_file($tmpName_studi, './gambar/galeri/' . $nama_gambar);
        try {
            if (!file_exists(file('../admin/gambar/galeri/' . $g_lamaGaleri))) {
                throw new Exception("Configuration file not found.");
            } else {
                if ($g_lamaGaleri != 'default.jpg') {
                    unlink('../admin/gambar/galeri/' . $g_lamaGaleri);
                }
            }
            //If the exception is thrown, this text will not be shown
        } catch (Exception $e) {
            echo 'Pesan: ' . $e->getMessage();
        }
    }

    mysqli_query($conn, "UPDATE galeri SET judul_gambar='$judul_gambar', deskripsi_gambar='$deskripsi_gambar', gambar='$nama_gambar', updated_at='$date_now' WHERE id_galeri='$id_galeri'");

    if (mysqli_affected_rows($conn) > 0) {
        echo "<script>
            Swal.fire({
                title: 'Sukses',
                text: 'Data berhasil di update',
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
                text: 'Data gagal di update',
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

function update_kepsek($data)
{
    global $conn;

    $id_profileSekolah = $data['id_profilSekolah'];
    $kepala_sekolah = $data['kepala_sekolah'];
    $g_lamaKepsek = $data['g_lamaKepsek'];

    if ($_FILES['file']['error'] === 4) {
        $nama_gambar = $g_lamaKepsek;
    } else {
        $nama_gambar = rand(1000, 9999) . '_' . $_FILES['file']['name'];
        $tmpName_studi = $_FILES['file']['tmp_name'];
        move_uploaded_file($tmpName_studi, './gambar/' . $nama_gambar);
        if ($g_lamaKepsek != 'default.jpg') {
            unlink('../admin/gambar/' . $g_lamaKepsek);
        }
    }

    mysqli_query($conn, "UPDATE profil_sekolah SET kepala_sekolah='$kepala_sekolah', gmb_kepSek='$nama_gambar' WHERE id_profilSekolah='$id_profileSekolah'");

    if (mysqli_affected_rows($conn) > 0) {
        echo "<script>
            Swal.fire({
                title: 'Sukses',
                text: 'Data berhasil di update',
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
                text: 'Data gagal di update',
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

function update_psb($data)
{
    global $conn;

    $id_psb = $data['id_psb'];
    $dekripsi = $data['deskripsi'];
    $persyaratan = $data['persyaratan'];
    $tgl_buka = $data['tgl_buka'];
    $tgl_tutup = $data['tgl_tutup'];
    $tgl_pengumuman = $data['tgl_pengumuman'];

    if ($tgl_buka >= $tgl_tutup) {
        echo "<script>
            Swal.fire({
                title: 'Gagal',
                text: 'Tgl buka tidak boleh lebih besar dari tgl tutup',
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
    } else {
        if ($tgl_tutup >= $tgl_pengumuman) {
            echo "<script>
            Swal.fire({
                title: 'Gagal',
                text: 'Tgl tutup tidak boleh lebih besar dari tgl pengumuman',
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
        } else {
            mysqli_query($conn, "UPDATE psb SET deskripsi='$dekripsi', persyaratan='$persyaratan', tgl_buka='$tgl_buka', tgl_tutup='$tgl_tutup', tgl_pengumuman='$tgl_pengumuman' WHERE id_psb='$id_psb'");
            if (mysqli_affected_rows($conn) > 0) {
                echo "<script>
                    Swal.fire({
                        title: 'Sukses',
                        text: 'Data berhasil di update',
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
                        text: 'Data gagal di update',
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
    }
}

function status_psb($data)
{
    global $conn;

    $id_psb = $data['id_psb'];

    if (isset($data['status']) != null) {
        $status = $data['status'];
        mysqli_query($conn, "UPDATE psb SET status='$status' WHERE id_psb='$id_psb'");
    } elseif (isset($data['status']) == null) {
        mysqli_query($conn, "UPDATE psb SET status='tidak aktif' WHERE id_psb='$id_psb'");
    }

    if (mysqli_affected_rows($conn) > 0) {
        echo "<script>
            Swal.fire({
                title: 'Sukses',
                text: 'Data berhasil di update',
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
                text: 'Data gagal di update',
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

function edit_tahunAkd($data)
{
    $id_tahunAkd = $data['id_tahunAkd'];
    global $conn;

    $tahun1 = $data['tahun1'];
    $tahun2 = $data['tahun2'];
    $status = 'tidak aktif';

    $tahun = $tahun1 . '/' . $tahun2;


    mysqli_query($conn, "UPDATE tahun_akademik SET tahun='$tahun' WHERE id_tahunAkd='$id_tahunAkd'");

    if (mysqli_affected_rows($conn) > 0) {
        echo "<script>
            Swal.fire({
                title: 'Sukses',
                text: 'Tahun akademik berhasil di update',
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
            text: 'Tahun akademik gagal di update',
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

function update_statusAkd($data)
{
    global $conn;

    $id_tahunAkd = $data['id_tahunAkd'];

    $cek_data = mysqli_fetch_array(mysqli_query($conn, "SELECT status FROM tahun_akademik WHERE id_tahunAkd='$id_tahunAkd'"));

    $status = $data['status'];

    // $update_sama = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM tahun_akademik WHERE status='$status'"));

    // var_dump($update_sama);

    if ($status != "aktif") {

        if ($cek_data['status'] == 'aktif') {
            mysqli_query($conn, "UPDATE tahun_akademik SET status='tidak aktif' WHERE id_tahunAkd='$id_tahunAkd'");
            mysqli_query($conn, "UPDATE tahun_akademik SET status='aktif' WHERE NOT (id_tahunAkd='$id_tahunAkd')'");
        } elseif ($cek_data['status'] == 'tidak aktif') {
            mysqli_query($conn, "UPDATE tahun_akademik SET status='aktif' WHERE id_tahunAkd='$id_tahunAkd'");
            mysqli_query($conn, "UPDATE tahun_akademik SET status='tidak aktif' WHERE NOT (id_tahunAkd='$id_tahunAkd')");
        }

        if (mysqli_affected_rows($conn) > 0) {
            echo "<script>
            Swal.fire({
                title: 'Sukses',
                text: 'Data berhasil di update',
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
            text: 'Data gagal di update',
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
    } else {
        echo " <script>
        Swal.fire({
            title: 'Gagal',
            text: 'Data sudah aktif',
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

function update_pengumuman($data)
{
    global $conn;
    $date_now = date('Y-m-d H:i:s');

    if (isset($data['id_pendaftaran'])) {
        $id_pendaftaran = $data['id_pendaftaran'];
        $jml_data = count($id_pendaftaran);

        if ($data['status_lulus'] == 'lulus') {
            $status_lulus = 'lulus';
        } elseif ($data['status_lulus'] == 'tidak lulus') {
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

                //     echo    '
                // <div class="alert alert-danger alert-dismissible fade show gagal" role="alert">
                // <strong>Holy guacamole!</strong> <p class="isi-pesanError" >Data sudah di update NO PENDAFTARAN :' . $pesan_noPend['no_pendaftaran'] . '</p>
                // <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                //     <span aria-hidden="true">&times;</span>
                // </button>
                // </div>';
                //     sleep(1);

                $gagal = $n++;
            } elseif (isset($cek_kelulusan) == null) {
                $get_psbSiswa = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM psb_siswa WHERE id_pendaftaran='$id_pendaftaran[$i]'"));
                var_dump($get_psbSiswa);
                $nisn = $get_psbSiswa['nisn'];
                $nama_siswa = $get_psbSiswa['nama_siswa'];
                $tempat_lahir = $get_psbSiswa['tempat_lahir'];
                $tgl_lahir = $get_psbSiswa['tgl_lahir'];
                $alamat = $get_psbSiswa['alamat_rumah'];
                $status = 'no_kelas';
                mysqli_query($conn, "INSERT INTO data_siswa (nisn,nama_siswa,tempat_lahir,tgl_lahir,alamat,status,created_at,updated_at) VALUES ('$nisn','$nama_siswa','$tempat_lahir','$tgl_lahir','$alamat','$status','$date_now','$date_now')");
                mysqli_query($conn, "INSERT INTO pengumuman_psb (id_pendaftaran,id_tahunAkd,status_lulus) VALUES ('$id_pendaftaran[$i]', '$id_akademik', '$status_lulus')");
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
            echo "<script>
        Swal.fire({
            title: 'Sukses',
            text: '$pesan',
            icon: 'success',
            showCancelButton: false,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'OK'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = 'pengumuman_psb.php';
            }
        })</script>";
        } else {
            echo "<script>Swal.fire({
            title: 'Gagal',
            text: 'Data gagal di update',
            icon: 'error',
            showCancelButton: false,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'OK'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = 'pengumuman_psb.php';
            }
        })</script>";
        }
    } else {
        echo "<script>Swal.fire({
        title: 'Gagal',
        text: 'Tidak ada data dipilih',
        icon: 'error',
        showCancelButton: false,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'OK'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = 'pengumuman_psb.php';
        }
    })</script>";
    }
}

function update_kelas($data)
{
    global $conn;

    $id_kelas = $data['id_kelas'];
    $nama_kelas = $data['nama_kelas'];
    $jumlah_bangku = $data['jumlah_bangku'];

    mysqli_query($conn, "UPDATE kelas SET nama_kelas='$nama_kelas', jumlah_bangku='$jumlah_bangku' WHERE id_kelas='$id_kelas'");

    if (mysqli_affected_rows($conn) > 0) {
        echo "<script>
        Swal.fire({
            title: 'Sukses',
            text: 'Data berhasil di update',
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
    } else {
        echo "<script>Swal.fire({
            title: 'Gagal',
            text: 'Tidak ada data di update',
            icon: 'error',
            showCancelButton: false,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'OK'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = 'data_kelas.php';
            }
        })</script>";
    }
}

function update_kelasSiswa($data)
{
    global $conn;

    $id_kelas = $data['id_kelas'];
    $id_siswa = $data['id_siswa'];
    $bulan_sekarang = date('Y-m');

    //get id thn akademik aktif 
    $get_tahunAkd = mysqli_fetch_array(mysqli_query($conn, "SELECT id_tahunAkd,status FROM tahun_akademik WHERE status='aktif'"));
    $id_thnAkd = $get_tahunAkd['id_tahunAkd'];
    $no_berhasil = 1;
    $no_gagal = 1;
    $no_sudahAda = 1;
    if (isset($id_kelas) || isset($id_siswa)) {
        $jml_siswa = count($id_siswa);
        for ($i = 0; $i < $jml_siswa; $i++) {
            $idSiswa = $id_siswa[$i];
            $idKelas = $id_kelas[$i];
            $get_nisn = mysqli_fetch_array(mysqli_query($conn, "SELECT id_siswa,nisn FROM data_siswa WHERE id_siswa='$idSiswa'"));
            $nisn = $get_nisn['nisn'];
            $get_jurusan = mysqli_fetch_array(mysqli_query($conn, "SELECT nisn,jurusan FROM psb_siswa WHERE nisn='$nisn'"));
            $jurusan = $get_jurusan['jurusan'];
            $data_akademik = mysqli_fetch_array(mysqli_query($conn, "SELECT id_siswa FROM data_akademik WHERE id_siswa='$idSiswa'"));
            if (!$data_akademik) {

                // INSERT KE DATA AKADEMIK

                // $cek_data = [
                //     'id_thnAkd' => $id_thnAkd,
                //     'id_siswa' => $idSiswa,
                //     'id_kelas' => $idKelas,
                //     'jurusan' => $jurusan,
                // ];

                $insert_akademik = mysqli_query($conn, "INSERT INTO data_akademik (id_thnAkd,id_siswa,id_kelas,id_Pstudi,bulan_tahun) VALUES ('$id_thnAkd', '$idSiswa', '$idKelas', '$jurusan', '$bulan_sekarang')");
                if (!$insert_akademik) {
                    echo ("Pesan insert akademik <br>" . mysqli_error($conn));
                }
                $update_siswa = mysqli_query($conn, "UPDATE data_siswa SET status='aktif'");
                if (!$update_siswa) {
                    echo ("Pesan update siswa <br>" . mysqli_error($conn));
                }
                if (mysqli_affected_rows($conn) > 0) {
                    $berhasil = $no_berhasil++;
                } else {
                    $gagal = $no_gagal++;
                }
            } else {
                $ada_diDb = $no_sudahAda++;
            }
        }

        if (isset($ada_diDb)) {
            $pesan = "Data berhasil di update " . $berhasil . " || Data gagal di update " . $gagal . " || Data sudah ada di db " . $ada_diDb;
        } else {
            $pesan = "Data berhasil di update " . $berhasil . " || Data gagal di update " . $gagal;
        }

        echo "<script>
    Swal.fire({
        title: 'INFO',
        text: '" . $pesan . "',
        icon: 'info',
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

        // var_dump($cek_data);
    } else {
        echo "<script>
    Swal.fire({
        title: 'ERROR',
        text: 'Tidak ada data di pilih. Pastikan semua data tercentang',
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
    }
}

function reset_password($data)
{
    global $conn;

    $password_lama = $data['password_lama'];
    $password_baru = $data['password_baru'];

    $get_data = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM admin ORDER BY id_admin ASC LIMIT 1"));
    $id_admin = $get_data['id_admin'];

    $cek_pwOld = mysqli_fetch_array(mysqli_query($conn, "SELECT password FROM admin WHERE id_admin='$id_admin' AND password='$password_lama'"));

    if ($cek_pwOld) {
        mysqli_query($conn, "UPDATE admin SET password='$password_baru' WHERE id_admin='$id_admin'");
    } else {
        echo '<script>
        alert("Password lama salah");
        </script>';
    }

    if (mysqli_affected_rows($conn)) {
        echo '<script>
        alert("Password berhasil di ubah kembali ke login");
        window.location.href = "logout.php";
        </script>';
    } else {
        echo "<script>
        Swal.fire({
            title: 'ERROR',
            text: 'Password gagal di update',
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

//EKSTRAKURIKULER

function update_kegiatan($data)
{
    global $conn;

    $id_kegiatan = $data['id_kegiatan'];
    $nama_kegiatan = $data['nama_kegiatan'];
    $deskripsi_kegiatan = $data['deskripsi_kegiatan'];

    mysqli_query($conn, "UPDATE data_kegiatan SET nama_kegiatan='$nama_kegiatan', deskripsi_kegiatan='$deskripsi_kegiatan' WHERE id_kegiatan='$id_kegiatan'");
    if (mysqli_affected_rows($conn) > 0) {
        echo "<script>
        Swal.fire({
            title: 'Sukses',
            text: 'Data berhasil di update',
            icon: 'success',
            showCancelButton: false,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'OK'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = 'detail_kegiatan.php?id_kegiatan=" . $id_kegiatan . "';
            }
        })
    </script>";
    } else {
        echo "<script>Swal.fire({
            title: 'Gagal',
            text: 'Tidak ada data di update',
            icon: 'error',
            showCancelButton: false,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'OK'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = 'detail_kegiatan.php?id_kegiatan=" . $id_kegiatan . "';
            }
        })</script>";
    }
}

function update_pembina($data)
{
    global $conn;

    $id_pembina = $data['id_pembina'];
    $pembina_userid = $data['pembina_userid'];
    $nip = $data['nip_pembina'];
    $nama_pembina = $data['nama_pembina'];
    $alamat_pembina = $data['alamat_pembina'];
    $no_hp = $data['no_hp'];
    $username = $data['username'];
    $password = $data['password'];
    $gambar_lama = $data['gambar_lama'];
    $date_now = date("Y-m-d H:i:s");

    $cek_user = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM users WHERE username='$username' AND password='$password'"));
    if (!$cek_user) {
        mysqli_query($conn, "UPDATE users SET username='$username', password='$password' WHERE id_user='$pembina_userid'");
    }

    if (!$_FILES['file']['name']) {
        $nama_gambar = $gambar_lama;
    } else {
        $nama_gambar = rand(1009, 9999) . '_' . $_FILES['file']['name'];
        $temp_name = $_FILES['file']['tmp_name'];
        $lokasi_file = './gambar/pembina/';
        move_uploaded_file($temp_name, $lokasi_file . $nama_gambar);
        if ($gambar_lama != 'default.jpg') {
            unlink('./gambar/pembina/' . $gambar_lama);
        }
    }

    mysqli_query($conn, "UPDATE data_pembina SET nip='$nip', nama_pembina='$nama_pembina', alamat_pembina='$alamat_pembina',  no_hp='$no_hp', gambar_pembina='$nama_gambar', updated_at='$date_now' WHERE id_pembina='$id_pembina'");

    // var_dump(mysqli_error($conn));
    if (mysqli_affected_rows($conn) > 0) {
        echo "<script>
        Swal.fire({
            title: 'Sukses',
            text: 'Data berhasil di update',
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
        echo "<script>Swal.fire({
            title: 'Gagal',
            text: 'Tidak ada data di update',
            icon: 'error',
            showCancelButton: false,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'OK'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = 'data_pembina.php';
            }
        })</script>";
    }
}
