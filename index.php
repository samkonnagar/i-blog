<?php require_once 'comp/auth.php'; ?>
<?php
require_once 'backend/_connect.php';
$userId = $_SESSION['user_id'];
$sql = "SELECT * FROM `blogs` where user_id = '$userId' limit 10";
$res = mysqli_query($conn, $sql);

$noOfBlogs = mysqli_num_rows($res);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css" integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="js/jquery-3.js"></script>
    <script src="js/ajax.js" defer></script>
</head>

<body>
    <?php include_once 'comp/navbar.php';  ?>
    <main>
        <section class="hero">
            <h1>Welcome 
                <?php echo $_SESSION['username']; ?>, Here is your Blogs
            </h1>
        </section>
    <?php require_once 'comp/blog_sec.php';  ?>
</main>

<?php include_once 'comp/footer.php'; ?>
</body>

</html>