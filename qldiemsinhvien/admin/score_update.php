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

$score = new score();

// Lấy thông tin get id từ link bấm
$sc_id = $_GET['id'] ?? '';
// Lấy cái id --> lấy thông tin class
$score_info = $score->get($sc_id) ?? '';
$sc_id = $score_info[0]->id;
$sc_test1 = $score_info[0]->test1;
$sc_test2 = $score_info[0]->test2;
$sc_mid = $score_info[0]->mid;
$sc_final = $score_info[0]->final;

// Xử lý sau khi nhập 
$id = $_POST['id'] ?? '';
$test1 = $_POST['test1'] ?? '';
$test2 = $_POST['test2'] ?? '';
$mid = $_POST['mid'] ?? '';
$final = $_POST['final'] ?? '';

if($id != '') {
    $n = $score->update($id, $test1, $test2, $mid, $final);
    if($n == -1) {
        ?>
        <script>
            alert('Lỗi!');
            window.history.go(-1); // go(-1)
        </script>
        <?php
    }
    print_r($n);
    if($n == 1) {
        ?>
        <script>
            alert('Đã sửa thông tin điểm');
            window.history.go(-2);
            // window.location = 'score_index.php';
        </script>
        <?php
    }
}

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
<h3>Sửa điểm</h3>
<form action="score_update.php" method="post">
        <table>
            <input type="hidden" name="id" value="<?php echo $sc_id?>">
            <tr>
                <td>Điểm KT lần 1</td>
                <td>
                    <input type="number" step="0.05" name="test1" id="" value="<?php echo $sc_test1 ?>" required>
                </td>
            </tr>
            <tr>
                <td>Điểm KT lần 2</td>
                <td>
                    <input type="number" step="0.05" name="test2" id="" value="<?php echo $sc_test2 ?>" required>
                </td>
            </tr>
            <tr>
                <td>Điểm giữa kỳ</td>
                <td>
                    <input type="number" step="0.05" name="mid" id="" value="<?php echo $sc_mid ?>" required>
                </td>
            </tr>
            <tr>
                <td>Điểm cuối kỳ</td>
                <td>
                    <input type="number" step="0.05" name="final" id="" value="<?php echo $sc_final ?>" required>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <input type="submit" value="Sửa">
                </td>
            </tr>
        </table>    
    </form>

</div>

<!---------------------------------------------------------------------------------------->
<?php include '../admin/includes/footer.php' ?>
<!---------------------------------------------------------------------------------------->
