<?php
if(isset($_SESSION['login']) == false) {
    header('location: ../index.php');
}
else {
    if(isset($_SESSION['login']) == true) {
        // Nếu đã đăng nhập
        $login = $_SESSION['login'][0];
        // Kiểm tra quyền có phải là teacher hay không
        if($login != "student") {
            // Nếu không phải là teacher
            echo "Bạn không đủ quyền truy cập trang này<br>";
            echo "<a href='../index.php'>Click để về lại trang chủ</a>";
            exit();
        }
    }
}
?>