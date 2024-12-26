<?php
require_once '_connect.php';

// Check if POST data is received
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get user data from POST
    
    $fullname = htmlspecialchars(trim($_POST['fullname']));
    $username = htmlspecialchars(trim($_POST['username']));
    $email = htmlspecialchars(trim($_POST['email']));
    $password = htmlspecialchars($_POST['password']);
    $otp = htmlspecialchars($_POST['otp']);

    session_start();
    if ($otp != $_SESSION['otp']) {
        session_unset();
        session_destroy();
        $msg = "Incorrect Otp";
        header("location: ../signup.php?messge=$msg");
        exit();
    }
    
    // Validate inputs (simple validation)
    if (empty($fullname) || empty($username) || empty($email) || empty($password)) {
        $msg = "All fields are required!";
        header("location: ../signup.php?messge=$msg");
        exit();
    }

    // Check if username or email already exists
    $check_sql = "SELECT id FROM users WHERE username = '$username' OR email = '$email'";
    $result = mysqli_query($conn, $check_sql);
    
    if (mysqli_num_rows($result) > 0) {
        $msg = "Username or email already exists!";
        header("location: ../signup.php?messge=$msg");
        exit();
    }

    $hasPassword = password_hash($password, PASSWORD_DEFAULT);

    // Prepare the SQL to insert the new user
    $sql = "INSERT INTO users (full_name, username, email, password) VALUES ('$fullname', '$username', '$email', '$hasPassword')";

    // Execute the SQL query
    if (mysqli_query($conn, $sql)) {
        $msg = "User registered successfully! Now you can Login";
        header("location: ../signup.php?messge=$msg");
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
else{
    header('location: ../signup.php');
}

// Close the connection
mysqli_close($conn);
?>
