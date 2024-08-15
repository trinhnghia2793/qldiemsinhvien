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

$se = $_GET["semester_id"] ?? '';

$semester = new semester();
$semester_data = $semester->all();

$module = new module();
if($se != '') {
    $data = $module->all_bysem_teacher($se, $_SESSION['login'][1]);
}
else {
    $data = $module->all_byteacher($_SESSION['login'][1]);
}
?>

<!---------------------------------------------------------------------------------------->
<?php include '../teacher/includes/header.php' ?>
<body class="g-sidenav-show  bg-gray-200">
<?php include '../teacher/includes/aside.php' ?>
<!-- main -->
<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    <!-- Navbar_top & content -->
<?php include '../teacher/includes/nav_top.php' ?>

<!-- Chưa sửa -->
<!-- <a href="class_add.php">Thêm lớp học phần</a> -->

<!---------------------------------------------------------------------------------------->
<div class="container-fluid py-1 px-3">
    <h3>Danh sách lớp học phần</h3>

    <!-- Hiển thị theo học kỳ -->
    <div style="width: 40%">
        <form action="module_index.php" method="get">
            <table class="table">
                <tr>
                    <td>
                        <select class="form-select" name="semester_id" id="">
                            <option value="">Chọn học kỳ</option>
                            <?php
                            foreach($semester_data as $item) {
                                if($se == $item->semester_id) {
                                    ?>
                                    <option value="<?php echo $item->semester_id ?>" selected><?php echo $item->semester_name ?></option>
                                    <?php
                                }
                                else {
                                    ?>
                                    <option value="<?php echo $item->semester_id ?>"><?php echo $item->semester_name ?></option>
                                    <?php
                                }
                            }
                            ?>
                        </select> 
                    </td>
                    <td><input type="submit" class="btn btn-primary" value="Tìm"></td>
                </tr>        
            </table>  
        </form>
    </div>

    <!-- Hiển thị danh sách lớp học phần -->
    <table border="1" id="table" class="table table-striped">
        <thead class="table-dark">
            <tr>
                <td style="width: 10%">Mã LHP</td>
                <td style="width: 40%">Tên môn học</td>
                <td style="width: 20%">Lớp học</td>
                <td style="width: 10%">Số tín chỉ</td>
                <td style="width: 10%">Học kỳ</td>
                <td style="width: 5%"></td>
                <td style="width: 5%"></td>
            </tr>
        </thead>
        <tbody>
        <?php
            foreach($data as $item) {
                ?>
                <tr>
                    <td><?php echo $item->module_id ?></td>
                    <td><?php echo $item->subject_name ?></td>
                    <td><?php echo $item->class_name ?></td>
                    <td><?php echo $item->credit ?></td>
                    <td><?php echo $item->semester_name ?></td>
                    <td>
                        <a class="btn btn-primary" href="student_index_byid.php?id=<?php echo $item->module_id ?>">Xem dssv</a>
                    </td>
                    <td>
                        <a class="btn btn-primary" href="score_index_byid.php?id=<?php echo $item->module_id ?>">Xem ds điểm</a>
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
                        { "orderable": false, "targets": [5, 6] }
                    ]
                }
            );
        });
    </script>
</div>

<!---------------------------------------------------------------------------------------->
<?php include '../teacher/includes/footer.php' ?>
<!---------------------------------------------------------------------------------------->