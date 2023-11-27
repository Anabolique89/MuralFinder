<?php

namespace Controllers\Profile;

use Database\Models\Profile;

/**
 * Profile Controller Class
 */
class ProfileController extends Profile
{
    /**
     * Display the user's profile.
     *
     * @param int $userId User ID.
     *
     * @return array Result of the fetch operation.
     */
    public function showProfile($userId)
    {
        $profileData = $this->fetchProfile($userId);

        if ($profileData) {
            return [
                'success' => true,
                'profile' => $profileData
            ];
        } else {
            return [
                'success' => false,
                'message' => 'Profile not found.'
            ];
        }
    }

    /**
     * Update the user's profile.
     *
     * @param int    $userId User ID.
     * @param string $bio    New bio for the profile.
     *
     * @return array Result of the update operation.
     */
    public function updateProfile($userId, $bio)
    {
        $this->setUserId($userId);
        $this->setBio($bio);

        return $this->update();
    }

    /**
     * Delete the user's profile.
     *
     * @param int $userId User ID.
     *
     * @return array Result of the delete operation.
     */
    public function deleteProfile($userId)
    {
        $this->setUserId($userId);

        return $this->delete();
    }

    /**
     * Upload a profile image for the user.
     *
     * @param int    $userId User ID.
     * @param array  $image  Image file information ($_FILES['file']).
     *
     * @return array Result of the upload operation.
     */
    public function uploadProfileImage($userId, $image)
    {
        // Check if the user exists
        $profileData = $this->fetchProfile($userId);
        if (!$profileData) {
            return ['success' => false, 'message' => 'User not found.'];
        }

        $uploadDirectory = __DIR__ . '/../../assets/profile_images/';
        $imageFileType = strtolower(pathinfo($image['name'], PATHINFO_EXTENSION));

        // Generate a random image name
        $randomImageName = uniqid('profile_img_') . '.' . $imageFileType;

        // Check if the old image exists and delete it
        $oldImageName = $profileData['profile_img'];
        if (!empty($oldImageName) && file_exists($uploadDirectory . $oldImageName)) {
            unlink($uploadDirectory . $oldImageName);
        }

        // Move the uploaded file to the target directory
        if (move_uploaded_file($image['tmp_name'], $uploadDirectory . $randomImageName)) {
            // Update the database with the new profile image
            $updateResult = $this->updateProfileImage($profileData['user_id'], $randomImageName);

            if ($updateResult) {
                return ['success' => true, 'message' => 'Profile image uploaded successfully'];
            } else {
                return ['success' => false, 'message' => 'Error updating the profile image in the database'];
            }
        } else {
            return ['success' => false, 'message' => 'Error moving the uploaded file'];
        }
    }

}
