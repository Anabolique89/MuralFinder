<?php

namespace  Controllers\Profile;
use  Database\Models\Profile;

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
     * @param string $image  Image file.
     *
     * @return array Result of the upload operation.
     */
    public function uploadProfileImage($userId, $image)
    {
        // Additional logic for uploading profile image
        // ...

        return ['success' => true, 'message' => 'Profile image uploaded successfully'];
    }

    /**
     * Other profile-related methods...
     */
}
