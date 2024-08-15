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

$id = $_GET['id'] ?? '';

$score = new score();
$data = $score->all_byid($id);

$module = new module();
$info = $module->get($id);

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
<h3>Danh sách điểm của học phần</h3>

<!-- Tìm kiếm -->
<!-- <form action="class_index.php" method="get">
    <input type="text" name="name" id="" value="<?php echo $name ?>">
    <input type="submit" value="Tìm kiếm">
</form> -->

<!-- Hiển thị danh sách điểm -->
<h5>Mã đkhp: <?php echo $info[0]->module_id ?></h5>
<h5>Tên môn học: <?php echo $info[0]->subject_name ?></h5>
<h5>Số tín chỉ: <?php echo $info[0]->credit ?></h5>

<table border="1" id="table" class="table table-striped">
    <thead class="table-dark">
        <tr>
            <td style="width: 10%">MSSV</td>
            <td style="width: 20%">Tên sinh viên</td>
            <td style="width: 10%">KT1</td>
            <td style="width: 10%">KT2</td>
            <td style="width: 10%">Giữa kỳ</td>
            <td style="width: 10%">Cuối kỳ</td>
            <td style="width: 10%">DTB(10)</td>
            <td style="width: 10%">DTB(4)</td>
            <td style="width: 10%">Điểm chữ</td>
            <td style="width: 10%">Xếp loại</td>
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
                <td><?php echo $item->test1 ?></td>
                <td><?php echo $item->test2 ?></td>
                <td><?php echo $item->mid ?></td>
                <td><?php echo $item->final ?></td>

                <td><?php echo $item->avg10 ?></td>
                <td><?php echo $item->avg4 ?></td>
                <td><?php echo $item->avgchar ?></td>
                <td><?php echo $item->xeploai ?></td>
                <!-- <td>
                    <a href="score_update.php?id=<?php echo $item->id ?>">Sửa</a>
                </td> -->
            </tr>
        <?php
        }
        ?>
    </tbody>
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
</table>

</div>

<!---------------------------------------------------------------------------------------->
<?php include '../admin/includes/footer.php' ?>
<!---------------------------------------------------------------------------------------->