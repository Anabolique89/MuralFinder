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
                        <li><a href="walls.php">WALLS</a></li>
                        <li><a href="../community.php">COMMUNITY</a></li>
                        <li><a href="../Legal/FAQS.php">FAQ's</a></li>
                        <li><a href="../Contact/contactPage.php">CONTACT</a></li>
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
        <main>
            <!-- find  new walls section -->
            <section class="index-intro">
                <div class="index-intro-bg">

                    <div class="wrapper">

                        <div class="index-intro-c1">

                            <div class="video">
                                <img src="../img/graphics/hologram.png" alt="fluidelement4" class="hero-graphic5">
                            </div>
                            <p class="cardss">If you are an artist or a stakeholder and you want to share a new painted wall with the world or for others to paint on, just add a pin on our map.
                                <br> <br>Just make sure the wall is a legal one and artists are allowed to paint there freely without any trouble. How to make sure? Check out our blogs for more info on how to tell the difference.
                                <!-- <br><br> Otherwise, if it's a permanent artwork, set the wall as illegal and people will visit your spot to see your amazing work! -->
                            </p>
                        </div>
                        <div class="index-intro-c2">
                            <h2>Publish New<br>Walls</h2>
                            <a href="map.php">ADD WALLS</a>
                        </div>
                    </div>
                </div>
            </section>
            <section class="all-walls">

                <h2>List of all walls</h2>
                <a href="addWall.php" class="btn-add-wall">Add New Wall</a>
                <br>
                <br>
                <table>
                    <tr>
                        <th>Name</th>
                        <th>Status</th>
                        <th>Address</th>
                        <th>About</th>
                        <th>action</th>
                    </tr>

                </table>
            </section>

            <section class="register-wall">
                <h3 class="add-new-wall-h3">Fill out this information to add a new wall</h3>
                <div class="container">
                    <form action="signupProcess.php" method="post">
                        <label for="name">Name</label>
                        <input type="text" id="name" name="name" placeholder="Wall name...">

                        <label for="name">Status</label>
                        <input type="text" id="status" name="status" placeholder="Wall status...">

                        <label for="name">Address</label>
                        <input type="text" id="address" name="address" placeholder="Wall address...">

                        <label for="name">About</label>
                        <input type="text" id="about" name="about" placeholder="About...">

                        <input type="submit" value="save" name="save">
                    </form>
                </div>
            </section>

        </main>
</body>

</html>