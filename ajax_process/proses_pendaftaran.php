<?php
// require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Reader\Xml\Style\Alignment;


include '../admin/koneksi.php';

$no_pendaftaran = $_POST['no_pendaftaran'];
$nisn = $_POST['nisn'];
$nama_siswa = $_POST['nama_siswa'];
$tempat_lahir = $_POST['tempat_lahir'];
$tgl_lahir = $_POST['tgl_lahir'];
$nama_ortu = $_POST['nama_ortu'];
$alamat_rumah = $_POST['alamat_rumah'];
$no_hp = $_POST['no_hp'];
$pekerjaan_ortu = $_POST['pekerjaan_ortu'];
$asal_sekolah = $_POST['asal_sekolah'];
$jurusan = $_POST['jurusan'];
$scan_ijazah = rand(1000, 9999) . '_' . $nisn . '_' . $_FILES['scan_ijazah']['name'];
$scan_kk = rand(1000, 9999) . '_' . $nisn . '_' .  $_FILES['scan_kk']['name'];
$scan_ktpOrtu = rand(1000, 9999) . '_' . $nisn . '_' . $_FILES['scan_ktpOrtu']['name'];
$scan_nisn = rand(1000, 9999) . '_' . $nisn . '_' . $_FILES['scan_nisn']['name'];
$status_pendaftaran = 'sedang divalidasi';
$date_now = date('Y-m-d H:i:s');

$cek_data = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM psb_siswa WHERE nisn='$nisn'"));
$id_thnAkd = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM tahun_akademik WHERE status='aktif'"));

