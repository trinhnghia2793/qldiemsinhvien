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

if($username != '') {
    $n = $user->change_email($username);
    if($n == -1) {
        ?>
        <script>
            alert('Email này đã được sử dụng!');
            window.history.go(-1); // go(-1)
        </script>
        <?php
    }
    // print_r($n);
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
<?php include '../student/includes/header.php' ?>
<body class="g-sidenav-show  bg-gray-200">
<?php include '../student/includes/aside.php' ?>
<!-- main -->
<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    <!-- Navbar_top & content -->
<?php include '../student/includes/nav_top.php' ?>

<!---------------------------------------------------------------------------------------->

<div class="container-fluid py-1 px-3">
<h3>Chỉnh sửa email</h3>

<form action="change_email.php" method="post">
        <table>
            <input type="hidden" name="username" value="<?php echo $user_info[0]->username?>">
            <tr>
                <td>Email mới</td>
                <td>
                    <input type="email" name="email" id="" value="<?php echo $user_info[0]->email ?>" required>
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