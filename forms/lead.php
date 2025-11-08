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

    $name = trim($_POST["name"] ?? "");
    $company = trim($_POST["company"] ?? "");
    $email = trim($_POST["email"] ?? "");
    $phone = trim($_POST["phone"] ?? "");
    $service = trim($_POST["service"] ?? "");
    $message = trim($_POST["message"] ?? "");
    $consent = isset($_POST["consent"]) ? "Yes" : "No";

    // Validation
    if (empty($name) || empty($email) || empty($phone) || empty($message)) {
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

        $mail->Subject = "New Lead Form Submission - " . $service;
        $mail->Body    = "
        New Lead Form Submission:
        
        Name: $name
        Company: $company
        Email: $email
        Phone: $phone
        Service Interested In: $service
        Consent Given: $consent
        
        Message:
        $message
        ";

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