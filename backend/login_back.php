<?php
require_once '_connect.php';


// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect and sanitize form data
    $username = htmlspecialchars(trim($_POST['username']));
    $password = htmlspecialchars($_POST['password']);

    if (empty($username) || empty($password)) {
        $msg = "All fields are required!";
        header("location: ../login.php?messge=$msg");
        exit();
    }

    // Query to check if the username and password match
    $sql = "SELECT id, username, full_name, password FROM users WHERE username = '$username'";
    $result = mysqli_query($conn, $sql);

    // Check if user exists
    if (mysqli_num_rows($result) > 0) {
        $data = mysqli_fetch_assoc($result);
        if (password_verify($password, $data['password'])) {

            // Start session to store login information
            session_start();
            // Start session and store user information
            $_SESSION['username'] = $username;
            $_SESSION['user_id'] = $data['id'];
            $_SESSION['loggedin'] = true;
            $_SESSION['full_name'] = $data['full_name'];
            header("Location: ../index.php"); 
            exit();
        }
        else{
            $msg = "Invalid Password";
            header("location: ../login.php?messge=$msg");
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
