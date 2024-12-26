<?php require_once 'comp/auth.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Blog</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/addBlog.css">
</head>
<body>
    <?php include_once 'comp/navbar.php';  ?>

    <main>
        <div class="form-container">
            <h2>Add New Blog</h2>
            <form action="backend/blog_back.php" method="post" enctype="multipart/form-data">
                <div class="form-group fm-gp">
                    <label for="blog_title">Blog Title</label>
                    <input type="text" id="blog_title" name="blog_title" placeholder="Enter blog title" required>
                </div>

                <div class="form-group fm-gp">
                    <label for="blog_description">Blog Description</label>
                    <textarea id="blog_description" name="blog_description" placeholder="Enter blog description" required></textarea>
                </div>

                <div class="form-group fm-gp">
                    <label for="publish_mode">Publish Mode</label>
                    <select id="publish_mode" name="publish_mode">
                        <option value="public">Public</option>
                        <option value="private">Private</option>
                    </select>
                </div>

                <div class="form-group ">
                    <label for="blog_image">Upload Image</label>
                    <div class="image-upload-container">
                        <input type="file" id="blog_image" name="blog_image" accept="image/*" onchange="previewImage(event)">
                        <img id="image_preview" class="image-preview" src="" alt="Image Preview">
                    </div>
                </div>

                <button type="submit" class="btn-submit">Submit</button>
            </form>
        </div>
    </main>

    <footer>
        <p>&copy; 2024 Our Website. All Rights Reserved.</p>
    </footer>


    <script>
        // Preview image function
        function previewImage(event) {
            const imagePreview = document.getElementById('image_preview');
            const file = event.target.files[0];
            
            const reader = new FileReader();

            reader.onload = function() {
                imagePreview.style.display = "block"
                imagePreview.src = reader.result;
            }

            if (file) {
                reader.readAsDataURL(file);
            }
            
        }
    </script>
</body>
</html>
