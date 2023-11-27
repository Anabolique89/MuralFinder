<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once __DIR__ . '/../../vendor/autoload.php';

use Database\Models\Profile;

include_once "../components/header.php";


?>

<section class="profile">
    <div class="profile-bg">
        <div class="wrapper">
            <div class="profile-settings">
                <h3>PROFILE SETTINGS</h3>
                <p>Change your profile picture here!</p>

                <?php
                $profile = Profile::fetchProfile($_SESSION['userid']);

                ?>

                <div class="profile-change-wrapper">
                    <div class="user-container">
                        <?php
                        if ($profile['profile_img'] != null) {
                            ?>
                            <img src='../../assets/profile_images/<?php echo $profile['profile_img']; ?>'>
                            <?php
                        } else {
                            ?>
                            <img src='artworks/Default.jpg'>
                            <?php
                        } ?>
                    </div>
                </div>


                <?php
                if (isset($_SESSION['userid'])) { ?>
                    <form action="../../route/web.php" method="POST" enctype="multipart/form-data">
                        <input type="file" name="image">
                        <button type="submit" name="action" value="upload_profile_image" >UPLOAD</button>
                    </form>
                <?php } else { ?>
                    You are not logged in!
                <?php } ?>



            <!-- everything below works -->
            <p>Change your about section here!</p>
            <form action="../../route/web.php" method="post">
                <textarea name="about" rows="10" cols="30" placeholder="Profile about section..." value="">
                        <?php echo $profile["bio"]; ?>
                    </textarea>
                <br><br>
                <p>Change your profile page intro here!</p>
                <br>
                <input type="text" name="introtitle" placeholder="Profile title..."
                    value="<?php echo $profile['bio']; ?>">
                <textarea name="introtext" rows="10" cols="30"
                    placeholder="Profile introduction..."><?php echo $profile['bio']; ?></textarea>
                <button type="submit" name="submit">SAVE</button>
            </form>
            <br>

            <!-- I also want to be able to change this info for the user - note to myself -->
            <p>Change your bio info here!</p>
            <br>
            <form action="" method="post">
                <input type="text" name="firstName" placeholder="First Name">
                <input type="text" name="lastName" placeholder="Last Name">
                <input type="date" name="dob" placeholder="Date of Birth">
                <button type="submit" name="submitUserInfo">SAVE</button>

            </form>
        </div>
    </div>
    </div>
</section>

</body>

</html>