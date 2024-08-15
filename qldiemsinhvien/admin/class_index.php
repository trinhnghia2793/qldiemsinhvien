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

// lấy để tìm kiếm
$name = $_GET['name'] ?? '';

// khai báo & lấy danh sách
$class = new classs();
$data = $class->searchAll($name);
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
    <h3>Danh sách lớp học</h3>

    <a href="class_add.php" class="btn btn-secondary">Thêm lớp học</a>

    <!-- Tìm kiếm -->
    <!-- <form action="class_index.php" method="get">
        <input type="text" name="name" id="" value="<?php echo $name ?>">
        <input type="submit" value="Tìm kiếm">
    </form> -->

    <!-- Hiển thị danh sách lớp -->
    <table border="1" id="table" class="table table-striped">
        <thead class="table-dark">
            <tr>
                <td style="width: 10%">Mã lớp</td>
                <td style="width: 60%">Tên lớp</td>
                <td style="width: 10%"></td>
                <td style="width: 10%"></td>
                <td style="width: 10%"></td>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach($data as $item) {
                ?>
                <tr>
                    <td><?php echo $item->class_id ?></td>
                    <td><?php echo $item->class_name ?></td>
                    <td>
                        <a class="btn btn-secondary" href="student_index_byclass.php?class_id=<?php echo $item->class_id ?>">Xem DSSV</a>
                    </td>
                    <td>
                        <a class="btn btn-secondary" href="class_delete.php?class_id=<?php echo $item->class_id ?>">Xóa</a>
                    </td>
                    <td>
                        <a class="btn btn-secondary" href="class_update.php?class_id=<?php echo $item->class_id ?>">Sửa</a>
                    </td>
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
                        { "orderable": false, "targets": [2, 3, 4] }
                    ]
                }
            );
        });
    </script>
</div>

<!---------------------------------------------------------------------------------------->
<?php include '../admin/includes/footer.php' ?>
<!---------------------------------------------------------------------------------------->