<?php
require '../includes/db.php';
require '../includes/PHPMailer.php';
require '../includes/SMTP.php';
require '../includes/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Email configuration
$mail = new PHPMailer(true);

try {
    // Server settings
    $mail->SMTPDebug = SMTP::DEBUG_OFF;
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'citytimes.blog@gmail.com';
    $mail->Password = 'wgcqnubsagkmbdyf';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    // getting emails 
    $subsql = "SELECT sumEmail FROM subscribe";
    $subresult = $db->query($subsql);

    if ($subresult && $subresult->num_rows > 0) {
        while ($subrow = $subresult->fetch_assoc()) {
            $email = $subrow['sumEmail'];

            // Recipients
            $mail->setFrom('citytimes.blog@gmail.com', 'city times');
            $mail->addAddress($email);

            // Content
            $mail->isHTML(true);
            $mail->Subject = 'New post added, you\'ll love to read it!';
            $mail->Body = '<h3>City Times is the best blogger website. There are many posts to read. We are waiting for you!</h3>';
            $mail->AltBody = 'City Times is the best blogger website. There are many posts to read. We are waiting for you!';

            // Send the email
            if (!$mail->send()) {
                throw new Exception('Email could not be sent. Error: ' . $mail->ErrorInfo);
            }

            $mail->clearAddresses();
        }

        echo '<script>alert("Email notifications sent successfully!");</script>';
        echo '<script>window.location.href = "admin_dashboard.php";</script>';
    } else {
        echo '<script>alert("No email addresses found to send.");</script>';
        echo '<script>window.location.href = "admin_dashboard.php";</script>';
    }
} catch (Exception $e) {
    echo 'Email could not be sent. Error: ', $e->getMessage();
}
?>