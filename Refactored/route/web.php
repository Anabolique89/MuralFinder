<?php

/**
 * This file handles POST and PUT requests for various actions related to authentication and user actions.
 *
 * PHP version 8.2
 *
 * @category Route
 * @package  Refactored\Route
 * @author   @Andrew21-mch <nfonandrew73@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://your-website.com
 */

namespace Refactored\Route;

use Refactored\Controllers\Artwork\ArtworkController;
use Refactored\Controllers\Auth\AuthController;
use Refactored\Controllers\Profile\ProfileController;

/**
 * Check if a session is not already started.
 */
if (session_status() == PHP_SESSION_NONE) {
    // Start the session
    session_start();
}


/**
 * Handle different HTTP request methods.
 */
if ($_SERVER['REQUEST_METHOD'] === 'POST' || $_SERVER['REQUEST_METHOD'] === 'PUT') {
    $action = isset($_POST['action']) ? $_POST['action'] : '';

    /**
     * Switch statement to perform different actions based on the 'action' parameter.
     */
    switch ($action) {
        case 'register':
            $authController = new AuthController();
            $authController->register($_POST);
            break;

        case 'login':
            $authController = new AuthController();
            $authController->login($_POST);
            break;

        case 'update_profile':
            $profileController = new ProfileController();
            $profileController->updateProfile($_SESSION['userid'], $_POST['bio']);
            break;

        case 'upload_profile_image':
            $profileController = new ProfileController();
            $profileController->uploadProfileImage($_SESSION['userid'], $_FILES['image']);
            break;


        case 'delete_account':
            $authController = new AuthController();
            $authController->deleteAccount($_POST['user_id']);
            break;


        case 'add_artwork':
            $artworkController = new ArtworkController();
            $artworkController->store($_POST, $_FILES);
            break;

        case 'update_artwork':
            $artworkController = new ArtworkController();
            $artworkController->update($_POST, $_FILES);
            break;

        case 'delete_artwork':
            $artworkController = new ArtworkController();
            $artworkController->delete($_POST['id']);
            break;


        case 'logout':
            $authController = new AuthController();
            $authController->logout();
            break;

        default:
            // No action specified.
            break;
    }
} else {
    // Unsupported HTTP method
    $_SESSION['message'] = 'Unsupported HTTP method';
    header("Location: error_page.php");
    exit();
}
