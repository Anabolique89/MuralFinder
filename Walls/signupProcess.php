<?php
if (isset($_POST['save'])) {
    require_once("addWall-config.php");
    $sc = new addWallConfig();

    $sc->setName($_POST['name']);
    $sc->setStatus($_POST['status']);
    $sc->setAddress($_POST['address']);
    $sc->setAbout($_POST['about']);


    $sc->insertData();
    echo "<script>alert('Data saved successfully');document.location='walls.php'</script>";
}
