<?php

require_once 'mail.php';
require_once '_connect.php';

// Check if POST data is received
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get user data from POST
    
    $username = htmlspecialchars(trim($_POST['username']));
    
    if (empty($username)) {
        echo "Username can't be Empty";
        exit();
    }

    $sql = "SELECT `full_name`, `email` FROM `users` WHERE username = '$username'";
    $res = mysqli_query($conn, $sql);
    if (!$res) {
        echo "Something Wrong";
        exit();
    }
    if (!mysqli_num_rows($res)) {
        echo "Invalid Username";
        exit();
    }
    $data = mysqli_fetch_assoc($res);
    $fullname = $data['full_name'];
    $mail = $data['email'];

    $otp = rand(1000, 9999);

    session_start();
    $_SESSION['otp'] = $otp;

    $subject = "Login Email Verification";
    $mailBody = "your One time OTP: <b>$otp</b><br> From- i-Blog Pvt Ltd";

    echo sendMail($mail, $fullname, $subject, $mailBody);
}
else{
    header('location: ../signup.php');
}

?>
