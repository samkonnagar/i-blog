<?php
require_once 'backend/_connect.php';
if (!isset($_GET['blog_id'])) {
    header('location: index.php?messge=invalid request');
}
if (!isset($_SESSION['user_id'])) {
    header('location: login.php?messge=please login to read all the blog content');
}
$blog_id = $_GET['blog_id'];
$user_id = $_SESSION['user_id'];
$sql = "select b.id, u.id as user_id, b.title, b.description, b.image, u.full_name, DATE_FORMAT(b.created_at, '%b %Y') AS formatted_date from blogs as b join users as u on b.user_id = u.id where b.id = $blog_id and( b.mode = 'public' or u.id = $user_id)";
$res = mysqli_query($conn, $sql);
if (mysqli_num_rows($res) === 0) {
    header('location: index.php?messge=invalid id');
}
$allData = mysqli_fetch_assoc($res);

$sql2 = "select c.id, c.comment, DATE_FORMAT(c.created_at, '%d %b %Y') AS formatted_date, u.full_name from comments as c join users as u on c.user_id = u.id where c.blog_id = $blog_id";

$res2 = mysqli_query($conn, $sql2);

$noOfComments = mysqli_num_rows($res2);
?>
<!-- Main Container -->
<div class="main-container">
        <!-- Blog Owner Section -->
        <div class="owner-section">
            <img src="https://ui-avatars.com/api/?name=<?php echo strtoupper(substr($allData['full_name'], 0, 1)); ?>&background=0D8ABC&color=fff&size=128" alt="Owner Image" class="owner-image">
            <div class="owner-info">
                <p class="owner-name"><a href="profile.php?user_id=<?php echo $allData['user_id']; ?>"><?php echo ucwords($allData['full_name']); ?></a></p>
                <p class="owner-bio">Publish on - <?php echo $allData['formatted_date']; ?></p>
            </div>
        </div>
        <!-- Blog Section -->
        <div class="blog-container">
            <img src="img/<?php echo $allData['image']; ?>" alt="Blog Image" class="blog-image">
            <div class="blog-content">
                <h1 class="blog-title"><?php echo $allData['title']; ?></h1>
                <p class="blog-description">
                <?php echo $allData['description']; ?>
                </p>
            </div>
        </div>

        <!-- Comment Input Section -->
        <div class="comment-form">
            <form action="backend/handelCommentSubmit.php" method="post">
                <h3>Leave a Comment:</h3>
                <input type="hidden" name="blog_id" value="<?php echo $blog_id; ?>">
                <textarea placeholder="Your Comment" name="comment"></textarea>
                <button type="submit">Post Comment</button>
            </form>
        </div>

        <!-- Comments Section -->
        <div class="comments-section">
            <?php
            if ($noOfComments === 0) {
                echo "<h3>No Comments Avalabel</h3>";
            }
            else{
                while ($commentData = mysqli_fetch_assoc($res2)) {

            ?>
            <div class="comment">
                <img src="https://ui-avatars.com/api/?name=<?php echo strtoupper(substr($commentData['full_name'], 0, 1)); ?>&background=0D8ABC&color=fff&size=128" alt="Jane's Image" class="comment-author-image">
                <div>
                    <p class="comment-author"><?php echo ucwords($commentData['full_name']) ?> - <span><?php echo $commentData['formatted_date'] ?></span></p>
                    <p class="comment-text"><?php echo $commentData['comment'] ?></p>
                </div>
            </div>
            <?php
                }
            }
            ?>
        </div>
    </div>