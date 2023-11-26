<?php

include_once "../components/header.php";

?>

<section class="profile">
    <div class="profile-bg">
        <div class="wrapper">
            <div class="profile-info">
                <div class="profile-info-img">

                    <p>
                        <?php

                        if (isset($_SESSION['name']) && !empty($_SESSION['username'])) {
                            echo $_SESSION["name"];
                        }

                        ?>
                    </p>
                    <div class="break"></div>
                    <a href="profilesettings.php" class="follow-btn">PROFILE SETTINGS</a>
                </div>
                <div class="profile-info-about">
                    <h3>ABOUT</h3>
                    <p>
                        <?php
                        $profileInfo->fetchAbout($_SESSION["userid"]);
                        ?>
                    </p>
                    <h3>FOLLOWERS</h3>
                    <h3>FOLLOWING</h3>
                </div>
            </div>
            <div class="profile-content">
                <div class="profile-intro">

                </div>
                <div class="profile-posts">
                    <h3>POSTS</h3>
                    <div class="profile-post">
                        <h2>IT IS A BUSY DAY IN TOWN</h2>
                        <p>Sed porttitor nulla quis lectus gravida rutrum. Fusce dapibus odio id nibh tincidunt finibus.
                            Praesent in massa at urna feugiat iaculis. Vivamus dictum ante in eleifend semper. Cras nec
                            maximus ante. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere
                            cubilia curae; Nullam diam ligula, semper sed semper posuere.</p>
                        <p>12:46 - 09/11/2021</p>
                    </div>
                    <div class="profile-post">
                        <h2>RE-USING ELECTRONICS IS A GOOD IDEA</h2>
                        <p>Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Ut
                            lacinia ligula eget gravida fermentum. Curabitur arcu risus, ornare eu nibh a, porta
                            interdum nunc. Mauris gravida velit dui, eu ultrices lacus finibus sit amet.</p>
                        <p>16:11 - 11/11/2021</p>
                    </div>
                </div>
                <!-- trying to add new image to database stoing in project folder 
                <div class="add-new-artwork">
                    <p class="artwork">Add new artwork</p>
                    <form action="upload.php" class="artwork" method="POST" enctype="multipart/form-data">
                        <input type="file" name="file">
                        <button class="artwork-submit" type="submit" name="submit">UPLOAD</button>

                    </form>
                </div>
-->

            </div>
        </div>
        <!--Artwork Gallery-->

        <div class="cases-links">
            <div class="gallery-wrapper">
                <h2 class="Artworks-title">Artworks</h2>
                <div class="gallery-container">

                </div>
                <?php
                if (isset($_SESSION['username'])) {
                    echo '<div class="gallery-upload">
    <form class="form-signup" action="includes/gallery-upload.inc.php" method="post" enctype="multipart/form-data">
        <input type="text" name="filename" placeholder="File name...">
        <input type="text" name="filetitle" placeholder="Image title...">
        <input type="text" name="filedesc" placeholder="Image Description...">
       
        <input type="file" name="file">
        <button type="submit" name="submit">UPLOAD</button>
    </form>
</div> ';
                }
                ?>
            </div>
        </div>
    </div>
</section>

</body>

</html>