<?php
require_once '_connect.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['comment']) && !empty($_POST['comment'])&& !empty($_POST['blog_id'])) {
        $comment = trim($_POST['comment']);
        $bId = $_POST['blog_id'];
        $userId = $_SESSION['user_id'];
        if (empty($comment)) {
            $msg = "Comment cannot be empty.";
            header("location: ../preview.php?blog_id=$bId&message=$msg");
        } else {
            if (strlen($comment) > 300) {
                $msg = "Comment extends the limit size.";
                header("location: ../preview.php?blog_id=$bId&message=$msg");
            } else {
                // Prevent XSS by escaping special characters
                $comment = mysqli_real_escape_string($conn, $comment);
                
                $sql = "INSERT INTO `comments`(`user_id`, `blog_id`, `comment`) VALUES ('$userId','$bId','$comment')";
                
                if (mysqli_query($conn, $sql)) {
                    $msg = "Comment posted successfully!";
                    header("location: ../preview.php?blog_id=$bId&message=$msg");
                } else {
                    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                }
            }
        }
    } else {
        $bId = $_POST['blog_id'];
        $msg = "Please enter a comment.";
        header("location: ../preview.php?blog_id=$bId&message=$msg");
    }
}

// Close connection
mysqli_close($conn);
?>
