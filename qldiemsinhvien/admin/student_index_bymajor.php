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

$major_id = $_GET['major_id'] ?? '';

$major = new major();
$info = $major->get($major_id);

$student = new student();
$data = $student->allByMajor($major_id);
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
    <h3>Danh sách sinh viên khoa <?php echo $info[0]->major_name ?> </h3>

    <!-- Hiển thị danh sách sinh viên theo khoa -->
    <table border="1" id="table" class="table table-striped">
        <thead class="table-dark">
            <tr>
                <td style="width: 10%">Mã sinh viên</td>
                <td style="width: 30%">Tên sinh viên</td>
                <td style="width: 10%">Giới tính</td>
                <td style="width: 15%">Ngày sinh</td>
                <td style="width: 20%">Email</td>
                <td style="width: 15%">Lớp</td>
            </tr>
        </thead>
        <tbody>
            <?php
                foreach($data as $item) {
                    ?>
                    <tr>
                        <td><?php echo $item->student_id ?></td>
                        <td><?php echo $item->name ?></td>
                        <td><?php echo $item->gender ?></td>
                        <td><?php echo $item->dateofbirth ?></td>
                        <td><?php echo $item->email ?></td>
                        <td><?php echo $item->class_name ?></td>
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