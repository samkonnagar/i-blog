<?php
require_once '_connect.php';
session_start();


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Define variables and initialize with empty values
    $blog_title = $blog_description = "";
    $publish_mode = $_POST['publish_mode'];
    if (!isset($_POST['bId'])) {
        $msg = "Invalid Request";
        header("location: ../index.php?messge=$msg");
        exit();
    }
    $bId = $_POST['bId'];

    // Validate blog_title
    if (empty(trim($_POST["blog_title"]))) {
        $msg = "Blog title is required.";
        header("location: ../editBlog.php?blog_id=$bId&messge=$msg");
        exit();
    } else {
        $blog_title = htmlspecialchars(trim($_POST["blog_title"]));
    }

    // Validate blog_description
    if (empty(trim($_POST["blog_description"]))) {
        $msg = "Blog description is required.";
        header("location: ../editBlog.php?blog_id=$bId&messge=$msg");
        exit();
    } else {
        $blog_description = htmlspecialchars(trim($_POST["blog_description"]));
    }

    // Validate image upload
    if (empty($_FILES["blog_image"]["name"])) {
        $sql="UPDATE `blogs` SET `title`='$blog_title',`description`='$blog_description',`mode`='$publish_mode' where id=$bId";

            try {
                if (mysqli_query($conn, $sql)) {
                    $msg = "Blog Updated";
                    header("location: ../index.php?messge=$msg");
                    exit();
                }
            } catch (\Throwable $th) {
                echo "Error: " . mysqli_error($conn);
            }
    } else {
        $target_dir = "img/";
        $file_name = basename($_FILES["blog_image"]["name"]);
        $imageFileType = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

        // Check file size (limit to 5MB)
        if ($_FILES["blog_image"]["size"] > (5*1024*1024)) {
            $msg = "Sorry, your file is too large.";
            header("location: ../editBlog.php?blog_id=$bId&messge=$msg");
            exit();
        }

        // Allow certain file formats
        if (!in_array($imageFileType, ["jpg", "jpeg", "png"])) {
            $msg = "Sorry, only JPG, JPEG & PNG files are allowed.";
            header("location: ../editBlog.php?blog_id=$bId&messge=$msg");
            exit();
        }

        if (empty($_SESSION['user_id'])) {
            $msg = "Something Went Wrong";
            header("location: ../login.php?messge=$msg");
            exit();
        }


        $new_file_name = uniqid("BLOG-").".$imageFileType";
        // Move uploaded file to the target directory
        if (move_uploaded_file($_FILES["blog_image"]["tmp_name"], "../img/$new_file_name")) {

            $user_id = $_SESSION['user_id'];

            $sql="UPDATE `blogs` SET `user_id`='$user_id',`title`='$blog_title',`description`='$blog_description',`image`='$new_file_name',`mode`='$publish_mode' where id='$bId'";

            try {
                if (mysqli_query($conn, $sql)) {
                    $msg = "Blog Updated";
                    header("location: ../index.php?&messge=$msg");
                    exit();
                }
            } catch (\Throwable $th) {
                unlink("../img/$new_file_name");
                echo "Error: " . mysqli_error($conn);
            }
        } else {
            $msg = "Sorry, there was an error uploading your file.";
            header("location: ../editBlog.php?blog_id=$bId&messge=$msg");
            exit();
        }
        
    }

}

// Close the connection
mysqli_close($conn);
?>