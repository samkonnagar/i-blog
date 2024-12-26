<?php
require '../vendor/autoload.php'; // Include Composer autoloader

// Import the PHPMailer classes into the global namespace
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

function sendMail($toMail, $toMaleName, $subject, $mailBody) {
    
    // Create a new PHPMailer instance
    $mail = new PHPMailer(true);
    
    try {
        // Server settings
        $mail->isSMTP(); // Set mailer to use SMTP
        $mail->Host = 'smtp.gmail.com'; 
        $mail->SMTPAuth = true; // Enable SMTP authentication
        $mail->Username = 'samkonnagar123@gmail.com'; // SMTP username
        $mail->Password = 'vwqhvnduwvbydvto'; // SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Enable TLS encryption
        $mail->Port = 587; // TCP port to connect to
        
        // Recipients
        $mail->setFrom('samkonnagar123@gmail.com', 'i-Blog'); // Sender's email address
        $mail->addAddress($toMail, $toMaleName); // Add a recipient's email address
        
        // Content
        $mail->isHTML(true); // Set email format to HTML
        $mail->Subject = $subject;
        $mail->Body    = $mailBody;
        $mail->AltBody = 'This is the plain text message body for non-HTML email clients';
        
    // Send the email
    $mail->send();
    return 'Mail has been sent successfully';
} catch (Exception $e) {
    return "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
}
?>
