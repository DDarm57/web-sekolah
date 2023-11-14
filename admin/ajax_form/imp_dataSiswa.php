<?php
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Reader\Xls;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

$reader = new Xlsx();
$file = $_FILES['file']['tmp_name'];
$reader->setReadDataOnly(true);
// lokasi file excel
$spreadsheet = $reader->load($file);
$worksheet = $spreadsheet->getActiveSheet();
$rows = $worksheet->toArray();

// var_dump($rows);

foreach ($rows as $key => $value) {
    echo $value[2] . '<br>';
}
