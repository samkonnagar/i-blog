
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <link rel="stylesheet" href="css/style.css">
    <script src="js/common.js" defer></script>
</head>
<body>
    <?php 
    session_start();
    include_once 'comp/navbar.php';
    ?>

    <main>
        <section class="contact">
            <h1>Contact Us</h1>
            <form action="submit_contact.php" method="POST">
                <label for="name">Full Name</label>
                <input type="text" id="name" name="name" required>
                
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
                
                <label for="message">Message</label>
                <textarea id="message" name="message" rows="4" required></textarea>

                <button type="submit">Submit</button>
            </form>
        </section>
    </main>

    <?php include_once 'comp/footer.php'; ?>
</body>
</html>
