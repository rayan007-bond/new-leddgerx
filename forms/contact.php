<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . '/../phpmailer/src/Exception.php';
require __DIR__ . '/../phpmailer/src/PHPMailer.php';
require __DIR__ . '/../phpmailer/src/SMTP.php';

// Clear output (avoid extra white space)
while (ob_get_level()) {
    ob_end_clean();
}

header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    echo json_encode(["status" => "error", "message" => "Invalid request"]);
    exit;
}

$name    = trim($_POST["name"] ?? "");
$email   = trim($_POST["email"] ?? "");
$subject = trim($_POST["subject"] ?? "");
$message = trim($_POST["message"] ?? "");

// Simple validation
if ($name === "" || $email === "" || $subject === "" || $message === "") {
    echo json_encode(["status" => "error", "message" => "Please fill all fields"]);
    exit;
}

$mail = new PHPMailer(true);

try {
    // SMTP configuration
    $mail->isSMTP();
    $mail->Host       = "smtp.gmail.com";
    $mail->SMTPAuth   = true;
    $mail->Username   = "muhammadrayan182@gmail.com";    // Your Gmail
    $mail->Password   = "wgpb wwbd pqdb ffch";           // App Password
    $mail->SMTPSecure = "ssl";
    $mail->Port       = 465;

    // Email data
    $mail->setFrom($email, $name);
    $mail->addAddress("muhammadrayan182@gmail.com");     // Receiver

    $mail->Subject = $subject;
    $mail->Body    = "Name: $name\nEmail: $email\n\nMessage:\n$message";

    if ($mail->send()) {
        echo json_encode(["status" => "success"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Could not send"]);
    }

} catch (Exception $e) {
    echo json_encode(["status" => "error", "message" => $e->getMessage()]);
}
exit;
