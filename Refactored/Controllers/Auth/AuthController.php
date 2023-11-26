<?php
namespace Refactored\Controllers\Auth;

use Refactored\Controllers\Profile\ProfileController;
use Refactored\Database\Models\User;

class AuthController extends User
{

    public function login($request)
    {

        $user = new User();
        $user->setEmail($request['email']);
        $user->setPassword($request['password']);
        $result = $user->loginUser();
        header("Location: ../../views/profile/profile.php");
    }

    public function register($request)
    {
        $user = new User();
        $user->setName($request['name']);
        $user->setEmail($request['email']);
        $password = $request['password'];
        $passwordRepeat = $request['passwordRepeat'];

        if ($user->setPasswordAndCheckMatch($password, $passwordRepeat)) {
            $result = $user->save();
        } else {
            $_SESSION['error'] = "Passwords do not match.";
            header("Location: " . $_SERVER['HTTP_REFERER']);
            exit();
        }

        header("Location: ../../views/profile/profile.php");

    }

    public function logout()
    {
        $this->logout();
        header("Location: ../../views/auth/indexlogin.php");
    }

    public function deleteAccount($userId)
    {
        $user = new User();
        $profileController = new ProfileController();

        $user->setId($userId);

        // Delete the user account and associated profile
        $userResult = $user->delete();
        $profileResult = $profileController->deleteProfile($userId);

        // Log out the user
        $this->logout();

        // Check if both operations were successful
        if ($userResult['success'] && $profileResult['success']) {
            $_SESSION['message'] = 'Account and associated profile deleted successfully.';
            header("Location: /home.php");
            exit();
        } else {
            $_SESSION['error'] = 'Error deleting account or profile.';
            header("Location: " . $_SERVER['HTTP_REFERER']);
            exit();
        }
    }



}
