<?php

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


                <!-- everything below works -->
                <p>Change your about section here!</p>
                <form action="includes/profileinfo.inc.php" method="post">
                    <textarea name="about" rows="10" cols="30" placeholder="Profile about section..." value="">
                        <?php echo $profile["bio"]; ?>
                    </textarea>
                    <br><br>
                    <p>Change your profile page intro here!</p>
                    <br>
                    <input type="text" name="introtitle" placeholder="Profile title..." value="<?php echo $profile['bio']; ?>">
                    <textarea name="introtext" rows="10" cols="30" placeholder="Profile introduction..."><?php echo $profile['bio']; ?></textarea>
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