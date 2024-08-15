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

$user = new user();
$data = $user->get($_SESSION['login'][1]);
?>

<!---------------------------------------------------------------------------------------->
<?php include '../student/includes/header.php' ?>
<body class="g-sidenav-show  bg-gray-200">
<?php include '../student/includes/aside.php' ?>
<!-- main -->
<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    <!-- Navbar_top & content -->
<?php include '../student/includes/nav_top.php' ?>

<!---------------------------------------------------------------------------------------->
<div class="container-fluid py-1 px-3">
    <h3>Thông tin sinh viên</h3>
    
    <div style="width: 50%">
        <table class="table table-striped">
            <tr>
                <td style="width: 40%">Mã sinh viên</td>
                <td><?php echo $data[0]->username ?></td>
                <td></td>
            </tr>
            <tr>
                <td style="width: 40%">Họ và tên</td>
                <td><?php echo $data[0]->name ?></td>
                <td></td>
            </tr>
            <tr>
                <td style="width: 40%">Giới tính</td>
                <td><?php echo $data[0]->gender ?></td>
                <td></td>
            </tr>
            <tr>
                <td style="width: 40%">Ngày sinh</td>
                <td><?php echo $data[0]->dateofbirth ?></td>
                <td></td>
            </tr>
            <tr>
                <td style="width: 40%">Email</td>
                <td><?php echo $data[0]->email ?></td>
                <td>
                    <a class="btn btn-success btn-sm" href="change_email.php?id=<?php echo $data[0]->username ?>">Đổi Email</a>
                </td>
            </tr>
            <tr>
                <td style="width: 40%">Mật khẩu</td>
                <td>*******</td>
                <td>
                    <a class="btn btn-success btn-sm" href="change_password.php?id=<?php echo $data[0]->username ?>">Đổi mật khẩu</a>
                </td>
            </tr>
        </table>
    </div>
      
</div>

<!---------------------------------------------------------------------------------------->
<?php include '../teacher/includes/footer.php' ?>
<!---------------------------------------------------------------------------------------->