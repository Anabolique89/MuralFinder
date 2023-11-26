<?php

/**
 * User Model Class
 *
 * PHP version 8.2
 *
 * @category Model
 * @package  Refactored\Database\Models
 * @author   @Andrew21-mch nfonandrew73@gmail.com
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://your-website.com
 */

namespace Refactored\Database\Models;

use Database\Connection;

/**
 * User Model Class extending Connection.
 */
class User extends Connection
{

    protected int $id;


    protected string $name;


    protected string $email;

    protected string $password;

    protected Profile $profile;

    /**
     * @var \PDO Database connection.
     */
    protected $conn;

    /**
     * Constructor to initialize the database connection.
     */
    public function __construct()
    {
        $this->conn = $this->connect();
    }


    public function setId($id): void
    {
        $this->id = $id;
    }


    public function getId(): int
    {
        return $this->id;
    }

    public function setName($name): void
    {
        $this->name = $name;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setEmail($email): void
    {
        $this->email = $email;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setPassword($password):void
    {
        $this->password = $password;
    }

    /**
     * Hash the provided password.
     *
     * @param string $password User password.
     *
     * @return string Hashed password.
     */
    public function hashPassword($password)
    {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        return $hashedPassword;
    }

    /**
     * Set the user password and check for a match.
     *
     * @param string $password      User password.
     * @param string $passwordRepeat Repeat of the user password.
     *
     * @return bool Whether passwords match.
     */
    public function setPasswordAndCheckMatch($password, $passwordRepeat): bool
    {
        // Check if the provided passwords match
        if ($password === $passwordRepeat) {
            // If they match, set the hashed password
            $this->setPassword($password);
            return true; // Indicate that passwords match
        } else {
            return false; // Indicate that passwords do not match
        }
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * Set the user profile.
     *
     * @param Profile $profile User profile.
     *
     * @return void
     */
    public function setProfile(Profile $profile)
    {
        $this->profile = $profile;
    }

    /**
     * Get the user profile.
     *
     * @return Profile|null User profile.
     */
    public function getProfile(): profile|null
    {
        $existingProfile = Profile::fetchProfile($this->getId());
        return $existingProfile;
    }

    /**
     * Save user and associated profile to the database.
     *
     * @return array Result of the save operation.
     */
    public function save()
    {
        // Transaction to ensure data consistency
        $this->conn->beginTransaction();

        try {
            // Save user data
            $stmt = $this->conn->prepare('INSERT INTO users (name, email, password) VALUES (?, ?, ?)');
            $stmt->execute([$this->getName(), $this->getEmail(), $this->hashPassword($this->getPassword())]);
            $userId = $this->conn->lastInsertId();

            // Commit the user transaction
            $this->conn->commit();

            // Create a new Profile instance
            $profile = new Profile();
            $profile->setUserId($userId);
            $profile->setBio('');

            // Save the profile
            $profileSaveResult = $profile->save();

            // Check if the profile save was successful
            if ($profileSaveResult['success']) {
                return [
                    'success' => true,
                    'message' => "User and associated profile saved to the database."
                ];
            } else {
                return [
                    'success' => false,
                    'message' => "Error saving profile: " . $profileSaveResult['message']
                ];
            }
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
     * Update user and associated profile in the database.
     *
     * @return array Result of the update operation.
     */
    public function update()
    {
        // Begin a transaction to ensure data consistency
        $this->conn->beginTransaction();

        try {
            // Update user data
            $stmt = $this->conn->prepare('UPDATE users SET name = ?, email = ?, password = ? WHERE id = ?');
            $stmt->execute([$this->getName(), $this->getEmail(), $this->getPassword(), $this->getId()]);

            // Update the associated profile
            $this->getProfile()->update();

            // Commit the transaction
            $this->conn->commit();

            return [
                'success' => true,
                'message' => "User and associated profile updated in the database."
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
     * Delete user and associated profile from the database.
     *
     * @return array Result of the delete operation.
     */
    public function delete()
    {
        // Begin a transaction to ensure data consistency
        $this->conn->beginTransaction();

        try {
            // Delete user data
            $stmt = $this->conn->prepare('DELETE FROM users WHERE id = ?');
            $stmt->execute([$this->getId()]);

            // Delete the associated profile
            $this->getProfile()->delete();

            // Commit the transaction
            $this->conn->commit();

            return [
                'success' => true,
                'message' => "User and associated profile deleted from the database."
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
     * Fetch user by user ID.
     *
     * @param int $userId User ID.
     *
     * @return array Result of the fetch operation.
     */
    public function fetchUser($userId)
    {
        // Begin a transaction to ensure data consistency
        $this->conn->beginTransaction();

        try {
            // Fetch user data
            $stmt = $this->conn->prepare('SELECT * FROM users WHERE id = ?');
            $stmt->execute([$userId]);
            $userData = $stmt->fetch(\PDO::FETCH_ASSOC);

            if ($userData) {
                $this->setId($userData['id']);
                $this->setName($userData['name']);
                $this->setEmail($userData['email']);
                $this->setPassword($userData['password']);

                // Fetch and set the associated profile
                $this->setProfile(Profile::fetchProfile($userId));

                // Commit the transaction
                $this->conn->commit();

                return [
                    'success' => true,
                    'message' => "User with ID $userId fetched from the database."
                ];
            } else {
                // Commit the transaction
                $this->conn->commit();

                return [
                    'success' => false,
                    'message' => "User with ID $userId not found."
                ];
            }
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
     * Login user and set session variables.
     *
     * @return array Result of the login operation.
     */
    public function loginUser()
    {
        // Check if the user with the provided email exists
        $user = $this->getUserByEmail($this->email);

        if ($user) {
            // Check if the provided password matches the stored hashed password
            if (password_verify($this->password, $user['password'])) {
                $_SESSION['userid'] = $user['id'];
                $_SESSION['name'] = $user['name'];
                return ['success' => true, 'message' => 'Login successful'];
            } else {
                return ['success' => false, 'message' => 'Incorrect password'];
            }
        } else {
            // User with the provided email doesn't exist
            return ['success' => false, 'message' => 'User not found'];
        }
    }

    /**
     * Fetch user by email.
     *
     * @param string $email User email.
     *
     * @return array|null User data.
     */
    private function getUserByEmail($email)
    {
        $stmt = $this->conn->prepare('SELECT * FROM users WHERE email = ?');
        $stmt->execute([$email]);
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }


}
