<?php
require_once '_connect.php';
session_start();


// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect and sanitize form data
    $username = htmlspecialchars(trim($_POST['o-username']));
    $otp = htmlspecialchars(trim($_POST['otp']));

    if (empty($username) || empty($otp)) {
        $msg = "All fields are required!";
        header("location: ../login.php?messge=$msg");
        exit();
    }

    // Query to check if the username
    $sql = "SELECT id, username, full_name, password FROM users WHERE username = '$username'";
    $result = mysqli_query($conn, $sql);

    // Check if user exists
    if (mysqli_num_rows($result) > 0) {
        $data = mysqli_fetch_assoc($result);
        if ($otp != $_SESSION['otp']) {
            session_unset();
            session_destroy();
            $msg = "Incorrect Otp";
            header("location: ../login.php?messge=$msg");
            exit();
        }else {
            session_unset();
            // Start session and store user information
            $_SESSION['username'] = $data['username'];
            $_SESSION['user_id'] = $data['id'];
            $_SESSION['loggedin'] = true;
            $_SESSION['full_name'] = $data['full_name'];
            header("Location: ../index.php"); 
            exit();
        }
    } else {
        // Invalid credentials
        $msg = "Invalid username";
        header("location: ../login.php?messge=$msg");
        exit();
    }
}
else{
    header('location: ../login.php');
}

// Close the connection
mysqli_close($conn);
?>
