<?php

require_once 'mail.php';

// Check if POST data is received
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get user data from POST
    
    $mail = htmlspecialchars(trim($_POST['mail']));
    $fullname = htmlspecialchars(trim($_POST['fullname']));
    
    if (empty($mail) || empty($fullname)) {
        echo "Email or Fullname can't be Empty";
        exit();
    }

    $otp = rand(1000, 9999);

    session_start();
    $_SESSION['otp'] = $otp;

    $subject = "Register Email Verification";
    $mailBody = "your One time OTP: <b>$otp</b><br> From- i-Blog Pvt Ltd";

    echo sendMail($mail, $fullname, $subject, $mailBody);
}
else{
    header('location: ../signup.php');
}

?>
