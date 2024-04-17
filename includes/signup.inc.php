<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && !isset($_POST['follower'])) {

    //grabbing the data

    $username = htmlspecialchars($_POST["username"], ENT_QUOTES, 'UTF-8');
    $pwd = htmlspecialchars($_POST["pwd"], ENT_QUOTES, 'UTF-8');
    $pwdRepeat = htmlspecialchars($_POST["pwdRepeat"], ENT_QUOTES, 'UTF-8');
    $email = htmlspecialchars($_POST["email"], ENT_QUOTES, 'UTF-8');
    $profile = htmlspecialchars($_POST["UserProfile"], ENT_QUOTES, 'UTF-8');
    $role = htmlspecialchars($_POST["Role"], ENT_QUOTES, 'UTF-8');

    if (empty($role)) {
        $role = "Admin";
    }

    //instantiate signup controller class - create an object based off  a class 

    include "../classes/dbh.classes.php";
    include "../classes/signup.classes.php";
    include "../classes/signup.contr.classes.php";

    $signup = new SignupContr($username, $pwd, $pwdRepeat, $email, $profile, $role);


    //running error handlers & user signup
    $signup->signupUser();


    $userID = $signup->fetchUserId($username);

    //Instantiate ProfileInfoContr class
    include "../classes/profileinfo.classes.php";
    include "../classes/profileinfo-contr.classes.php";
    $profileInfo = new ProfileInfoContr($username, $userID);
    $profileInfo->defaultProfileInfo();

    $_SESSION["userid"] =  $userID;
    $_SESSION["username"] = $username;
    $_SESSION["Role"] = $role;



    //create profile from our user


    //going back to front page 
    header("location: ../profile.php?error=none");
    exit();
}

//FOLLOW USER

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['follow'])) {

    try {
        $follower =  $_POST['follower'];
        $followed =  $_POST['followed'];
        $dbCnx = new PDO('mysql:host=localhost;dbname=ArtzoroDB3', "root", "");
        $stm = $dbCnx->prepare("INSERT INTO followers(follower_id, followed_id, date_time) VALUES (?, ?, NOW())");
        $stm->execute([$follower, $followed]);

        echo    "<script>
                    alert('Data saved successfully');
                    document.location='../profile.php';
                </script>";
    } catch (Exception $e) {
        return $e->getMessage();
    }
} else {
    echo 'else';
}

// UNFOLLOW USER
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['unfollow'])) {

    try {
        $follower =  $_POST['follower'];
        $followed =  $_POST['followed'];
        $dbCnx = new PDO('mysql:host=localhost;dbname=ArtzoroDB3', "root", "");
        $stm = $dbCnx->prepare("DELETE FROM followers WHERE follower_id = ? AND followed_id = ?");
        $stm->execute([$follower, $followed]);

        echo    "<script>
                    alert('Data removed successfully');
                    document.location='../profile.php';
                </script>";
    } catch (Exception $e) {
        return $e->getMessage();
    }
} else {
    echo 'else';
}
