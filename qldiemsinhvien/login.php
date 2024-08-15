<?php
if(!isset($_SESSION)) session_start();

include 'config.php';
function loadClass($c) {
    include "class/$c.php";
}
spl_autoload_register("loadClass");

$user = new user();

// Kiểm tra session
if(isset($_SESSION['login'])) {
    header('location:' . $_SESSION['login'][0] . '/index.php');
}

// Lấy username & password đã nhập
$u = isset($_POST['username']) ? $_POST['username'] : '';
$p = isset($_POST['password']) ? $_POST['password'] : '';

// check login
if($u != '')
{
    $data = $user->check($u, $p);
    if(Count($data) > 0) {
        if($data[0]->role == "admin") {
            $info = ["admin", $data[0]->username, $data[0]->name]; //gán vô biến info gồm 3 tham số: vai trò, username, tên đầy đủ
            $_SESSION['login'] = $info; // Gán giá trị của info vào session
            //print_r($_SESSION['login']);
        }
        if($data[0]->role == "teacher") {
            $info = ["teacher", $data[0]->username, $data[0]->name];
            $_SESSION['login'] = $info;
            //print_r($_SESSION['login']);
        }
        if($data[0]->role == "student") {
            $info = ["student", $data[0]->username, $data[0]->name];
            $_SESSION['login'] = $info;
           // print_r($_SESSION['login']);
        }
        header('location:' . $info[0] . '/index.php');
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Quản lý điểm sinh viên</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <?php include 'includes/link.php'; ?>
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-form-title" style="background-image: url(style/images/bg-01.jpg);">
					<span class="login100-form-title-1">
						LOGIN
					</span>
				</div>
                <form class="login100-form validate-form" action="login.php" method="post">
                    <div class="wrap-input100 validate-input m-b-26" data-validate="Username is required">
                        <span class="label-input100">Username</span>
                        <input class="input100" type="text" name="username" placeholder="" required>
                        <span class="focus-input100"></span>
                    </div>
                    <div class="wrap-input100 validate-input m-b-18" data-validate = "Password is required">
                        <span class="label-input100">Mật khẩu</span>
                        <input class="input100" type="password" name="password" placeholder="" required>
                        <span class="focus-input100"></span>
                    </div>
                    <div class="container-login100-form-btn" style="margin-bottom: 15px;">
                        <button class="login100-form-btn">
                            Đăng nhập
                        </button>
                    </div> 
                    <a href="forgot_password.php" class="">Quên mật khẩu??</a>
                </form>
            </div>
		</div>
	</div>
	
</body>
</html>

<?php
include 'includes/script.php';
?>