if (isset($cek_data)) {
    sleep(1);
    $msg = [
        'gagal' => "Data dengan NISN : " . $nisn . " sudah terdaftar"
    ];
    echo json_encode($msg);
} else {
    $get_idthnAkd = $id_thnAkd['id_tahunAkd'];
    mysqli_query($conn, "INSERT INTO psb_siswa (id_thnAkd,no_pendaftaran,nisn,nama_siswa,tempat_lahir,tgl_lahir,nama_ortu,alamat_rumah,no_hp,pekerjaan_ortu,asal_sekolah,jurusan,scan_ijazah,scan_kk,scan_ktpOrtu,scan_nisn,status_pendaftaran,created_at,updated_at) VALUES ('$get_idthnAkd','$no_pendaftaran','$nisn', '$nama_siswa', '$tempat_lahir', '$tgl_lahir', '$nama_ortu', '$alamat_rumah', '$no_hp', '$pekerjaan_ortu', '$asal_sekolah', '$jurusan', '$scan_ijazah', '$scan_kk', '$scan_ktpOrtu', '$scan_nisn', '$status_pendaftaran','$date_now', '$date_now')");

    if (mysqli_affected_rows($conn) > 0) {
        //scan ijazah
        $tmpName_ijazah = $_FILES['scan_ijazah']['tmp_name'];
        move_uploaded_file($tmpName_ijazah, '../admin/gambar/siswa_psb/' . $scan_ijazah);
        //scan kk
        $tmpName_kk = $_FILES['scan_kk']['tmp_name'];
        move_uploaded_file($tmpName_kk, '../admin/gambar/siswa_psb/' . $scan_kk);
        //scan ktp ortu   
        $tmpName_ktpOrtu = $_FILES['scan_ktpOrtu']['tmp_name'];
        move_uploaded_file($tmpName_ktpOrtu, '../admin/gambar/siswa_psb/' . $scan_ktpOrtu);
        //scan nisn
        $tmpName_nisn = $_FILES['scan_nisn']['tmp_name'];
        move_uploaded_file($tmpName_nisn, '../admin/gambar/siswa_psb/' . $scan_nisn);

        $get_jurusan = mysqli_fetch_array(mysqli_query($conn, "SELECT nama_studi FROM program_studi WHERE id_Pstudi='$jurusan'"));

        sleep(1);

        $msg = [
            'sukses' => 'Berhasil.. silahkan tunggu pengumuman selanjutnya secara bertahap',
            'detail' => "<table>
            <tr>
                <td>
                    <h6>Nomor Pendaftaran</h6>
                </td>
                <td>
                    <h6>:</h6>
                </td>
                <td>
                    <h6>" . $no_pendaftaran . "</h6>
                </td>
            </tr>
            <tr>
                <td>
                    <h6>NISN</h6>
                </td>
                <td>
                    <h6>:</h6>
                </td>
                <td>
                    <h6>" . $nisn . "</h6>
                </td>
            </tr>
            <tr>
                <td>
                    <h6>Nama Calon Siswa</h6>
                </td>
                <td>
                    <h6>:</h6>
                </td>
                <td>
                    <h6>" . $nama_siswa . "</h6>
                </td>
            </tr>
            <tr>
                <td>
                    <h6>Tempat dan tanggal lahir</h6>
                </td>
                <td>
                    <h6>:</h6>
                </td>
                <td>
                    <h6>" . $tempat_lahir . ' ,' . $tgl_lahir . "</h6>
                </td>
            </tr>
            <tr>
                <td>
                    <h6>Nama Orang Tua</h6>
                </td>
                <td>
                    <h6>:</h6>
                </td>
                <td>
                    <h6>" . $nama_ortu . "</h6>
                </td>
            </tr>
            <tr>
                <td>
                    <h6>alamat rumah</h6>
                </td>
                <td>
                    <h6>:</h6>
                </td>
                <td>
                    <h6>" . $alamat_rumah . "</h6>
                </td>
            </tr>
            <tr>
                <td>
                    <h6>No Hp</h6>
                </td>
                <td>
                    <h6>:</h6>
                </td>
                <td>
                    <h6>" . $no_hp . "</h6>
                </td>
            </tr>
            <tr>
                <td>
                    <h6>Pekerjaan Orang Tua</h6>
                </td>
                <td>
                    <h6>:</h6>
                </td>
                <td>
                    <h6>" . $pekerjaan_ortu . "</h6>
                </td>
            </tr>
            <tr>
                <td>
                    <h6>Asal Sekolah</h6>
                </td>
                <td>
                    <h6>:</h6>
                </td>
                <td>
                    <h6>" . $asal_sekolah . "</h6>
                </td>
            </tr>
            <tr>
                <td>
                    <h6>Jurusan Yang Dipilih</h6>
                </td>
                <td>
                    <h6>:</h6>
                </td>
                <td>
                    <h6>" . $get_jurusan['nama_studi'] . "</h6>
                </td>
            </tr>
        </table>
        <button onclick='window.print()' class='btn btn-primary mt-4'>Cetak detail data pendaftaran anda</button>
        "
        ];
        echo json_encode($msg);
    } else {
        sleep(1);

        $msg = [
            'gagal' => 'Gagal mendaftar silahkan periksa kembali data anda'
        ];

        echo json_encode($msg);
    }
}

  // $spreadsheet = new Spreadsheet();

        // $spreadsheet->getDefaultStyle()
        //     ->getFont()
        //     ->setName('Cilibri')
        //     ->setSize(12);

        // $spreadsheet->getActiveSheet()
        //     ->setCellValue('A1', "FORMULIR PENDAFTARAN SISWA BARU");
        // $spreadsheet->getActiveSheet()
        //     ->mergeCells("A1:I1");
        // $spreadsheet->getActiveSheet()
        //     ->getStyle('A1')
        //     ->getAlignment()
        //     ->setHorizontal('center');

        // $spreadsheet->getActiveSheet()
        //     ->setCellValue('A2', "SMK MIFTAHUL ULUM SAMPANG");
        // $spreadsheet->getActiveSheet()
        //     ->mergeCells("A2:I2");
        // $spreadsheet->getActiveSheet()
        //     ->getStyle('A2')
        //     ->getAlignment()
        //     ->setHorizontal('center');

        // $spreadsheet->getActiveSheet()
        //     ->setCellValue('A3', "TAHUN PELAJARAN 2022/2023");
        // $spreadsheet->getActiveSheet()
        //     ->mergeCells("A3:I3");
        // $spreadsheet->getActiveSheet()
        //     ->getStyle('A3')
        //     ->getAlignment()
        //     ->setHorizontal('center');

        // $spreadsheet->getActiveSheet()
        //     ->setCellValue('A5', 'Nomor Pendaftaran')
        //     ->setCellValue('D5', ': ' . $no_pendaftaran);


        // $spreadsheet->getActiveSheet()
        //     ->setCellValue('A6', 'NISN')
        //     ->setCellValue('D6', ': ' . $nisn);

        // $spreadsheet->getActiveSheet()
        //     ->setCellValue('A7', 'Nama Calon Siswa')
        //     ->setCellValue('D7', ': ' . $nama_siswa);

        // $spreadsheet->getActiveSheet()
        //     ->setCellValue('A8', 'Tempat dan Tgl Lahir')
        //     ->setCellValue('D8', ': ' . $tempat_lahir . ', ' . $tgl_lahir);
        // $spreadsheet->getActiveSheet()
        //     ->setCellValue('A9', 'Nama Orangtua')
        //     ->setCellValue('D9', ': ' . $nama_ortu);

        // $spreadsheet->getActiveSheet()
        //     ->setCellValue('A10', 'Alamat Rumah')
        //     ->setCellValue('D10', ': ' . $alamat_rumah);

        // $spreadsheet->getActiveSheet()
        //     ->setCellValue('A11', 'Nomer Hp')
        //     ->setCellValue('D11', ': ' . $no_hp);

        // $spreadsheet->getActiveSheet()
        //     ->setCellValue('A12', 'Pekerjaan Orangtua')
        //     ->setCellValue('D12', ': ' . $pekerjaan_ortu);

        // $spreadsheet->getActiveSheet()
        //     ->setCellValue('A13', 'Asal Sekolah')
        //     ->setCellValue('D13', ': ' . $asal_sekolah);

        // $spreadsheet->getActiveSheet()
        //     ->setCellValue('A14', 'Jurusan Yang Diambil')
        //     ->setCellValue('D14', ': ' . $jurusan);

        // $spreadsheet->getActiveSheet()
        //     ->setCellValue('A16', 'Detail Lengkap')
        //     ->setCellValue('D16', ': https://text.php');

        // $spreadsheet->getActiveSheet()
        //     ->getStyle('A5:A16')
        //     ->getFont()
        //     ->getBold();

        // $writer = new Xlsx($spreadsheet);
        // $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, "Xlsx");
        // $writer->save("05featuredemo.xlsx");
        // $filename = 'pend-' . $nama_siswa . '_' . $no_pendaftaran;
        // header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        // header('Content-Disposition: attachment;filename=' . $filename . '.xlsx');
        // header('Cache-Control: max-age=0');
        // $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        // $writer->save('php://output');
        // exit;
        // $writer->save($filename);