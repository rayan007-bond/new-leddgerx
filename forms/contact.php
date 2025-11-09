<?php
// forms/contact.php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . '/../phpmailer/src/Exception.php';
require __DIR__ . '/../phpmailer/src/PHPMailer.php';
require __DIR__ . '/../phpmailer/src/SMTP.php';

function dbg($msg) {
    // append debug messages to /tmp so Railway logs show them
    @file_put_contents('/tmp/mail_debug.log', date('c') . " " . $msg . PHP_EOL, FILE_APPEND);
}

header('Content-Type: application/json');

// quick safety
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    dbg("Invalid request method: " . $_SERVER['REQUEST_METHOD']);
    echo json_encode(['status'=>'error','message'=>'Invalid request method']);
    exit;
}

$name    = trim($_POST['name'] ?? '');
$email   = trim($_POST['email'] ?? '');
$subject = trim($_POST['subject'] ?? '');
$message = trim($_POST['message'] ?? '');

if ($name === '' || $email === '' || $subject === '' || $message === '') {
    dbg("Validation failed: missing fields");
    echo json_encode(['status'=>'error','message'=>'Please fill all fields']);
    exit;
}

// load creds from env
$smtpUser = getenv('SMTP_USER') ?: '';
$smtpPass = getenv('SMTP_PASS') ?: '';
$receiver = getenv('RECEIVER_EMAIL') ?: $smtpUser;

if (!$smtpUser || !$smtpPass) {
    dbg("Missing SMTP env vars. SMTP_USER or SMTP_PASS empty.");
    echo json_encode(['status'=>'error','message'=>'SMTP not configured']);
    exit;
}

$mail = new PHPMailer(true);

try {
    $mail->SMTPDebug = 2; // debug mode (logged), do not echo raw to users
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = $smtpUser;
    $mail->Password   = $smtpPass;
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; // ssl on 465
    $mail->Port       = 465;

    $mail->setFrom($smtpUser, 'Website Contact'); // set from to your email (avoid Gmail reject issues)
    // put user email into reply-to so you can reply easily
    $mail->addReplyTo($email, $name);
    $mail->addAddress($receiver);

    $mail->Subject = $subject;
    $mail->Body    = "Name: $name\nEmail: $email\n\nMessage:\n$message";

    if ($mail->send()) {
        dbg("Contact mail sent OK to $receiver (from $smtpUser) - name:$name email:$email");
        echo json_encode(['status'=>'success']);
    } else {
        dbg("Contact mail returned false send()");
        echo json_encode(['status'=>'error','message'=>'Mail send failed']);
    }
} catch (Exception $e) {
    // log full exception message and PHPMailer debug output
    dbg("PHPMailer Exception: " . $e->getMessage());
    // also gather SMTP debug if present (PHPMailer prints debug to output; we manually dump current debug into log)
    echo json_encode(['status'=>'error','message'=>'Mail error: ' . $e->getMessage()]);
}
exit;
