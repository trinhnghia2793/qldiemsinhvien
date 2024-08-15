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

// XLSX Generator
require_once 'XlsxGenerator.php';

$id = $_GET['id'] ?? '';

$score = new score();
$data = $score->all_byteacher_id($_SESSION['login'][1], $id);

$module = new module();
$info = $module->get($id);

// Excel file name
$filename = $info[0]->module_id . "_" . $info[0]->subject_name . ".xlsx";

$excelData[] = array('Mã học phần', $info[0]->module_id);
$excelData[] = array('Tên môn học', $info[0]->subject_name);
$excelData[] = array('Số tín chỉ', $info[0]->credit);

// Define column names
$excelData[] = array('Mã đkhp', 'MSSV', 'Họ và Tên', 'KT1', 'KT2', 'Giữa kỳ', 'Cuối kỳ');

// Duyệt từng dòng từ database và lưu trừ trong array

foreach($data as $item) {
    $lineData = array($item->register_id, $item->username, $item->name, $item->test1, $item->test2
    , $item->mid, $item->final);

    $excelData[] = $lineData;
}

// Export data to excel and download as .xlsx file
$xlsx = CodexWorld\PhpXlsxGenerator::fromArray($excelData);
$xlsx->downloadAs($filename);
exit();

?>