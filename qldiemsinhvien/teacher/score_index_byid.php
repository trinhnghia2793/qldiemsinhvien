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
$data = $score->all_byteacher_id($_SESSION['login'][1], $id);

$module = new module();
$info = $module->get($id);

$start = $info[0]->start;
$end = $info[0]->end;
$current = date("Y-m-d");

// Get status message
if(!empty($_GET['status'])) {
    switch($_GET['status']) {
        case 'succ':
            $statusType = 'alert-success';
            $statusMsg = 'Imported successfully.';
            break;
        case 'err':
            $statusType = 'alert-danger';
            $statusMsg = 'Something went wrong, please try again.';
            break;
        case 'invalid_file':
            $statusType = 'alert-danger';
            $statusMsg = 'Invalid Excel file.';
            break;
        default:
            $statusType = '';
            $statusMsg = '';
    }
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

<!---------------------------------------------------------------------------------------->

<div class="container-fluid py-1 px-3">
    <?php
    if(!empty($statusMsg)) {
        ?>
        <div class="alert <?php echo $statusType; ?>"><?php echo $statusMsg; ?></div>
        <?php
    }
    ?>

    <h3>Danh sách điểm của học phần</h3>

    <!-- Hiển thị danh sách điểm -->
    <h5>Mã đkhp: <?php echo $info[0]->module_id ?></h5>
    <h5>Tên môn học: <?php echo $info[0]->subject_name ?></h5>
    <h5>Số tín chỉ: <?php echo $info[0]->credit ?></h5>

    <a class="btn btn-primary" href="export.php/?id=<?php echo $info[0]->module_id?>">Export</a>
    <a class="btn btn-primary" href="javascript:void(0);" onclick="formToggle('impForm', 'noti');">Import</a>

    <div id="impForm" style="display: none">
        <form action="import.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $id ?>">
            <input type="file" class="form-control" name="file" id="fileInput">
            <input type="submit" class="btn btn-primary" name="importSubmit" value="Import">
        </form>
    </div>
    <div id="noti" style="display: none">
        <h6>Thời gian hiện tại không cho phép nhập điểm.</h6>
    </div>

    <table border="1" id="table" class="table table-striped">
        <thead class="table-dark">
            <tr>
                <td style="width: 20%">Mã sinh viên</td>
                <td style="width: 30%">Tên sinh viên</td>
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
            ?>
                <tr>
                    <td><?php echo $item->username ?></td>
                    <td><?php echo $item->name ?></td>
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

    <!-- Hiển thị form upload file -->
    <script>
        function formToggle(ID1, ID2) {
            var s = "<?php echo $start; ?>"
            var e = "<?php echo $end; ?>"
            var c = "<?php echo $current; ?>"

            var start = new Date(s);
            var end = new Date(e);
            var current = new Date(c);

            if(current >= start && current <= end) 
                var show = ID1;
            else
                var show = ID2;

            var element = document.getElementById(show);
            if(element.style.display === "none") {
                element.style.display = "block";
            }
            else {
                element.style.display = "none";
            }
        }
    </script>
</div>

<!---------------------------------------------------------------------------------------->
<?php include '../teacher/includes/footer.php' ?>
<!---------------------------------------------------------------------------------------->