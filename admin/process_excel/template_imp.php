<?php
ob_start();

require '../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


function temp_siswa()
{
    $spreadsheet = new Spreadsheet();
    $spreadsheet->getDefaultStyle()
        ->getFont()
        ->setName('Cilibri')
        ->setSize(11);
    $spreadsheet->getActiveSheet()
        ->setCellValue('A1', 'NO')
        ->setCellValue('B1', 'NISN')
        ->setCellValue('C1', 'NAMA')
        ->setCellValue('D1', 'TEMPAT')
        ->setCellValue('E1', 'TGL LAHIR')
        ->setCellValue('F1', 'ORANG TUA')
        ->setCellValue('G1', 'ALAMAT')
        ->setCellValue('H1', 'HP')
        ->setCellValue('I1', 'PEKERJAAN ORANG TUA')
        ->setCellValue('J1', 'ASAL SEKOLAH')
        ->setCellValue('K1', 'KELAS');

    $spreadsheet->getActiveSheet()
        ->getStyle('A1:K1')
        ->getBorders()
        ->getAllBorders()
        ->setBorderStyle(Border::BORDER_THIN);

    $spreadsheet->getActiveSheet()
        ->getColumnDimension('A')
        ->setWidth(4);
    $spreadsheet->getActiveSheet()
        ->getColumnDimension('B')
        ->setWidth(10);
    $spreadsheet->getActiveSheet()
        ->getColumnDimension('C')
        ->setWidth(18);
    $spreadsheet->getActiveSheet()
        ->getColumnDimension('D')
        ->setWidth(17);
    $spreadsheet->getActiveSheet()
        ->getColumnDimension('E')
        ->setWidth(15);
    $spreadsheet->getActiveSheet()
        ->getColumnDimension('F')
        ->setWidth(15);
    $spreadsheet->getActiveSheet()
        ->getColumnDimension('G')
        ->setWidth(19);
    $spreadsheet->getActiveSheet()
        ->getColumnDimension('H')
        ->setWidth(15);
    $spreadsheet->getActiveSheet()
        ->getColumnDimension('I')
        ->setWidth(10);
    $spreadsheet->getActiveSheet()
        ->getColumnDimension('J')
        ->setWidth(20);
    $spreadsheet->getActiveSheet()
        ->getColumnDimension('K')
        ->setWidth(10);

    // $writer = new Xlsx($spreadsheet);
    // $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, "Xlsx");
    // $writer->save("05featuredemo.xlsx");
    $writer = new Xlsx($spreadsheet);
    $writer->save('template_siswa.xlsx');
    echo "<script>
    let timerInterval
    Swal.fire({
        title: 'Kembali ke data siswa!',
        html: 'Kembali ke data siswa',
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
    </script>";
    echo "<script>window.location = 'template_siswa.xlsx'</script>";
}

function temp_psb($data)
{
    $jumlah_kolom = $data['column'];

    $spreadsheet = new Spreadsheet();
    $spreadsheet->getDefaultStyle()
        ->getFont()
        ->setName('Cilibri')
        ->setSize(11);
    $spreadsheet->getActiveSheet()
        ->setCellValue('A1', 'NO')
        ->setCellValue('B1', 'NISN')
        ->setCellValue('C1', 'NAMA')
        ->setCellValue('D1', 'TEMPAT')
        ->setCellValue('E1', 'TGL LAHIR')
        ->setCellValue('F1', 'ORANG TUA')
        ->setCellValue('G1', 'ALAMAT')
        ->setCellValue('H1', 'HP')
        ->setCellValue('I1', 'PEKERJAAN ORANG TUA')
        ->setCellValue('J1', 'ASAL SEKOLAH');

    $spreadsheet->getActiveSheet()
        ->getStyle('A1:J1')
        ->getBorders()
        ->getAllBorders()
        ->setBorderStyle(Border::BORDER_THIN);

    $spreadsheet->getActiveSheet()
        ->getColumnDimension('A')
        ->setWidth(4);
    $spreadsheet->getActiveSheet()
        ->getColumnDimension('B')
        ->setWidth(10);
    $spreadsheet->getActiveSheet()
        ->getColumnDimension('C')
        ->setWidth(18);
    $spreadsheet->getActiveSheet()
        ->getColumnDimension('D')
        ->setWidth(17);
    $spreadsheet->getActiveSheet()
        ->getColumnDimension('E')
        ->setWidth(15);
    $spreadsheet->getActiveSheet()
        ->getColumnDimension('F')
        ->setWidth(15);
    $spreadsheet->getActiveSheet()
        ->getColumnDimension('G')
        ->setWidth(19);
    $spreadsheet->getActiveSheet()
        ->getColumnDimension('H')
        ->setWidth(15);
    $spreadsheet->getActiveSheet()
        ->getColumnDimension('I')
        ->setWidth(10);
    $spreadsheet->getActiveSheet()
        ->getColumnDimension('J')
        ->setWidth(20);

    $kolom = 2;
    $no = 1;
    for ($i = 1; $i <= $jumlah_kolom; $i++) {
        $spreadsheet->getActiveSheet()->setCellValue('A' . $kolom++, $no++);
        $spreadsheet->getActiveSheet()
            ->getStyle('A2:J' . $no)
            ->getBorders()
            ->getAllBorders()
            ->setBorderStyle(Border::BORDER_THIN);
    }

    // $writer = new Xlsx($spreadsheet);
    // $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, "Xlsx");
    // $writer->save("05featuredemo.xlsx");
    $writer = new Xlsx($spreadsheet);
    $writer->save('template_psb.xlsx');
    echo "<script>
    let timerInterval
    Swal.fire({
        title: 'Kembali ke psb siswa!',
        html: 'Kembali ke psb siswa',
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
    </script>";
    echo "<script>window.location = 'template_psb.xlsx'</script>";
}
