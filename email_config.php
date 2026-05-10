<?php
require 'vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

function setupMailer() {
    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = ''; //your email
        $mail->Password = ''; // Your email password or app-specific password
        $mail->SMTPSecure = 'tls'; // or 'ssl' for port 465
        $mail->Port = 587; // Use 587 for TLS, 465 for SSL
        $mail->setFrom('no-reply@example.com', 'Your App Name'); // Set sender name and email

    } catch (Exception $e) {
        echo "Mailer configuration error: {$e->getMessage()}";
    }
    return $mail;
}
?>
