<?php

include '../pembina/koneksi.php';

$id_user = $_SESSION['id_user'];
$get_kegiatan = mysqli_fetch_array(mysqli_query($conn, "SELECT pembina_userid,mengajar_kegiatan FROM data_pembina WHERE pembina_userid='$id_user'"));
$id_kegiatan = $get_kegiatan['mengajar_kegiatan'];

function update_gambar($data)
{
    global $conn, $id_user;
    $gambar_lama = $data["gambar_lama"];

    if (!$_FILES['file']['name']) {
        echo "<script>
        Swal.fire({
            title: 'Gagal',
            text: 'Tidak ada gambar yang perlu di update',
            icon: 'error',
            showCancelButton: false,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'OK'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = 'profile.php';
            }
        })
    </script>";
    } else {
        $nama_gambar = rand(1009, 9999) . '_' . $_FILES['file']['name'];
        mysqli_query($conn, "UPDATE data_pembina SET gambar_pembina='$nama_gambar' WHERE pembina_userid='$id_user'");

        $temp_name = $_FILES['file']['tmp_name'];
        $lokasi_file = '../admin/gambar/pembina/';
        move_uploaded_file($temp_name, $lokasi_file . $nama_gambar);
        if ($gambar_lama != 'default.jpg') {
            unlink('../admin/gambar/pembina/' . $gambar_lama);
        }

        echo "<script>
            Swal.fire({
                title: 'Sukses',
                text: 'Gambar Berhasil di update',
                icon: 'success',
                showCancelButton: false,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'OK'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = 'profile.php';
                }
            })
        </script>";
    }
}

function update_profil($data)
{
    global $conn, $id_user;

    $nip = $data['nip'];
    $nama_pembina = $data['nama_pembina'];
    $alamat_pembina = $data['alamat_pembina'];
    $no_hp = $data['no_hp'];
    $username = $data['username'];
    $password = $data['password'];
    $date_now = date("Y-m-d H:i:s");

    mysqli_query($conn, "UPDATE data_pembina SET nip='$nip', nama_pembina='$nama_pembina', alamat_pembina='$alamat_pembina',  no_hp='$no_hp', updated_at='$date_now' WHERE pembina_userid='$id_user'");

    if ($username != NULL || $password != NULL) {
        mysqli_query($conn, "UPDATE users SET username='$username', password='$password' WHERE id_user='$id_user'");
        $msg = "Password dan username juga di rubah";
    } else {
        $msg = "Tidak ada perubahan pada password dan username";
    }

    echo "<script>
    Swal.fire({
        title: 'Sukses',
        text: 'Profi Berhasil di update dan " . $msg . "',
        icon: 'success',
        showCancelButton: false,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'OK'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = 'profile.php';
        }
    })
</script>";
}

function update_statusValidasi($data)
{
    global $conn;
    global $id_kegiatan;

    $id_siswa = $data['id_siswa'];

    $cek_statusValidasi = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM ekstrakurikuler WHERE id_siswa='$id_siswa'"));

    if ($cek_statusValidasi['status_validasi'] == 'validasi nilai') {
        mysqli_query($conn, "UPDATE ekstrakurikuler SET status_validasi='aktif' WHERE id_siswa='$id_siswa'");
        //cari jadwal berdasarkan bulan sekarang
        $bulan_sekarang = date('Y-m');
        $get_jadwal = mysqli_fetch_array(mysqli_query($conn, "SELECT id_jadwal,id_kegiatan,tanggal FROM jadwal_ekstra WHERE id_kegiatan='$id_kegiatan' AND tanggal LIKE '$bulan_sekarang%'"));
        //tambahkan nilai berdasarkan bulan sekarang
        $query_jadwal = mysqli_query($conn, "SELECT id_jadwal,id_kegiatan,tanggal FROM jadwal_ekstra WHERE id_kegiatan='$id_kegiatan' AND tanggal LIKE '$bulan_sekarang%'");
        if (isset($query_jadwal)) {
            foreach ($query_jadwal as $row) {
                $id_jadwal = $row['id_jadwal'];
                mysqli_query($conn, "INSERT INTO nilai_ekstra (id_siswa,nilai,id_jadwal) VALUES ('$id_siswa', '0', '$id_jadwal')");
            }
            echo "<script>
            Swal.fire({
                title: 'Sukses',
                text: 'Siswa berhasil divalidasi dan nilai berhasil di tambahkan',
                icon: 'success',
                showCancelButton: false,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'OK'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = 'validasi_nilai.php';
                }
            })
        </script>";
        } else {
            echo "<script>
            Swal.fire({
                title: 'Sukses',
                text: 'Siswa berhasil divalidasi',
                icon: 'success',
                showCancelButton: false,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'OK'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = 'validasi_nilai.php';
                }
            })
        </script>";
        }
    } else {
        echo "<script>
        Swal.fire({
            title: 'Gagal',
            text: 'Siswa sudah divalidasi',
            icon: 'error',
            showCancelButton: false,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'OK'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = 'validasi_nilai.php';
            }
        })
    </script>";
    }
}

function update_nilai($data)
{
    global $conn;

    $id_nilai = $data['id_nilai'];
    $nilai = $data['nilai'];

    mysqli_query($conn, "UPDATE nilai_ekstra SET nilai='$nilai' WHERE id_nilai='$id_nilai'");

    if (mysqli_affected_rows($conn) > 0) {
        echo "<script>
        Swal.fire({
            title: 'Sukses',
            text: 'Nilai berhasil di update',
            icon: 'success',
            showCancelButton: false,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'OK'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = 'nilai_kegiatan.php';
            }
        })
    </script>";
    } else {
        echo "<script>
        Swal.fire({
            title: 'Gagal',
            text: 'Nilai gagal diupdate',
            icon: 'error',
            showCancelButton: false,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'OK'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = 'nilai_kegiatan.php';
            }
        })
    </script>";
    }
}

function update_jadwal($data)
{
    global $conn, $id_kegiatan;

    $id_jadwal = $data['id_jadwal'];
    $tanggal = $data['tanggal'];
    $materi = $data['materi'];
    $waktu = $data['waktu'];
    $keterangan = $data['keterangan'];
    var_dump($id_jadwal);
    mysqli_query($conn, "UPDATE jadwal_ekstra SET tanggal='$tanggal', materi='$materi', waktu='$waktu', keterangan='$keterangan' WHERE id_jadwal='$id_jadwal'");

    if (mysqli_affected_rows($conn) > 0) {
        echo "<script>
        Swal.fire({
            title: 'Sukses',
            text: 'Jadwal berhasil di update',
            icon: 'success',
            showCancelButton: false,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'OK'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = 'jadwal_kegiatan.php';
            }
        })
    </script>";
    } else {
        echo "<script>
        Swal.fire({
            title: 'Gagal',
            text: 'Jadwal gagal diupdate',
            icon: 'error',
            showCancelButton: false,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'OK'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = 'jadwal_kegiatan.php';
            }
        })
    </script>";
    }
}
