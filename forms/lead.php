<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . '/../phpmailer/src/Exception.php';
require __DIR__ . '/../phpmailer/src/PHPMailer.php';
require __DIR__ . '/../phpmailer/src/SMTP.php';

// Clear output
while (ob_get_level()) {
    ob_end_clean();
}

header('Content-Type: application/json');

// Only allow POST
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    echo json_encode(["status" => "error", "message" => "Invalid request"]);
    exit;
}

$name    = trim($_POST["name"] ?? "");
$company = trim($_POST["company"] ?? "");
$email   = trim($_POST["email"] ?? "");
$phone   = trim($_POST["phone"] ?? "");
$service = trim($_POST["service"] ?? "");
$message = trim($_POST["message"] ?? "");
$consent = isset($_POST["consent"]) ? "Yes" : "No";

// Basic validation
if ($name === "" || $email === "" || $phone === "" || $message === "") {
    echo json_encode(["status" => "error", "message" => "Missing required fields"]);
    exit;
}

$mail = new PHPMailer(true);

try {
    // SMTP settings
    $mail->isSMTP();
    $mail->Host       = "smtp.gmail.com";
    $mail->SMTPAuth   = true;

    // ✅ Get secure credentials (RECOMMENDED)
    $mail->Username   = getenv("SMTP_USER") ?: "YOUR_EMAIL@gmail.com";
    $mail->Password   = getenv("SMTP_PASS") ?: "YOUR_APP_PASSWORD";

    $mail->SMTPSecure = "ssl";
    $mail->Port       = 465;

    // Email info
    $mail->setFrom($email, $name);
    $mail->addAddress(getenv("RECEIVER_EMAIL") ?: "muhammadrayan182@gmail.com");

    $mail->Subject = "New Lead Form - " . ($service ?: "No Service Selected");
    $mail->Body    =
"-------- LEAD FORM --------

Name: $name
Company: $company
Email: $email
Phone: $phone
Service Interested In: $service
Consent Given: $consent

Message:
$message
----------------------------";

    if ($mail->send()) {
        echo json_encode(["status" => "success"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Mail send failed"]);
    }

} catch (Exception $e) {
    echo json_encode(["status" => "error", "message" => $e->getMessage()]);
}
exit;
