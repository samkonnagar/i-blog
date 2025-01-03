
<?php
require_once 'backend/_connect.php';
if (isset($_GET['user_id'])) {
    $uId = $_GET['user_id'];
    $sql = "SELECT * FROM `blogs` WHERE mode = 'public' and user_id = $uId limit 20";
}
else{
    $sql = "SELECT * FROM `blogs` WHERE mode = 'public' limit 20";
}
$res = mysqli_query($conn, $sql);

$noOfBlogs = mysqli_num_rows($res);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Blogs</title>
    <link rel="stylesheet" href="css/style.css">
    <script src="js/jquery-3.js"></script>
    <script src="js/ajax.js" defer></script>
    <script src="js/common.js" defer></script>
</head>

<body>
    <?php 
    session_start();
    include_once 'comp/navbar.php';  
    ?>

    <main>
    <section class="hero">
            <h1>All Blogs</h1>
        </section>
    <?php require_once 'comp/blog_sec.php';  ?>
    </main>

    <?php include_once 'comp/footer.php'; ?>
</body>

</html>