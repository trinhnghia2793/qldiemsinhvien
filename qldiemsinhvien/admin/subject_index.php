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
$subject = new subject();
$data = $subject->all();
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
    <h3>Danh sách môn học</h3>

    <!-- <a href="subject_add.php">Thêm môn học</a> -->

    <!-- Tìm kiếm -->
    <!-- <form action="subject_index.php" method="get">
        <input type="text" name="name" id="" value="<?php echo $name ?>">
        <input type="submit" value="Tìm kiếm">
    </form> -->

    <!-- Hiển thị danh sách môn học -->
    <table border="1" id="table" class="table table-striped">
        <thead class="table-dark">
            <tr>
                <td style="width: 10%">Mã môn học</td>
                <td style="width: 50%">Tên môn học</td>
                <td style="width: 20%">Khoa</td>
                <td style="width: 20%">Số tín chỉ</td>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach($data as $item) {
                ?>
                <tr>
                    <td><?php echo $item->subject_id ?></td>
                    <td><?php echo $item->subject_name ?></td>
                    <td><?php echo $item->major_name ?></td>
                    <td><?php echo $item->credit ?></td>
                    <!-- <td>
                        <a href="subject_delete.php?class_id=<?php echo $item->subject_id ?>">Xóa</a>
                    </td>
                    <td>
                        <a href="subject_update.php?class_id=<?php echo $item->subject_id ?>">Sửa</a>
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