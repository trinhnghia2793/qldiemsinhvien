<?php
include 'config.php';
function loadClass($c) {
    include "class/$c.php";
}
spl_autoload_register("loadClass");

$user = new user();

$token = $_POST['token'];
$newPassword = $_POST['password'];

// Verify the token from the database
// ...

// If the token is valid, update the user's password
$user->updatePassword($token, $newPassword);

// Remove the token from the database
$user->removeToken($token);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include 'includes/link.php'; ?>
    <title>Reset Password</title>
</head>
<body>
    <div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-form-title" style="background-image: url(style/images/bg-01.jpg);">
					<span class="login100-form-title-1">
						RESET PASSWORD SUCCESSFULLY!
					</span>
				</div>
            </div>
		</div>
	</div>
</body>
</html>