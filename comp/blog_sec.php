
        <section class="blog-section">
            <?php
            if ($noOfBlogs > 0) {
                while ($data = mysqli_fetch_assoc($res)) {
                    $desc = $data['description'];
                    $mode = $data['mode'];
                    ?>
            <div class="blog-card" onclick="showMore(<?php echo $data['id']  ?>)">
            <?php
                if ((isset($_SESSION['username']) && $_SESSION['loggedin'] === true) && pathinfo($_SERVER['REQUEST_URI'], PATHINFO_BASENAME) === "index.php") {
                ?>
                <div class="blog-features">
                    <div>
                        <i class="fa-regular fa-pen-to-square" onclick="editBlog(<?php echo $data['id']  ?>)"></i>
                    </div>
                    <select onchange="changeMode(<?php echo $data['id']  ?>, this.value)">
                        <option value="public" <?php echo $mode === 'public' ? 'selected' : null ?>>Public</option>
                        <option value="private" <?php echo $mode === 'private' ? 'selected' : null ?>>Private</option>
                    </select>
                </div>
                <?php 
                }
                ?>
                
                <div>
                    <img src="img/<?php echo $data['image'] ?>" alt="Blog Image" class="blog-img"/>
                    <h3 class="blog-title"><?php echo $data['title'] ?></h3>
                    <p class="blog-description"><?php echo strlen($desc) > 85 ? substr($desc, 0, 85)."..." : $desc  ?></p>
                </div>
            </div>
            <?php
                }
            }
            else{
                echo "<h2>No Blogs Added Yet!</h2>";
            }
            ?>
        </section>