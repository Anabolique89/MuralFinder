<?php 

if (session_status() == PHP_SESSION_NONE) {
    // Start the session
    session_start();
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Account</title>
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="../../assets/css/style2.css">
</head>

<body>

    <main>
        <img src="../../assets/graphics/bubbles.png" class="graphics" alt="bubbles">
        <div class="onboarding-page-login">
            <div class="logo-container"><a href="homepage.php"><img src="../../assets/img/LOGOWhite.png"
                        alt="logo white"></a></div>
            <p>What's your profile?</p>
            <div class="form-wrapper">

            <?php
                if (isset($_SESSION['error'])) {
                echo "<p style='color: red;'>{$_SESSION['error']}</p>";
                unset($_SESSION['error']); // Clear the error after displaying it
                }
                ?>

                <form action="../../route/web.php" method="POST" class="signup-form">
                    <div class="input-wrapper">
                        <input type="text" name="name" placeholder="Username" class="input-text">
                    </div>
                    <div class="input-wrapper">
                        <input type="password" name="password" placeholder="Password" class="input-text">
                    </div>
                    <div class="input-wrapper">
                        <input type="password" name="passwordRepeat" placeholder="Repeat Password" class="input-text">
                    </div>
                    <div class="input-wrapper">
                        <input type="text" name="email" placeholder="E-mail" class="input-text">
                    </div>
                    <div class="input-wrapper">
                        <input type="text" name="UserProfile" placeholder="Artist or Artlover?" class="input-text">
                    </div>
                    <br>
                    <button type="submit" name="action" value="register" class="submit-button btn">CREATE
                        ACCOUNT</button>
                </form>
                <p class="bottom-p-text">Already have an account yet?<a class="link" href="indexlogin.php"> Login
                        here!</a></p>
            </div>

        </div>
    </main>
</body>

</html>