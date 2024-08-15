<?php
if(!isset($_SESSION)) {
    session_start();
}
include 'permission.php';

include '../config.php';
function loadClass($c) {
    include "../class/$c.php";
}
spl_autoload_register("loadClass");

$class = new classs();
$id = $_GET['class_id'] ? : '';
$n = $class->delete($id);

if($n == -1) {
    ?>
    <script>
        alert('Lỗi ràng buộc khóa ngoại');
        window.location = 'class_index.php';
    </script>
    <?php
}

if($n == 0) {
    ?>
    <script>
        alert('Không xóa được');
        window.location = 'class_index.php';
    </script>
    <?php
}

if($n == 1) {
    ?>
    <script>
        alert('Đã xóa lớp học');
        window.location = 'class_index.php';
    </script>
    <?php
}
