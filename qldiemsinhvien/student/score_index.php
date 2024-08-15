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

$semester = new semester();
$se_info = $semester->all();

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
    <h3>Danh sách điểm</h3>

    <?php
    $tl_tc = 0;
    $tl_score10 = 0;
    $tl_score4 = 0;

    foreach($se_info as $item1) {
        ?>
        <!-- Hiển thị danh sách điểm theo từng học kỳ -->
        <h5 style="margin-top: 30px"><?php echo $item1->semester_name ?></h5>  
        <table border="1" id="table" class="table table-striped">
            <thead class="table-dark">
                <tr>
                    <td style="width: 30%">Môn học</td>
                    <td style="width: auto">Lớp học</td>
                    <td style="width: auto">Số tín chỉ</td>
                    <td style="width: auto">KT1</td>
                    <td style="width: auto">KT2</td>
                    <td style="width: auto">Giữa kỳ</td>
                    <td style="width: auto">Cuối kỳ</td>
                    <td style="width: auto">ĐTB</td>
                    <td style="width: auto">ĐTB (Hệ 4)</td>
                    <td style="width: auto">Điểm chữ</td>
                    <td style="width: auto">Xếp loại</td>
                </tr>
            </thead>
            <tbody>
                <?php
                $tc = 0;
                $score10 = 0;
                $score4 = 0;

                $score = new score();
                $data = $score->all_bysem_student($_SESSION['login'][1], $item1->semester_id);
                foreach($data as $item) {
                    ?>
                    <tr>
                        <td><?php echo $item->subject_name ?></td>
                        <td><?php echo $item->class_name ?></td>
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
                    if($item->final != '') {
                        $tc += $item->credit;
                        $score10 += $item->avg10 * $item->credit;
                        $score4 += $item->avg4 * $item->credit;

                        $tl_tc += $item->credit;
                        $tl_score10 += $item->avg10 * $item->credit;
                        $tl_score4 += $item->avg4 * $item->credit;
                    }
                }  
                ?>
            </tbody>
        </table>

        <div style="margin-top: 10px; width: 50%">
            <table class="table table-striped">
                <tr>
                    <td>Điểm trung bình (Hệ 10): </td>
                    <td>
                        <?php
                        if($tc != 0)
                            echo number_format($score10 / $tc, 2);
                        else
                            echo "0.00";
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>Điểm trung bình (Hệ 4): </td>
                    <td>
                        <?php
                        if($tc != 0)
                            echo number_format($score4 / $tc, 2);
                        else
                            echo "0.00";
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>Tổng số tín chỉ: </td>
                    <td>
                        <?php echo $tc ?>
                    </td>
                </tr>
            </table>
        </div>
        <?php
    }
    
    ?>

    <h5 style="margin-top: 30px">Chung</h5>
    <div style="margin-top: 10px; width: 100%">
        <table class="table table-striped">
            <tr>
                <td>Điểm trung bình tích lũy (Hệ 10): </td>
                <td>
                    <?php
                    if($tl_tc != 0)
                        echo number_format($tl_score10 / $tl_tc, 2);
                    else
                        echo "0.00";
                    ?>
                </td>
            </tr>
            <tr>
                <td>Điểm trung bình tích lũy (Hệ 4): </td>
                <td>
                    <?php
                    if($tl_tc != 0)
                        echo number_format($tl_score4 / $tl_tc, 2);
                    else
                        echo "0.00";
                    ?>
                </td>
            </tr>
            <tr>
                <td>Tổng số tín chỉ tích lũy: </td>
                <td>
                    <?php echo $tl_tc ?>
                </td>
            </tr>
        </table>
    </div>
</div>

<!---------------------------------------------------------------------------------------->
<?php include '../student/includes/footer.php' ?>
<!---------------------------------------------------------------------------------------->