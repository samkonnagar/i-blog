<?php require_once 'comp/auth.php'; ?>
<?php
if (!isset($_GET['blog_id'])) {
    header('location: all_blogs.php');
    exit();
}
require_once 'backend/_connect.php';
$bId = $_GET['blog_id'];
$user_id = $_SESSION['user_id'];
$sql = "select * from blogs where id=$bId and user_id = $user_id";
$res = mysqli_query($conn, $sql);

if (!mysqli_num_rows($res)) {
    $msg = "Invalid Request";
    header("location: all_blogs.php?message=$msg");
    exit();
}

$data = mysqli_fetch_assoc($res);
$mode = $data['mode'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Blog</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/addBlog.css">
</head>
<body>
    <?php include_once 'comp/navbar.php';  ?>

    <main>
        <div class="form-container">
            <h2>Edit Blog</h2>
            <form action="backend/edit_blog_back.php" method="post" enctype="multipart/form-data">

                <input type="hidden" name="bId" value="<?php echo $data['id'] ?>">
                <div class="form-group fm-gp">
                    <label for="blog_title">Blog Title</label>
                    <input type="text" id="blog_title" name="blog_title" placeholder="Enter blog title" value="<?php echo $data['title'] ?>" required>
                </div>

                <div class="form-group fm-gp">
                    <label for="blog_description">Blog Description</label>
                    <textarea id="blog_description" name="blog_description" placeholder="Enter blog description" required><?php echo trim($data['description']) ?>
                    </textarea>
                </div>

                <div class="form-group fm-gp">
                    <label for="publish_mode">Publish Mode</label>
                    <select id="publish_mode" name="publish_mode">
                        <option value="public" <?php echo $mode === 'public' ? 'selected' : null ?>>Public</option>
                        <option value="private" <?php echo $mode === 'private' ? 'selected' : null ?>>Private</option>
                    </select>
                </div>

                <div class="form-group ">
                    <label for="blog_image">Upload Image</label>
                    <div class="image-upload-container">
                        <input type="file" id="blog_image" name="blog_image" accept="image/*" onchange="previewImage(event)">
                        <img id="image_preview" class="image-preview" src="img/<?php echo $data['image'] ?>" alt="Image Preview">
                    </div>
                </div>

                <button type="submit" class="btn-submit">Edit</button>
            </form>
        </div>
    </main>

    <footer>
        <p>&copy; 2024 Our Website. All Rights Reserved.</p>
    </footer>


    <script>
        // Preview image function
        const imagePreview = document.getElementById('image_preview');
        imagePreview.style.display = "block"
        function previewImage(event) {
            const file = event.target.files[0];
            
            const reader = new FileReader();

            reader.onload = function() {
                imagePreview.src = reader.result;
            }

            if (file) {
                reader.readAsDataURL(file);
            }
            
        }
    </script>
</body>
</html>
 
