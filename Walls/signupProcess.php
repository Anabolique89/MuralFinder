<?php
if (isset($POST['save'])) {
    require_once("signupConfig.php");
    $sc = new addWallConfig();

    $sc->setName($_POST['name']);
    $sc->setStatus($_POST['status']);
    $sc->setAddress($_POST['address']);
    $sc->setAbout($_POST['about']);

    $sc->insertData();
    echo "<script>alert('Data saved successfully');document.location='Walls.php'</script>";
}
