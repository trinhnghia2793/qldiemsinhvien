<?php
if(isset($_SESSION['login']) == false) {
    header('location: ../index.php');
}
else {
    if(isset($_SESSION['login']) == true) {
        // Nếu đã đăng nhập
        $login = $_SESSION['login'][0];
        // Kiểm tra quyền có phải là admin hay không
        if($login != "admin") {
            // Nếu không phải là admin
            echo "Bạn không đủ quyền truy cập trang này<br>";
            echo "<a href='../index.php'>Click để về lại trang chủ</a>";
            exit();
        }
    }
}
?>