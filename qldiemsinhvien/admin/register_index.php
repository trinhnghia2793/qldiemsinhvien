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

$register = new register();
$data = $register->all();
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
    <h3>Danh sách đăng ký học phần</h3>

    <!-- Chưa sửa -->
    <!-- <a href="register_add.php">Thêm đăng ký học phần</a> -->

    <!-- Hiển thị danh sách đăng ký học phần -->
    <table border="1" id="table" class="table table-striped">
        <thead class="table-dark">
            <tr>
                <td style="width: 10%">Mã lớp hp</td>
                <td style="width: 10%">MSSV</td>
                <td style="width: 20%">Tên sinh viên</td>
                <td style="width: 10%">Mã LHP</td>
                <td style="width: 20%">Tên môn học</td>
                <td style="width: 15%">Tên lớp học</td>
                <td style="width: 10%">Học kỳ</td>
                <td style="width: 5%">Số tín chỉ</td>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach($data as $item) {
                ?>
                <tr>
                    <td><?php echo $item->register_id ?></td>
                    <td><?php echo $item->student_id ?></td>
                    <td><?php echo $item->name ?></td>
                    <td><?php echo $item->module_id ?></td>
                    <td><?php echo $item->subject_name?></td>
                    <td><?php echo $item->class_name ?></td>
                    <td><?php echo $item->semester_name ?></td>
                    <td><?php echo $item->credit ?></td>
                    <!-- <td>
                        <a href="register_delete.php?register_id=<?php echo $item->register_id ?>">Xóa</a>
                    </td> -->
                </tr>
                <?php
            }
            ?>
        </tbody>
    </table>

    <script>
        $(document).ready(function() {
            $('#table').DataTable(
                {
                    "columnDefs": [
                        
                    ]
                }
            );
        });
    </script>
</div>


<!---------------------------------------------------------------------------------------->
<?php include '../admin/includes/footer.php' ?>
<!---------------------------------------------------------------------------------------->