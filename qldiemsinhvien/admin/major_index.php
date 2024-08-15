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

$major = new major();
$data = $major->all();
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
    <h3>Danh sách khoa</h3>

    <!-- Hiển thị danh sách khoa -->
    <table border="1" id="table" class="table table-striped">
        <thead class="table-dark">
            <tr>
                <td style="width: 10%">Mã khoa</td>
                <td style="width: 50%">Tên khoa</td>
                <td style="width: 20%"></td>
                <td style="width: 20%"></td>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach($data as $item) {
                ?>
                <tr>
                    <td><?php echo $item->major_id ?></td>
                    <td><?php echo $item->major_name ?></td>
                    <td>
                        <a class="btn btn-secondary" href="teacher_index_bymajor.php?major_id=<?php echo $item->major_id ?>">Xem DS giảng viên</a>
                    </td>
                    <td>
                        <a class="btn btn-secondary" href="student_index_bymajor.php?major_id=<?php echo $item->major_id ?>">Xem DS sinh viên</a>
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
                        
                    ]
                }
            );
        });
    </script>
</div>

<!---------------------------------------------------------------------------------------->
<?php include '../admin/includes/footer.php' ?>
<!---------------------------------------------------------------------------------------->