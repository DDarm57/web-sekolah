<?php
require_once '../../vendor/autoload.php';

use Dompdf\Dompdf;

// Create an instance of Dompdf
$dompdf = new Dompdf();

function tgl_indo($tanggal)
{
    $bulan = array(
        1 =>   'Januari',
        'Februari',
        'Maret',
        'April',
        'Mei',
        'Juni',
        'Juli',
        'Agustus',
        'September',
        'Oktober',
        'November',
        'Desember'
    );
    $pecahkan = explode('-', $tanggal);

    // variabel pecahkan 0 = tanggal
    // variabel pecahkan 1 = bulan
    // variabel pecahkan 2 = tahun

    return $bulan[(int)$pecahkan[1]];
}
session_start();
include '../../admin/koneksi.php';
$log = $_SESSION['user_log'];

if ($log != true) {
    header('location: ../login_ekstra.php');
} else {
    $level = $_SESSION['level'];
    if ($level != 1) {
        header('location: ../login_ekstra.php');
    } else {
        $id_user =  $_SESSION['id_user'];
        $get_pembina = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM data_pembina WHERE pembina_userid='$id_user'"));
    }
}

$kegiatan = $get_pembina['mengajar_kegiatan'];
$query = mysqli_query($conn, "SELECT * FROM tahun_akademik");
$get_tahunAkd = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM tahun_akademik WHERE status='aktif'"));

$bulan = $_GET['bulan'];

$query_jadwal = mysqli_query($conn, "SELECT * FROM jadwal_ekstra WHERE id_kegiatan='$kegiatan' AND tanggal LIKE '$bulan%'");
$get_idJadwal = mysqli_fetch_array($query_jadwal);
$query_nilai = mysqli_query($conn, "SELECT * FROM nilai_ekstra LEFT JOIN jadwal_ekstra on jadwal_ekstra.id_jadwal = nilai_ekstra.id_jadwal WHERE jadwal_ekstra.id_kegiatan = '$kegiatan' AND jadwal_ekstra.tanggal LIKE '$bulan%'");
$query_jdwl = mysqli_query($conn, "SELECT * FROM jadwal_ekstra WHERE id_kegiatan='$kegiatan' AND tanggal LIKE '$bulan%'");
$jumlah_jadwal = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM jadwal_ekstra WHERE id_kegiatan='$kegiatan' AND tanggal LIKE '$bulan%'"));
$query = mysqli_query($conn, "SELECT * FROM ekstrakurikuler 
INNER JOIN data_siswa ON data_siswa.id_siswa = ekstrakurikuler.id_siswa 
INNER JOIN data_akademik ON data_akademik.id_siswa = data_siswa.id_siswa
INNER JOIN kelas ON kelas.id_kelas = data_akademik.id_kelas 
WHERE id_kegiatan = '$kegiatan'");

$tahun_akademik = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM tahun_akademik WHERE status='aktif'"));
$tahun = $tahun_akademik["tahun"];

$nama_kegiatan = mysqli_fetch_array(mysqli_query($conn, "SELECT id_kegiatan,nama_kegiatan FROM data_kegiatan WHERE id_kegiatan='$kegiatan'"));

// Load HTML content to be converted to PDF
$html = '<center>
<h3>DAFTAR SISWA EKSTRAKURIKULER<br>
SMK MIFTAHUL ULUM SAMPANG<br>
TAHUN AKADEMIK ' . $tahun . '
</h3>
</center><hr/><br/>
EKSTRAKURIKULER : ' . $nama_kegiatan["nama_kegiatan"] . '
';
$html .= '<table width="100%" style="border-collapse: collapse;">
<thead>
<tr>
    <th rowspan="2" style="text-align: center; vertical-align: middle; border: 1px solid black;">No</th>
    <th rowspan="2" style="text-align: center; vertical-align: middle; border: 1px solid black;">Nama</th>
    <th rowspan="2" style="text-align: center; vertical-align: middle; border: 1px solid black;">Kelas</th>
    <th colspan="' . $jumlah_jadwal . '" style="text-align: center; vertical-align: middle; border: 1px solid black;">' . Tgl_indo($bulan) . '</th>
</tr><tr>';
if ($query_jadwal) {
    foreach ($query_jadwal as $jadwal) {
        $tgl = date("d", strtotime($jadwal["tanggal"]));
        $html .= '<th class="text-center" style="border: 1px solid black;">' . $tgl . '</th>';
    }
}
if (mysqli_num_rows($query_jadwal) == 0) {
    $html .= '<th style="border: 1px solid black;">Tidak ada jadwal</th>';
}
$html .= '</tr>
</thead>';
$no = 1;
$html .= "<tbody>";
while ($row = mysqli_fetch_array($query)) {
    $id_siswa = $row["id_siswa"];
    $cek_nilai = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM jadwal_ekstra
    INNER JOIN nilai_ekstra ON nilai_ekstra.id_jadwal = jadwal_ekstra.id_jadwal
    WHERE id_siswa = '$id_siswa' AND tanggal LIKE '$bulan%'
    "));
    if ($cek_nilai) {
        $html .= "<tr>
        <td style='border: 1px solid black;'>" . $no++ . "</td>
        <td style='border: 1px solid black;'>" . $row['nama_siswa'] . "</td>
        <td style='border: 1px solid black;'>" . $row['nama_kelas'] . "</td>";
    } else {
        continue;
    }
    if (mysqli_num_rows($query_nilai) == 0) {
        $html .= "<td style='border: 1px solid black;'>Tidak Ada Jadwal</td>";
    } elseif ($row['status_validasi'] == 'validasi nilai') {
        $jml_jadwal = mysqli_num_rows($query_jdwl);
        for ($i = 0; $i <= $jml_jadwal; $i++) {
            $html .= '<td style="border: 1px solid black;">Nilai Belum Divalidasi</td>';
            $html .= '<td style="border: 1px solid black;">Nilai Belum Divalidasi</td>';
        }
    } elseif (mysqli_num_rows($query_nilai) > 0) {
        foreach ($query_nilai as $nilai) {
            if ($row['id_siswa'] != $nilai['id_siswa']) {
                continue;
            } else {
                $html .= "<td style='text-align: center; vertical-align: middle; border: 1px solid black;'>" . $nilai['nilai'] . "</td>";
            }
        }
    }
    $html .= "</tr>";
}
$html .= "</tbody>";
$html .= "</html>";

// Load the HTML into Dompdf
$dompdf->loadHtml($html);

// (Optional) Set paper size and orientation
$dompdf->setPaper('A4', 'portrait');

// Render the HTML as PDF
$dompdf->render();

// Output the generated PDF to the browser
$dompdf->stream('test.pdf', ['Attachment' => false]);
