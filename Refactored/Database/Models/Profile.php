<?php

/**
 * Profile Model Class
 *
 * PHP version 8.2
 *
 * @category Model
 * @package   Database\Models
 * @author   @Andrew21-mch nfonandrew73@gmail.com
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://your-website.com
 */

namespace Database\Models;

require_once __DIR__ . '/../../vendor/autoload.php';


use Database\Connection;

/**
 * Profile Model Class extending Connection.
 */
class Profile extends Connection
{
    /**
     * @var int|null User ID.
     */
    protected $userId;

    /**
     * @var string|null Bio of the user profile.
     */
    protected $bio;

    /**
     * @var \PDO Database connection.
     */
    protected $conn;

    /**
     * Constructor to initialize the profile with optional user ID and bio.
     *
     * @param int|null    $userId User ID.
     * @param string|null $bio    Bio of the user profile.
     */
    public function __construct($userId = null, $bio = null)
    {
        $this->userId = $userId;
        $this->bio = $bio;
        $this->conn = $this->connect();
    }

    /**
     * Set the user ID for the profile.
     *
     * @param int $userId User ID.
     *
     * @return void
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;
    }

    /**
     * Set the bio for the user profile.
     *
     * @param string $bio Bio of the user profile.
     *
     * @return void
     */
    public function setBio($bio)
    {
        $this->bio = $bio;
    }

    /**
     * Get the user ID for the profile.
     *
     * @return int|null User ID.
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Get the bio for the user profile.
     *
     * @return string|null Bio of the user profile.
     */
    public function getBio()
    {
        return $this->bio;
    }

    /**
     * Save the profile to the database.
     *
     * @return array Result of the save operation.
     */
    public function save()
    {
        // Begin a new transaction for the profile
        $this->conn->beginTransaction();

        try {
            // Save profile data
            $stmt = $this->conn->prepare('INSERT INTO profiles (user_id, bio) VALUES (?, ?)');
            $stmt->execute([$this->getUserId(), $this->getBio()]);

            // Commit the profile transaction
            $this->conn->commit();

            return [
                'success' => true,
                'message' => "Profile saved to the database."
            ];
        } catch (\PDOException $e) {
            // Rollback the transaction on error
            $this->conn->rollBack();

            return [
                'success' => false,
                'message' => "Error: " . $e->getMessage()
            ];
        }
    }

    /**
     * Update the user profile in the database.
     *
     * @return array Result of the update operation.
     */
    public function update()
    {
        try {
            // Update profile data
            $stmt = $this->conn->prepare('UPDATE profiles SET bio = ? WHERE user_id = ?');
            $stmt->execute([$this->getBio(), $this->getUserId()]);

            return [
                'success' => true,
                'message' => "Profile updated in the database."
            ];
        } catch (\PDOException $e) {
            return [
                'success' => false,
                'message' => "Error: " . $e->getMessage()
            ];
        }
    }

    /**
     * Delete the user profile from the database.
     *
     * @return array Result of the delete operation.
     */
    public function delete()
    {
        try {
            // Delete profile data
            $stmt = $this->conn->prepare('DELETE FROM profiles WHERE user_id = ?');
            $stmt->execute([$this->getUserId()]);

            return [
                'success' => true,
                'message' => "Profile deleted from the database."
            ];
        } catch (\PDOException $e) {
            return [
                'success' => false,
                'message' => "Error: " . $e->getMessage()
            ];
        }
    }

    /**
     * Fetch the user profile by user ID.
     *
     * @param int $userId User ID.
     *
     * @return array|null|Profile Profile data.
     */
    public static function fetchProfile($userId)
    {
        $conn = self::connect();

        try {
            $stmt = $conn->prepare('SELECT * FROM profiles WHERE user_id = ?');
            $stmt->execute([$userId]);
            $profileData = $stmt->fetch(\PDO::FETCH_ASSOC);

            if ($profileData) {
                return $profileData;
            } else {
                // If no profile data, create a new profile with an empty bio
                $profile = new Profile();
                $profile->setUserId($userId);
                $profile->setBio('');
                $profile->save();
            }

            return $profile;
        } catch (\PDOException $e) {
            return null;
        }
    }

    /**
     * Get the user by ID.
     *
     * @param int $userId User ID.
     *
     * @return array|null User data.
     */
    private function getUserById($userId)
    {
        $stmt = $this->conn->prepare('SELECT * FROM users WHERE id = ?');
        $stmt->execute([$userId]);
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    /**
     * Update the profile image in the database.
     *
     * @param int    $userId   User ID.
     * @param string $fileName File name of the uploaded image.
     *
     * @return bool
     */
    protected function updateProfileImage($userId, $fileName)
    {
        try {
            $stmt = $this->conn->prepare('UPDATE profiles SET profile_img = ? WHERE user_id = ?');
            $stmt->execute([$fileName, $userId]);

            // Check if the update was successful
            return $stmt->rowCount() > 0;
        } catch (\PDOException $e) {
            // Handle any potential exceptions (e.g., database connection issues)
            return false;
        }
    }

}
