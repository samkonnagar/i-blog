<?php require_once 'comp/auth.php'; ?>
<?php
$curr_user_id = $_SESSION['user_id'];
if (isset($_GET['user_id'])) {
    if ($_GET['user_id'] != $curr_user_id) {
        $curr_user_id = $_GET['user_id'];
    }
}

require_once 'backend/_connect.php';
$sql = "select u.id, u.full_name, u.username, u.email, DATE_FORMAT(u.created_at, '%M %d, %Y') as join_date, count(b.user_id) as total_blog from users u left join blogs b on u.id = b.user_id  where u.id= $curr_user_id group by u.id";

$res = mysqli_query($conn, $sql);

if (!mysqli_num_rows($res)) {
    $msg = "Invalid Id";
        header("location: all_blogs.php?messge=$msg");
        exit();
}

$data = mysqli_fetch_assoc($res);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Page</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/preview.css">
    <link rel="stylesheet" href="css/profile.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css"
        integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="js/jquery-3.js"></script>
    <script src="js/ajax.js" defer></script>
    <script src="js/common.js" defer></script>
</head>

<body>
    <?php 
    include_once 'comp/navbar.php';
      ?>
    <main>
    <div class="profile-page">
        <div class="profile-header">
            <h1>User Profile</h1>
        </div>

        <div class="profile-content">
            <div class="profile-image">
                <img src="https://via.placeholder.com/150" alt="Profile Image" class="user-img">
            </div>

            <div class="profile-details">
                <h2><?php echo ucwords($data['full_name']) ?></h2>
                <p class="username">@<?php echo $data['username'] ?></p>
                <div class="info">
                    <div class="info-item">
                        <strong>Email:</strong>
                        <span><?php echo $data['email'] ?></p></span>
                    </div>
                    <div class="info-item">
                        <strong>Password:</strong>
                        <span>********</span>
                    </div>
                    <div class="info-item">
                        <strong>Created At:</strong>
                        <span><?php echo $data['join_date'] ?></p></span>
                    </div>
                    <div class="info-item">
                        <strong>Total Blogs:</strong>
                        <span><?php echo $data['total_blog'] ?></p></span>
                    </div>
                    <div class="info-item">
                        <strong>Liked Blogs:</strong>
                        <span>0</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="social-links">
            <?php
                if (isset($_GET['user_id']) && ($_GET['user_id'] != $_SESSION['user_id'])) {
            ?>
            <a href="all_blogs.php?user_id=<?php echo $data['id'] ?>">All Blogs</a>
            <?php
                }
                else{
            ?>
            <a href="#">Edit Profile</a>
            <a href="logout.php">Logout</a>

            <?php
                }
            ?>
        </div>
    </div>
    </main>

    <?php include_once 'comp/footer.php'; ?>
</body>

</html>