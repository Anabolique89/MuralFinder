<?php
session_start();
include_once "includes/dbh.inc.php";

$id = $_SESSION['userid'];

if (isset($_POST['submit'])) {
    $file = $_FILES['file'];
    $fileName = $_FILES['file']['name'];
    $fileTmpName = $_FILES['file']['tmp_name'];
    $fileSize = $_FILES['file']['size'];
    $fileError = $_FILES['file']['error'];
    $fileType = $_FILES['file']['type'];

    $fileExt = explode('.', $fileName);
    $fileActualExt = strtolower(end($fileExt));
    $allowed = array('jpg', 'jpeg', 'png', 'gif');

    if (in_array($fileActualExt, $allowed) && $fileError === 0 && $fileSize < 5000000) {
        $stmt = mysqli_stmt_init($conn);

        // Check if a profile image exists
        $sqlCheckImage = "SELECT COUNT(*) as imageCount, NewImgName FROM profileimg WHERE UserID=?";
        if (mysqli_stmt_prepare($stmt, $sqlCheckImage)) {
            mysqli_stmt_bind_param($stmt, "s", $id);
            mysqli_stmt_execute($stmt);
            $resultCheckImage = mysqli_stmt_get_result($stmt);
            $rowCheckImage = mysqli_fetch_assoc($resultCheckImage);

            $oldImageName = $rowCheckImage['NewImgName'];

            // Delete the old image
            if (!empty($oldImageName)) {
                $oldImagePath = 'artworks/' . $oldImageName;
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }

            // Upload the new image
            $fileNameNew = "artworks" . $id . "." . $fileActualExt;
            $fileDestination = 'artworks/' . $fileNameNew;
            if (move_uploaded_file($fileTmpName, $fileDestination)) {
                // Update or insert into the database
                if ($rowCheckImage['imageCount'] > 0) {
                    $sqlUpdate = "UPDATE profileimg SET NewImgName=?, status=0 WHERE UserID=?";
                } else {
                    $sqlUpdate = "INSERT INTO profileimg (UserID, NewImgName, status) VALUES (?, ?, 0)";
                }

                if (mysqli_stmt_prepare($stmt, $sqlUpdate)) {
                    mysqli_stmt_bind_param($stmt, "ss", $id, $fileNameNew);
                    mysqli_stmt_execute($stmt);
                    header("Location: profile.php?uploadsuccess");
                    exit();
                } else {
                    echo "SQL statement failed!";
                }
            } else {
                echo "There was an error uploading your file!";
            }
        } else {
            echo "SQL statement failed!";
        }
    } else {
        echo "Invalid file format or file size exceeds the limit.";
    }
}
