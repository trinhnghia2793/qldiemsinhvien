<?php
$noti = $_GET['noti'] ?? '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include 'includes/link.php'; ?>
    <title>Quên mật khẩu</title>
</head>
<body>

    <div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-form-title" style="background-image: url(style/images/bg-01.jpg);">
					<span class="login100-form-title-1">
						RESET
					</span>
				</div>

                <form class="login100-form validate-form" action="send_reset_link.php" method="post">
                    <div class="wrap-input100 validate-input m-b-26">
                        <span class="label-input100">Email</span>
                        <input class="input100" type="email" name="email" placeholder="" required>
                        <span class="focus-input100"></span>
                    </div>
                    <div class="container-login100-form-btn" style="margin-bottom: 15px;">
                        <button class="login100-form-btn">
                            Gửi email
                        </button>
                    </div> 
                    <a href="login.php" class="">Quay về trang login</a>
                </form>
                
                <?php
                if($noti == 1) {
                    ?>
                    <h6 class="text-danger">Email đặt lại đã được gửi. Kiểm tra hộp thư</h6>
                    <?php
                }
                else if($noti == 2) {
                    ?>
                    <h6 class="text-danger">Email không hợp lệ.</h6>
                    <?php
                }
                ?>
            </div>
		</div>
	</div>

</body>
</html>

