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

$register = new register();
if($se != '') {
    $data = $register->all_bysem_student($_SESSION['login'][1], $se);
}
else {
    $data = $register->all_bystudent($_SESSION['login'][1]);
}
?>

<!---------------------------------------------------------------------------------------->
<?php include '../student/includes/header.php' ?>
<body class="g-sidenav-show  bg-gray-200">
<?php include '../student/includes/aside.php' ?>
<!-- main -->
<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    <!-- Navbar_top & content -->
<?php include '../student/includes/nav_top.php' ?>

<!---------------------------------------------------------------------------------------->
<div class="container-fluid py-1 px-3">
    <h3>Danh sách đăng ký học phần</h3>

    <!-- Hiển thị theo học kỳ -->
    <div style="width: 40%">
        <form action="register_index.php" method="get">
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
                    <td><input type="submit" class="btn btn-success" value="Tìm"></td>
                </tr>        
            </table>  
        </form>
    </div>

    <!-- Hiển thị danh sách đăng ký học phần -->
    <table border="1" id="table" class="table table-striped">
        <thead class="table-dark">
            <tr>
                <td style="width: 10%">Mã lớp hp</td>
                <td style="width: 30%">Tên môn học</td>
                <td style="width: 20%">Tên lớp học</td>
                <td style="width: 10%">Số tín chỉ</td>
                <td style="width: 30%">Giáo viên dạy</td>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach($data as $item) {
                ?>
                <tr>
                    <td><?php echo $item->module_id ?></td>
                    <td><?php echo $item->subject_name ?></td>
                    <td><?php echo $item->class_name?></td>
                    <td><?php echo $item->credit ?></td>
                    <td><?php echo $item->name ?></td>
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
<?php include '../student/includes/footer.php' ?>
<!---------------------------------------------------------------------------------------->