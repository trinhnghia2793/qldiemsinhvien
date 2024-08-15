<?php
// Verify the token and check its validity
// ...

// If valid, display the form
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include 'includes/link.php'; ?>
    <title>Đặt lại mật khẩu</title>
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

                <form class="login100-form validate-form" action="update_password.php" method="post">
                    <input type="hidden" name="token" value="<?php echo $_GET['token']; ?>">
                    <div class="wrap-input100 validate-input m-b-26">
                        <span class="label-input100">Password mới</span>
                        <input class="input100" type="password" name="password" placeholder="" required>
                        <span class="focus-input100"></span>
                    </div>
                    <div class="container-login100-form-btn" style="margin-bottom: 15px;">
                        <button class="login100-form-btn">
                            Update
                        </button>
                    </div> 
                </form>
                
            </div>
		</div>
	</div>
</body>
</html>