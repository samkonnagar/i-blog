<?php
require_once '_connect.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Define variables and initialize with empty values
    $blog_id = $_POST['uId'];
    $update_mode = $_POST['mode'];

    if (mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `blogs` WHERE id = '$blog_id'"))) {
        $sql = "UPDATE `blogs` SET `mode`='$update_mode' WHERE id = '$blog_id'";
        if (mysqli_query($conn, $sql)) {
            echo "Blog Updated";
        }
    }
    else{
        echo "Invalid ID";
    }


}

// Close the connection
mysqli_close($conn);
?>