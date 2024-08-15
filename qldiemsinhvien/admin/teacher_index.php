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

// $name = $_GET['name'] ?? '';
$teacher = new teacher();
$data = $teacher->all();
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
    <h3>Danh sách giảng viên</h3>

    <!-- Chưa sửa -->
    <!-- <a href="class_add.php">Thêm lớp học</a> -->

    <!-- Tìm kiếm (chưa sửa) -->
    <!-- <form action="class_index.php" method="get">
        <input type="text" name="name" id="" value="<?php echo $name ?>">
        <input type="submit" value="Tìm kiếm">
    </form> -->

    <!-- Hiển thị danh sách giảng viên -->
    <table border="1" id="table" class="table table-striped">
        <thead class="table-dark">
            <tr>
                <td style="width: 10%">Mã giảng viên</td>
                <td style="width: 30%">Tên giảng viên</td>
                <td style="width: 10%">Giới tính</td>
                <td style="width: 10%">Ngày sinh</td>
                <td style="width: 20%">Khoa</td>
                <td style="width: 20%">Email</td>
            </tr>
        </thead>
        <tbody>
        <?php
            foreach($data as $item) {
                ?>
                <tr>
                    <td><?php echo $item->teacher_id ?></td>
                    <td><?php echo $item->name ?></td>
                    <td><?php echo $item->gender ?></td>
                    <td><?php echo $item->dateofbirth ?></td>
                    <td><?php echo $item->major_name ?></td>
                    <td><?php echo $item->email ?></td>
                    <!-- <td>
                        <a href="class_delete.php?class_id=<?php echo $item->class_id ?>">Xóa</a>
                    </td>
                    <td>
                        <a href="class_update.php?class_id=<?php echo $item->class_id ?>">Sửa</a>
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