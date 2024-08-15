<?php
 if(!isset($_SESSION)) {
    session_start();
}

?>

<?php include 'permission.php';?>
<?php include '../admin/includes/header.php' ?>
<body class="g-sidenav-show  bg-gray-200">
<?php include '../admin/includes/aside.php' ?>
<!-- main -->
<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
<!-- Navbar_top & content -->
<?php include '../admin/includes/nav_top.php' ?>
<!-- content % footer -->
<?php include '../admin/includes/footer.php' ?>