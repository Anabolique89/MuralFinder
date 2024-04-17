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
                        <li><a href="FAQS.php">FAQ's</a></li>
                        <li><a href="../Contact/contactPage.php">CONTACT</a></li>
                    </ul>
                </div>
                <ul class="menu-member">
                    <?php
                    if (isset($_SESSION["userid"])) {
                    ?>
                        <li><a href="profile.php"><?php echo $_SESSION["username"]; ?></a></li>
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

        <div class="wrapper-faqs">

            <div class="container">
                <div class="question">
                    How can I increase my online presence??
                </div>
                <div class="answercont">
                    <div class="answer">
                        In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content.
                        Lorem ipsum may be used as a placeholder before the final copy is available.<br><br>

                        <a href="https://blog.codepen.io/documentation/features/email-verification/#how-do-i-verify-my-email-2">How to Verify Email Docs</a>
                    </div>
                </div>
            </div>

            <div class="container">
                <div class="question">
                    Can I delete images I have added to my gallery?
                </div>
                <div class="answercont">
                    <div class="answer">
                        It's likely an infinite loop in JavaScript that we could not catch. To fix, add ?turn_off_js=true to the end of the URL (on any page, like the Pen or Project editor, your Profile page, or the Dashboard) to temporarily turn off JavaScript. When you're ready to run the JavaScript again, remove ?turn_off_js=true and refresh the page.<br><br>

                        <a href="https://blog.codepen.io/documentation/features/turn-off-javascript-in-previews/">How to Disable JavaScript Docs</a>
                    </div>
                </div>
            </div>

            <div class="container">
                <div class="question">
                    How can I add a pin on the map?
                </div>
                <div class="answercont">
                    <div class="answer">
                        You can leave a comment on any public Pen. Click the "Comments" link in the Pen editor view, or visit the Details page.<br><br>

                        <a href="https://blog.codepen.io/documentation/faq/how-do-i-contact-the-creator-of-a-pen/">How to Contact Creator of a Pen Docs</a>
                    </div>
                </div>
            </div>

            <div class="container">
                <div class="question">
                    What kind of walls do I find on the map?
                </div>
                <div class="answercont">
                    <div class="answer">
                        In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or a typeface without relying on meaningful content.
                        Lorem ipsum may be used as a placeholder before the final copy is available.<a href="https://codepen.io/versions">here</a>

                    </div>
                </div>
            </div>

            <div class="container">
                <div class="question">
                    How can I change my profile picture?
                </div>
                <div class="answercont">
                    <div class="answer">
                        Try accessing the Profile Settings page, found on your profile section. There you can update your profile punchline, profile info and bio. Your forked copy comes with everything the original author wrote, including all of the code and any dependencies.<br><br>

                        <a href="https://blog.codepen.io/documentation/features/forks/">Learn More About Forks</a>
                    </div>
                </div>
            </div>

        </div>
        <?php

        include_once "../footer.php";
        ?>
</body>
<script src="legal.js"></script>
<script src="https://storage.ko-fi.com/cdn/scripts/overlay-widget.js"></script>

</html>