<?php
namespace Views\Auth;

session_start();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SignUP&LoginSystem</title>
    <link rel="stylesheet" href="../../assets/css/style2.css">
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
        rel="stylesheet">
</head>

<body>


    <main>
        <img src="../../assets/graphics/bubbles.png" class="graphics" alt="bubbles">
        <div class="onboarding-page-login">
            <div class="logo-container"><a href="homepage.php"><img src="../../assets/img/LOGOWhite.png"
                        alt="logo white"></a></div>
            <p>Enter your account</p>
            <div class="form-wrapper">

                <?php
                // Check if there is an error message in the session
                if (isset($_SESSION['error'])) { ?>
                    <div class="error-message">
                        <?php echo $_SESSION['error'];
                        unset($_SESSION['error']);

                        ?>
                    </div>
                <?php } else if (isset($_SESSION['message'])) {
                    ?>
                        <div class="success-message">
                        <?php echo $_SESSION['message'];
                        unset($_SESSION['message']);

                        ?>
                        </div>
                    <?php
                }
                ?>

                <form action="../../route/web.php" method="post" class="signup-form">
                    <div class="input-wrapper">
                        <input type="text" name="email" placeholder="Username" class="input-text">
                    </div>
                    <div class="input-wrapper">
                        <input type="password" name="password" placeholder="Password" class="input-text">
                    </div>
                    <br>
                    <button type="submit" name="action" value="login" class="submit-button btn">LOGIN</button>
                    <p class="bottom-p-text">Don't have an account yet? Sign up <a class="link" href="indexsignup.php">
                            here!</a></p>
                </form>
            </div>
        </div>
    </main>
</body>

</html>