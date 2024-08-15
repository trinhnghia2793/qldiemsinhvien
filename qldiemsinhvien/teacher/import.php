<?php
if (!isset($_SESSION)) {
    session_start();
}
include 'permission.php';

// config
include_once '../config.php';
function loadClass($c)
{
    include "../class/$c.php";
}
spl_autoload_register("loadClass");

// Include PhpSpreadsheet library autoloader
require_once '../vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

if(isset($_POST['importSubmit'])) {
    // Allowed mine types
    $excelMimes = array('text/xls', 'text/xlsx', 'application/excel', 'application/vnd.msexcel',
    'application/vnd.ms-excel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');

    // Validate wether selected file is a Excel file
    if(!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'], $excelMimes)) {
        // If the file is uploaded
        if(is_uploaded_file($_FILES['file']['tmp_name'])) {
            $reader = new Xlsx();
            $spreadsheet = $reader->load($_FILES['file']['tmp_name']);
            $worksheet = $spreadsheet->getActiveSheet();
            $worksheet_arr = $worksheet->toArray();

            print_r($worksheet_arr);

            // Remove some rows
            unset($worksheet_arr[0]);
            unset($worksheet_arr[0]);
            unset($worksheet_arr[0]);
            unset($worksheet_arr[0]);

            foreach($worksheet_arr as $row) {
                $id = $row[0];
                $test1 = $row[3];
                $test2 = $row[4];
                $mid = $row[5];
                $final = $row[6];

                $score = new score();
                $score->update($id, $test1, $test2, $mid, $final);
            }

            $qstring = '&status=succ';
        }
        else {
            $qstring = '&status=err';
        }
    }
    else {
        $qstring = '&status=invalid_file';
    }
}

$id = $_POST['id'] ?? '';

// Redirect
header("location:score_index_byid.php?id=".$id.$qstring);
exit;

?>