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

// Lấy thông tin get id từ link bấm
$id = $_GET['class_id'] ?? '';
// Lấy cái id --> lấy thông tin class
$class_info = $class->get($id) ?? '';
$c_id = $class_info[0]->class_id;
$c_name = $class_info[0]->class_name;

// Xử lý sau khi nhập 
$class_id = $_POST['class_id'] ?? ''; //ok
$class_name = $_POST['class_name'] ?? '';

if($class_id != '') {
    $n = $class->update($class_id);
    if($n == -1) {
        ?>
        <script>
            alert('Đã có lớp học có tên này!');
            window.history.go(-1); // go(-1)
        </script>
        <?php
    }
    // print_r($n);
    if($n == 1) {
        ?>
        <script>
            alert('Đã sửa thông tin lớp học');
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
<h3>Sửa một lớp học</h3>

<form action="class_update.php" method="post">
        <table>
            <input type="hidden" name="class_id" value="<?php echo $c_id?>">
            <tr>
                <td>Tên lớp học</td>
                <td>
                    <input type="text" name="class_name" id="" value="<?php echo $c_name ?>" required>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <input type="submit" value="Sửa">
                </td>
            </tr>
        </table>    
    </form>
    
</div>

<!---------------------------------------------------------------------------------------->
<?php include '../admin/includes/footer.php' ?>
<!---------------------------------------------------------------------------------------->