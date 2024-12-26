<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/style.css">
    <script src="js/jquery-3.js"></script>
</head>

<body>
    <?php include_once 'comp/navbar.php';  ?>

    <main>
        <section class="auth-form">
            <h1 id="heading">Login</h1>
            <form action="backend/login_back.php" method="POST" id="normalLogin">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" required>

                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>

                <button type="submit">Login</button>
                <div class="divider">
                    <span></span>
                    <b>Or</b>
                    <span></span>
                </div>
                <button id="otpLoginBtn">Login With OTP</button>
            </form>
            <form action="backend/otp_login_back.php" method="POST" id="otpLogin">
                <label for="o-username">Username</label>
                <input type="text" id="o-username" name="o-username" required>

                <input type="button" value="Send OTP" onclick="sendOtp()">

                <label for="otp">OTP</label>
                <input type="number" id="otp" name="otp" max="9999" min="1000">

                <button type="submit">Login</button>
                <div class="divider">
                    <span></span>
                    <b>Or</b>
                    <span></span>
                </div>
                <button id="passLoginBtn">Login With Password</button>
            </form>
        </section>
    </main>

    <?php include_once 'comp/footer.php'; ?>


    <script>
        let isOtpSend = false
        function sendOtp() {
            if (!isOtpSend) {

                $.post("backend/handelUsernameWithOTP.php",
                    {
                        username: $('#o-username').val()
                    },
                    function (data, status) {
                        alert(data);
                    });
            }
            isOtpSend = true
        }

        $('#otpLoginBtn').click(() => {
            $('#normalLogin').hide()
            $('#otpLogin').show()
            $('#heading').text('Login With OTP')
        })
        $('#passLoginBtn').click(() => {
            $('#otpLogin').hide()
            $('#normalLogin').show()
            $('#heading').text('Login')
        })
    </script>
</body>

</html>