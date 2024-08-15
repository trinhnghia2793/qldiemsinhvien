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

$register = new register();
$id = $_GET['register_id'] ? : '';
$n = $register->delete($id);

if($n == -1) {
    ?>
    <script>
        alert('Lỗi ràng buộc khóa ngoại');
        window.location = 'register_index.php';
    </script>
    <?php
}

if($n == 0) {
    ?>
    <script>
        alert('Không xóa được');
        window.location = 'register_index.php';
    </script>
    <?php
}

if($n == 1) {
    ?>
    <script>
        alert('Đã xóa');
        window.location = 'register_index.php';
    </script>
    <?php
}
