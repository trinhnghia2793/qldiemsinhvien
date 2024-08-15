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



// Lấy thông tin get id từ link bấm
$id = $_GET['id'] ?? '';
// Lấy cái id --> lấy thông tin
$user = new user();
$user_info = $user->get($id) ?? '';

// Xử lý sau khi nhập 
$username = $_POST['username'] ?? '';

$err1 = '';
$err2 = '';

if($username != '') {
    $n = $user->change_password($username);
    if($n['flag'] == true) {
        if($n[1] == true) {
            $err1 = 'Mật khẩu cũ không đúng.';
        }
        if($n[2] == true) {
            $err2 = 'Mật khẩu mới chưa trùng khớp.';
        }
    }
    if($n == 1) {
        ?>
        <script>
            alert('Đã sửa thông tin');
            window.location = 'user_info.php';
        </script>
        <?php
    }
}

?>

<!---------------------------------------------------------------------------------------->
<?php include '../teacher/includes/header.php' ?>
<body class="g-sidenav-show  bg-gray-200">
<?php include '../teacher/includes/aside.php' ?>
<!-- main -->
<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    <!-- Navbar_top & content -->
<?php include '../teacher/includes/nav_top.php' ?>

<!---------------------------------------------------------------------------------------->

<div class="container-fluid py-1 px-3">
<h3>Đổi mật khẩu</h3>

<form action="change_password.php" method="post">
        <table>
            <input type="hidden" name="username" value="<?php echo $_SESSION['login'][1]?>">
            <tr>
                <td>Mật khẩu cũ</td>
                <td>
                    <input type="password" name="password" id="" required>
                </td>
                <td>
                    <?php echo $err1 ?>
                </td>
            </tr>
            <tr>
                <td>Mật khẩu mới</td>
                <td>
                    <input type="password" name="password1" id="" required>
                </td>
                <td>
                    <?php echo $err2 ?>
                </td>
            </tr>
            <tr>
                <td>Nhập lại mật khẩu mới</td>
                <td>
                    <input type="password" name="password2" id="" required>
                </td>
            </tr>
            <tr>
                <td colspan="3">
                    <input type="submit" value="Sửa">
                </td>
            </tr>
        </table>    
    </form>
    
</div>

<!---------------------------------------------------------------------------------------->
<?php include '../admin/includes/footer.php' ?>
<!---------------------------------------------------------------------------------------->