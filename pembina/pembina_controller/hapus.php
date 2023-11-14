<?php

include '../pembina/koneksi.php';
$id_user = $_SESSION['id_user'];
$get_kegiatan = mysqli_fetch_array(mysqli_query($conn, "SELECT pembina_userid,mengajar_kegiatan FROM data_pembina WHERE pembina_userid='$id_user'"));
$id_kegiatan = $get_kegiatan['mengajar_kegiatan'];

function hapus_jadwal($data)
{
    global $conn, $id_kegiatan;


    $id_jadwal = $data['id_jadwal'];

    $cek_isiNilai = mysqli_query($conn, "SELECT SUM(nilai) AS total FROM nilai_ekstra WHERE id_jadwal='$id_jadwal'");
    $get_isiNilai = mysqli_fetch_array($cek_isiNilai);


    if ($get_isiNilai['total'] > 0) {
        echo "<script>
        Swal.fire({
            title: 'Gagal',
            text: 'Jadwal kegiatan ini gagal di hapus, karena jadwal ini sudah ada nilai di masing-masing siswa',
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
    } else {
        mysqli_query($conn, "DELETE FROM nilai_ekstra WHERE id_jadwal='$id_jadwal'");
        mysqli_query($conn, "DELETE FROM jadwal_ekstra WHERE id_jadwal='$id_jadwal'");
        if (mysqli_affected_rows($conn) > 0) {
            echo "<script>
                    Swal.fire({
                        title: 'Sukses',
                        text: 'Data berhasil di hapus',
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
                        text: 'Data gagal di hapus',
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
}
