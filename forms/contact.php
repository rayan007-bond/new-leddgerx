<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

// Clear output buffers
while (ob_get_level()) {
    ob_end_clean();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name    = trim($_POST["name"] ?? "");
    $email   = trim($_POST["email"] ?? "");
    $subject = trim($_POST["subject"] ?? "");
    $message = trim($_POST["message"] ?? "");

    // Validation
    if (empty($name) || empty($email) || empty($subject) || empty($message)) {
        echo "error";
        exit;
    }

    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host       = "smtp.gmail.com";
        $mail->SMTPAuth   = true;
        $mail->Username   = "muhammadrayan182@gmail.com";    
        $mail->Password   = "wgpb wwbd pqdb ffch"; 
        $mail->SMTPSecure = "ssl";
        $mail->Port       = 465;

        $mail->setFrom($email, $name);
        $mail->addAddress("muhammadrayan182@gmail.com");

        $mail->Subject = $subject;
        $mail->Body    = "Name: $name\nEmail: $email\n\nMessage:\n$message";

        if ($mail->send()) {
            echo "success";
        } else {
            echo "error";
        }
        exit;

    } catch (Exception $e) {
        echo "error";
        exit;
    }
}

echo "error";
exit;
?>