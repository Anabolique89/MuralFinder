<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function getUserIP()
{
    // Check for shared Internet/ISP IP
    if (!empty($_SERVER['HTTP_CLIENT_IP']) && filter_var($_SERVER['HTTP_CLIENT_IP'], FILTER_VALIDATE_IP)) {
        return $_SERVER['HTTP_CLIENT_IP'];
    }
    // Check for IP from a proxy or load balancer
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']) && filter_var($_SERVER['HTTP_X_FORWARDED_FOR'], FILTER_VALIDATE_IP)) {
        return $_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    // Check for a public IP address
    elseif (!empty($_SERVER['REMOTE_ADDR']) && filter_var($_SERVER['REMOTE_ADDR'], FILTER_VALIDATE_IP)) {
        return $_SERVER['REMOTE_ADDR'];
    }
    // Return IP address
    else {
        return 'UNKNOWN';
    }
}

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $subject = $_POST['subject'];
    $mailFrom = $_POST['mail'];
    $message = $_POST['message'];

    $userIP = getUserIP();

    // Check if the user has already submitted the form
    // var_dump($userIP);
    // die();

    if (isset($_SESSION['submission_count'][$userIP]) && $_SESSION['submission_count'][$userIP] >= 2) {
        header("Location: webpage.php?maximumLimitReached");
        exit(); // Stop further execution
    }

    // Increment the submission count for the user's IP
    $_SESSION['submission_count'][$userIP] = isset($_SESSION['submission_count'][$userIP]) ? $_SESSION['submission_count'][$userIP] + 1 : 1;


    $mailTo = "ninandreea@cosmicstryder.dk";
    $headers = "From: " . $mailFrom;
    $txt = "You have received an email from " . $name . " . \n\n" . $message;

    mail($mailTo, $subject, $txt, $headers);
    header("Location: webpage.php?mailsend");
    exit();
}
