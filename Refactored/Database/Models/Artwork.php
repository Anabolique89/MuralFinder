<?php

/**
 * Artwork Model Class
 *
 * PHP version 8.2
 *
 * @category Model
 * @package   Database\Models
 * @author   @Andrew21-mch nfonandrew73@gmail.como
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://your-website.com
 */

namespace  Database\Models;

require_once __DIR__ . '/../../vendor/autoload.php';

use Database\Connection;

/**
 * Artwork Model Class extending Connection.
 */
class Artwork extends Connection
{
    /**
     * @var int|null Artwork ID.
     */
    private $artworkId;

    /**
     * @var string|null Title of the artwork.
     */
    private $title;

    /**
     * @var string|null Artist of the artwork.
     */
    private $artist;

    /**
     * @var string|null Description of the artwork.
     */
    private $description;

    /**
     * @var float|null Price of the artwork.
     */
    private $price;

    /**
     * @var \PDO Database connection.
     */
    private $conn;

    /**
     * Constructor to initialize the artwork with optional title, artist, description, and price.
     *
     * @param string|null $title       Title of the artwork.
     * @param string|null $artist      Artist of the artwork.
     * @param string|null $description Description of the artwork.
     * @param float|null  $price       Price of the artwork.
     */

    /**
     * Set the artwork ID.
     *
     * @return void Artwork ID.
     */
    public function setArtworkId($artworkId): void
    {
        $this->artworkId = $artworkId;
    }

    /**
     * Get the artwork ID.
     *
     * @return int|null Artwork ID.
     */
    public function getArtworkId()
    {
        return $this->artworkId;
    }

    /**
     * Set the title of the artwork.
     *
     * @param string $title Title of the artwork.
     *
     * @return void
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * Get the title of the artwork.
     *
     * @return string|null Title of the artwork.
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set the artist of the artwork.
     *
     * @param string $artist Artist of the artwork.
     *
     * @return void
     */
    public function setArtist($artist)
    {
        $this->artist = $artist;
    }

    /**
     * Get the artist of the artwork.
     *
     * @return string|null Artist of the artwork.
     */
    public function getArtist()
    {
        return $this->artist;
    }

    /**
     * Set the description of the artwork.
     *
     * @param string $description Description of the artwork.
     *
     * @return void
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * Get the description of the artwork.
     *
     * @return string|null Description of the artwork.
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set the price of the artwork.
     *
     * @param float $price Price of the artwork.
     *
     * @return void
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }

    /**
     * Get the price of the artwork.
     *
     * @return float|null Price of the artwork.
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Add an artwork to the system.
     *
     * @return array Result of the add operation.
     */
    public function addArtwork()
    {
        try {
            $stmt = $this->conn->prepare('INSERT INTO artworks (title, artist, description, price) VALUES (?, ?, ?, ?)');
            $stmt->execute([$this->getTitle(), $this->getArtist(), $this->getDescription(), $this->getPrice()]);

            return [
                'success' => true,
                'message' => 'Artwork added to the system.'
            ];
        } catch (\PDOException $e) {
            return [
                'success' => false,
                'message' => 'Error adding artwork: ' . $e->getMessage()
            ];
        }
    }

    /**
     * Update an existing artwork in the system.
     *
     * @return array Result of the update operation.
     */
    public function updateArtwork()
    {
        try {
            $stmt = $this->conn->prepare('UPDATE artworks SET title = ?, artist = ?, description = ?, price = ? WHERE id = ?');
            $stmt->execute([$this->getTitle(), $this->getArtist(), $this->getDescription(), $this->getPrice(), $this->getArtworkId()]);

            return [
                'success' => true,
                'message' => 'Artwork updated in the system.'
            ];
        } catch (\PDOException $e) {
            return [
                'success' => false,
                'message' => 'Error updating artwork: ' . $e->getMessage()
            ];
        }
    }

    /**
     * Delete an artwork from the system.
     *
     * @return array Result of the delete operation.
     */
    public function deleteArtwork()
    {
        try {
            $stmt = $this->conn->prepare('DELETE FROM artworks WHERE id = ?');
            $stmt->execute([$this->getArtworkId()]);

            return [
                'success' => true,
                'message' => 'Artwork deleted from the system.'
            ];
        } catch (\PDOException $e) {
            return [
                'success' => false,
                'message' => 'Error deleting artwork: ' . $e->getMessage()
            ];
        }
    }

    /**
     * Fetch all artworks from the system.
     *
     * @return array Result of the fetch operation.
     */
    public static function fetchAllArtworks()
    {
        try {
            $stmt = (new self())->conn->query('SELECT * FROM artworks');
            $artworks = $stmt->fetchAll(\PDO::FETCH_ASSOC);

            return [
                'success' => true,
                'artworks' => $artworks
            ];
        } catch (\PDOException $e) {
            return [
                'success' => false,
                'message' => 'Error fetching artworks: ' . $e->getMessage()
            ];
        }
    }

    /**
     * Fetch an artwork by its ID.
     *
     * @param int $artworkId Artwork ID.
     *
     * @return array Result of the fetch operation.
     */
    public static function fetchArtworkById($artworkId)
    {
        try {
            $stmt = (new self())->conn->prepare('SELECT * FROM artworks WHERE id = ?');
            $stmt->execute([$artworkId]);
            $artwork = $stmt->fetch(\PDO::FETCH_ASSOC);

            if ($artwork) {
                return [
                    'success' => true,
                    'artwork' => $artwork
                ];
            } else {
                return [
                    'success' => false,
                    'message' => 'Artwork not found.'
                ];
            }
        } catch (\PDOException $e) {
            return [
                'success' => false,
                'message' => 'Error fetching artwork: ' . $e->getMessage()
            ];
        }
    }
}
