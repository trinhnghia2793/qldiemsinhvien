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

$id = $_GET['id'] ?? '';

$student = new student();
$data = $student->all_bymoduleteacher($id, $_SESSION['login'][1]);

$module = new module();
$info = $module->get($id);
?>

<!---------------------------------------------------------------------------------------->
<?php include '../teacher/includes/header.php' ?>
<body class="g-sidenav-show  bg-gray-200">
<?php include '../teacher/includes/aside.php' ?>
<!-- main -->
<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    <!-- Navbar_top & content -->
<?php include '../teacher/includes/nav_top.php' ?>

<!---------------------------------------------------------------------------------------->

<div class="container-fluid py-1 px-3">
    <h3>Danh sách sinh viên</h3>
    <h5>Mã học phần: <?php echo $info[0]->module_id ?></h5>
    <h5>Tên môn học: <?php echo $info[0]->subject_name ?></h5>
    <h5>Lớp học: <?php echo $info[0]->class_name ?></h5>
    <h5>Số tín chỉ: <?php echo $info[0]->credit ?></h5>

    <!-- Hiển thị danh sách sinh viên -->
    <table border="1" id="table" class="table table-striped">
        <thead class="table-dark">
            <tr>
                <td style="width: 10%">Mã sinh viên</td>
                <td style="width: 50%">Tên sinh viên</td>
            </tr>
        </thead>
        <tbody>
            <?php
                foreach($data as $item) {
                    ?>
                    <tr>
                        <td><?php echo $item->student_id ?></td>
                        <td><?php echo $item->name ?></td>
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
<?php include '../teacher/includes/footer.php' ?>
<!---------------------------------------------------------------------------------------->