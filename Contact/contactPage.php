<?php

session_start();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ArtZoro Presentation Website</title>
    <link rel="stylesheet" href="../css/style1.css">
    <link rel="stylesheet" href="../css/legal.css">
    <link rel="stylesheet" href="../css/footer.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">

</head>

<body>
    <div class="homepage">
        <header class="main-header">

            <nav class="main-nav">
                <div class="navigation-container">
                    <div class="logo-container"><a href="../webpage.php"><img class="logo" src="../img/LOGOBlack.png" alt="logo white"></a></div>
                    <ul class="menu-main">
                        <li><a href="../webpage.php">HOME</a></li>
                        <li><a href="../about.php">ABOUT</a></li>
                        <li><a href="../map.php">MAP</a></li>
                        <li><a href="../walls.php">WALLS</a></li>
                        <li><a href="../community.php">COMMUNITY</a></li>
                        <li><a href="../Legal/FAQS.php">FAQ's</a></li>
                        <li><a href="contactPage.php">CONTACT</a></li>
                    </ul>
                </div>
                <ul class="menu-member">
                    <?php
                    if (isset($_SESSION["userid"])) {
                    ?>
                        <li><a href="../profile.php"><?php echo $_SESSION["username"]; ?></a></li>
                        <li><a href="includes/logout.inc.php" class="header-login-a">LOGOUT</a></li>
                    <?php
                    } else {
                    ?>
                        <li><a href="indexsignup.php">SIGN UP</a></li>
                        <li><a href="indexlogin.php" class="header-login-a ">LOGIN</a></li>
                    <?php
                    }
                    ?>
                </ul>
            </nav>
        </header>

        <body>
            <main class="main">
                <img src="../img/graphics/bubbles.png" class="hero-graphic0" alt="hero-graphic0">

                <div class="onboarding-page3">
                    <div class="contact-form-wrapper">

                        <h1 class="roboto-uppercase-heading">Contact Form</h1>
                        <br>
                        <?php
                        if (isset($_GET["maximumLimitReached"])) {
                            echo "<div class='alert alert-danger'>Maximum Limit Reached</div>";
                        }
                        ?>
                        <form class="about-form" action="contactform.php" method="post">
                            <div class="input-wrapper2">
                                <input type="text" name="name" placeholder="Name" class="input-text2" required>
                            </div><br>
                            <div class="input-wrapper2">
                                <input type="text" name="mail" placeholder="Email" class="input-text2" required>
                            </div><br>
                            <div class="input-wrapper2">
                                <input type="text" name="subject" placeholder="Subject" class="input-text2" required>
                            </div>
                            <br>
                            <div class="input-wrapper2">
                                <textarea name="message" rows="10" cols="30" class="input-text2" placeholder="Your message here..."></textarea>
                            </div>
                            <br>
                            <button class="follow-btn" type="submit" name="submit">SEND</button>

                        </form>
                    </div>
                </div>
            </main>
        </body>

</html>