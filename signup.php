<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <?php include_once 'comp/navbar.php';  ?>

    <main>
        <section class="auth-form">
            <h1>Signup</h1>
            <form action="backend/signup_back.php" method="POST">
                <label for="fullname">Full Name</label>
                <input type="text" id="fullname" name="fullname" required>

                <label for="username">Username</label>
                <input type="text" id="username" name="username" required>

                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>

                <input type="button" value="Send OTP" onclick="sendOtp()">

                <label for="otp">OTP</label>
                <input type="number" id="otp" name="otp" max="9999" min="1000">

                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>

                <button type="submit">Signup</button>
            </form>
        </section>
    </main>

    <footer>
        <p>&copy; 2024 Our Website. All Rights Reserved.</p>
    </footer>

    <script src="js/jquery-3.js"></script>
    <script>
        let isOtpSend = false
        function sendOtp() {
            const email = document.getElementById('email').value
            const fullname = document.getElementById('fullname').value
            if (!isOtpSend) {
                console.log("hii");
                
                $.post("backend/handelOtp.php",
                    {
                        mail: email,
                        fullname: fullname
                    },
                    function (data, status) {
                        alert(data);
                    });
            }
            isOtpSend = true
        }
    </script>
</body>

</html>