<?php include "includes/header.php" ?>

<?php
    if(!isset($_SESSION)) {
        session_start();
    }
    // Kiểm tra đăng nhập hay chưa
    if(!isset($_SESSION['login'])) {
        header('location: login.php');
    }
    else {
        $login = $_SESSION['login'][0];
        header('location:' . $login . '/index.php');
    }
?>
Trang chủ

<?php include "includes/footer.php" ?>