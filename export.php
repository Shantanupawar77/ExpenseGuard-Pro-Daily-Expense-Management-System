<?php
include("session.php");

// Generate CSV content
$csvContent = require 'data.php';

// Save CSV file
$csvFilePath = 'exported_data.csv';
file_put_contents($csvFilePath, $csvContent);

// Mail sending process
require 'PhpMailer/PHPMailer.php';
require 'PhpMailer/SMTP.php';
require 'PhpMailer/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Create a new PHPMailer instance
$mail = new PHPMailer();

// SMTP configuration
$mail->isSMTP();
$mail->Host = 'smtp.gmail.com'; // Your SMTP host
$mail->SMTPAuth = true;
$mail->Username = 'mahipawar777789@gmail.com'; // Your SMTP username
$mail->Password = 'lmeo kqbt tjmf divt'; // Your SMTP password
$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Enable TLS encryption, `PHPMailer::ENCRYPTION_SMTPS` also accepted
$mail->Port = 587; // TCP port to connect to

// Sender and recipient settings
$mail->setFrom('mahipawar777789@gmail.com', 'Mahi');
$mail->addAddress($_SESSION["useremail"], $username); // Use the email stored in the session

// Email content
$mail->isHTML(true);
$mail->Subject = 'CSV File Attachment';
$mail->Body = 'Please find the attached CSV file.';

// Attach CSV file
$mail->addAttachment($csvFilePath, 'exported_data.csv');

// Send email
if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo '<script>alert("The report has been sent."); window.location.href = "index.php";</script>';

    
}

// Delete the generated CSV file
unlink($csvFilePath);
?>