<?php

include 'config.php';
function loadClass($c) {
    include "class/$c.php";
}
spl_autoload_register("loadClass");
$user = new user();

include 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

$email = $_POST['email'];
$rs = $user->checkemail($email);
if(Count($rs) > 0) {
    // Generate a unique token
    $token = bin2hex(random_bytes(50));

    // Store the token in your database with an expiration time
    $user->addToken($email, $token);

    // Create a new PHPMailer instance
    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->SMTPDebug = SMTP::DEBUG_OFF;
        $mail->isSMTP();
        $mail->Host = "smtp.gmail.com";
        $mail->SMTPAuth = true;
        $mail->Username = 'snowpeavszombie@gmail.com';
        $mail->Password = 'tyoygodmychrkmtm';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port = 465;

        // Recipients
        $mail->setFrom('qldiem@example.com', 'qldiem');
        $mail->addAddress($email); // Add a recipient

        // Content
        $mail->isHTML(true);
        $mail->Subject = 'Reset password';
        $mail->Body    = 'Nhấn vào đường link để đặt lại: localhost:3000/reset_password.php?token=' . $token . '';
        //$mail->Body    = 'Nhấn vào đường link để đặt lại: <a href="localhost:3000/reset_password.php?token=' . $token . '">Link</a>';

        $mail->send();

        header('location:forgot_password.php?noti=1');
    } catch (Exception $e) {
        echo "Error: {$mail->ErrorInfo}";
    }
}
else {
    header('location:forgot_password.php?noti=0');
}