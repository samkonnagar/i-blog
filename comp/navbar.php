<header>
    <nav>
        <div class="navbar-container">
            <div class="logo">
                <a href="index.php">i-Blog</a>
            </div>
            <div class="hamburger">
                <span></span>
                <span></span>
                <span></span>
            </div>
            <ul class="nav-links">
                <li><a href="index.php">Home</a></li>
                <li><a href="all_blogs.php">All Blog</a></li>
                <li><a href="addblog.php">Add Blog</a></li>
                <li><a href="contact.php">Contact</a></li>
                <?php
                if (!(isset($_SESSION['username']) && $_SESSION['loggedin'] === true)) {
                ?>
                <li><a href="login.php">Login</a></li>
                <li><a href="signup.php">Signup</a></li>
                <?php 
                } else {
                ?>
                <li>
                    <a href="profile.php">
                        <img src="https://ui-avatars.com/api/?name=<?php echo strtoupper(substr($_SESSION['full_name'], 0, 1)); ?>&background=0D8ABC&color=fff&size=128" alt="Profile">
                    </a>
                </li>
                <?php
                }
                ?>
            </ul>
        </div>
    </nav>
</header>
