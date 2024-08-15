<?php
if (!isset($_SESSION)) {
    session_start();
}
include 'permission.php';

include '../config.php';
function loadClass($c)
{
    include "../class/$c.php";
}
spl_autoload_register("loadClass");

$score = new score();
$data = $score->all_byteacher($_SESSION['login'][1]);

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
<!-- Hiển thị danh sách điểm -->
<div class="container-fluid py-1 px-3">
    <h3>Danh sách điểm</h3>
    <table border="1" id="table" class="table table-striped">
        <thead class="table-dark">
            <tr>
                <td style="width: 10%">MSSV</td>
                <td style="width: 25%">Tên sinh viên</td>
                <td style="width: 20%">Tên môn học</td>
                <td style="width: 5%">Số tín chỉ</td>
                <td style="width: 10%">KT1</td>
                <td style="width: 10%">KT2</td>
                <td style="width: 10%">Giữa kỳ</td>
                <td style="width: 10%">Cuối kỳ</td>
                <td style="width: 10%">DTB(10)</td>
                <td style="width: 10%">DTB(4)</td>
                <td style="width: 10%">Điểm chữ</td>
                <td style="width: 10%">Xêp loại</td>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($data as $item) {
                // $diem1 = $item->test1 !== null ? number_format($item->test1, 2) : '';
                // $diem2 = $item->test2 !== null ? number_format($item->test2, 2) : '';
                // $diemmid = $item->mid !== null ? number_format($item->mid, 2) : '';
                // $diemfinal = $item->final !== null ? number_format($item->final, 2) : '' ;    
            ?>
                <tr>
                    <td><?php echo $item->student_id ?></td>
                    <td><?php echo $item->name ?></td>
                    <td><?php echo $item->subject_name ?></td>
                    <td><?php echo $item->credit ?></td>
                    <td><?php echo $item->test1 != '' ? number_format($item->test1, 2) : '' ?></td>
                    <td><?php echo $item->test2 != '' ? number_format($item->test2, 2) : '' ?></td>
                    <td><?php echo $item->mid != '' ? number_format($item->mid, 2) : '' ?></td>
                    <td><?php echo $item->final != '' ? number_format($item->final, 2) : '' ?></td>
                    <td><?php echo $item->avg10 != '' ? number_format($item->avg10, 2) : '' ?></td>
                    <td><?php echo $item->avg4 != '' ? number_format($item->avg4, 2) : '' ?></td>
                    <td><?php echo $item->avgchar ?></td>
                    <td><?php echo $item->xeploai ?></td>
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