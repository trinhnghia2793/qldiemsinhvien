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

// Lấy thông tin form
$c_name = $_POST['class_name'] ?? '';

// Xử lý sau khi nhập
if($c_name != '') {
    $n = $class->add();
    if($n == -1) {
        ?>
        <script>
            alert('Đã có lớp học có tên này!');
            window.history.go(-1); // go(-1)
        </script>
        <?php
    }
    if($n == 1) {
        ?>
        <script>
            alert('Đã thêm lớp học');
            window.location = 'class_index.php';
        </script>
        <?php
    }
}

?>

<!---------------------------------------------------------------------------------------->
<?php include '../admin/includes/header.php' ?>
<body class="g-sidenav-show  bg-gray-200">
<?php include '../admin/includes/aside.php' ?>
<!-- main -->
<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    <!-- Navbar_top & content -->
<?php include '../admin/includes/nav_top.php' ?>

<!---------------------------------------------------------------------------------------->
<div class="container-fluid py-1 px-3">
<h3>Thêm một lớp học</h3>

<form action="class_add.php" method="post">
        <table>
            <tr>
                <td>Tên lớp học</td>
                <td>
                    <input type="text" name="class_name" id="" required>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <input type="submit" value="Thêm mới">
                </td>
            </tr>
        </table>    
    </form>

</div>


<!---------------------------------------------------------------------------------------->
<?php include '../admin/includes/footer.php' ?>
<!---------------------------------------------------------------------------------------->
