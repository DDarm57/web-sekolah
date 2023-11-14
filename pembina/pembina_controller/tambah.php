<?php

include '../pembina/koneksi.php';

function tambah_jadwal($data)
{
    global $conn;
    $pembina_userid = $_SESSION['id_user'];
    $get_pembina = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM data_pembina WHERE pembina_userid = $pembina_userid"));
    $mengajar_kegiatan = $get_pembina['mengajar_kegiatan'];
    $get_thnAkd = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM tahun_akademik WHERE status='aktif'"));
    $id_thnAkd = $get_thnAkd['id_tahunAkd'];
    $id_kegiatan = $data['id_kegiatan'];
    $tanggal = $data['tanggal'];
    $waktu = $data['waktu'];
    $materi = $data['materi'];
    $keterangan = $data['keterangan'];

    // var_dump([$id_kegiatan, $id_thnAkd, $tanggal, $waktu, $materi, $keterangan]);

    $cek_jadwal = mysqli_fetch_array(mysqli_query($conn, "SELECT tanggal,id_kegiatan FROM jadwal_ekstra WHERE tanggal='$tanggal' AND id_kegiatan='$id_kegiatan'"));

    if (isset($cek_jadwal)) {
        echo "<script>
        Swal.fire({
            title: 'Gagal',
            text: 'Gagal menambahakan jadwal dengan tahun dan hari yang sama',
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
        $query_siswaEkstra =  mysqli_query($conn, "SELECT * FROM ekstrakurikuler INNER JOIN tahun_akademik ON tahun_akademik.id_tahunAkd = ekstrakurikuler.id_thnAkd INNER JOIN data_siswa ON data_siswa.id_siswa = ekstrakurikuler.id_siswa WHERE id_kegiatan = '$mengajar_kegiatan'");
        mysqli_query($conn, "INSERT INTO jadwal_ekstra (tanggal,materi,waktu,keterangan,id_kegiatan,id_thnAkd) VALUES ('$tanggal', '$materi', '$waktu', '$keterangan', '$id_kegiatan', '$id_thnAkd')");
        $id_jadwal = mysqli_insert_id($conn);

        $get_thnAkd = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM tahun_akademik WHERE status='aktif'"));
        $id_thnAkd = $get_thnAkd['id_tahunAkd'];

        while ($row = mysqli_fetch_array($query_siswaEkstra)) {
            $id_siswa = $row['id_siswa'];
            if ($row['status_validasi'] == "validasi nilai") {
                continue;
            }
            if ($row["status"] != "lulus") {
                mysqli_query($conn, "INSERT INTO nilai_ekstra (id_siswa,nilai,id_jadwal) VALUES ('$id_siswa', '0', '$id_jadwal')");
            }
        }

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
                        window.location.href = 'jadwal_kegiatan.php';
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

function cek_siswa($data)
{
    global $conn;

    $id_kegiatan = $data['id_kegiatan'];
    $nisn = $data['nisn'];
    $password = $data['password'];

    $cek_siswa = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM data_siswa WHERE nisn='$nisn'"));

    if ($cek_siswa) {
        echo '<div class="alert alert-info alert-dismissible">
        <h5><i class="icon fas fa-exclamation-triangle"> </i> Info !</h5>
        Data NISN = ' . $nisn . ' ditemukan dengan <strong>NAMA = ' . $cek_siswa['nama_siswa'] . ' || </strong> apakah anda yakin ingin mendaftarkan siswa ini ?<br>
        <a href="data_siswa.php?daftarkan=' . $cek_siswa['id_siswa'] . '&password=' . $password . '&id_kegiatan=' . $id_kegiatan . '" class="btn btn-sm btn-danger">Ya Tambahkan!</a> || <a href="data_siswa.php" class="btn btn-sm btn-success">Batal!</a>
    </div>';
    } else {
        echo "<script>
            Swal.fire({
                title: 'No Data',
                text: 'Data NISN " . $nisn . " Tidak Ditemukan',
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

function tambah_siswaEkstra($data)
{
    global $conn;

    $id_siswa = $data['daftarkan'];
    $password = $data['password'];
    $id_kegiatan = $data['id_kegiatan'];
    $pembina_userid = $_SESSION['id_user'];
    $get_idPembina = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM data_pembina WHERE id_pembina = '$pembina_userid'"));
    $id_pembina = $get_idPembina['id_pembina'];
    $get_siswa = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM data_siswa WHERE id_siswa='$id_siswa'"));
    $nisn = $get_siswa['nisn'];
    $date_now = date('Y-m-d H:i:s');
    $get_thnAkd = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM tahun_akademik WHERE status='aktif'"));
    $id_thnAkd = $get_thnAkd['id_tahunAkd'];

    $cek_esktra = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM ekstrakurikuler WHERE id_siswa='$id_siswa'"));

    if ($cek_esktra) {
        echo " <script>
        Swal.fire({
            title: 'Gagal',
            text: 'Data sudah ada di ekstrakurikuler',
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
    } else {
        // var_dump([$id_siswa, $password, $id_kegiatan, $id_pembina]);

        //insert users siswa
        mysqli_query($conn, "INSERT INTO users (username,password,level,created_at,updated_at) VAlUES ('$nisn', '$password', '2', '$date_now', '$date_now')");
        $siswa_userid = mysqli_insert_id($conn);
        //insert data ekstra
        mysqli_query($conn, "INSERT INTO ekstrakurikuler (id_kegiatan,id_siswa,id_pembina,siswa_userid,status_validasi,id_thnAkd) VALUES ('$id_kegiatan', '$id_siswa', '$id_pembina', '$siswa_userid', 'validasi nilai', '$id_thnAkd')");
        if (mysqli_affected_rows($conn) > 0) {
            echo "<script>
                Swal.fire({
                    title: 'Sukses',
                    text: 'Data berhasil di tambahkan',52643872
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
            echo " <script>
            Swal.fire({
                title: 'Gagal',
                text: 'Data gagal di tambahkan',
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
