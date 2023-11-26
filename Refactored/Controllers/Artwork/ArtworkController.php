<?php

namespace  Controllers\Artwork;

use  Database\Models\Artwork;

class ArtworkController extends Artwork
{
    /**
     * Add artwork to the system.
     * Redirect back with errors if unsuccessful.
     *
     * @param array $request The request data containing artwork information.
     */
    public function store($request, $file)
    {

        // Set artwork details
        $this->setTitle($request['title']);
        $this->setArtist($request['artist']);
        $this->setDescription($request['description']);
        $this->setPrice($request['price']);

        // Save artwork (without image)
        $result = $this->addArtwork();

        // Set messages in session
        if (!$result['success']) {
            $_SESSION['error'] = $result['message'];

            // Redirect to the previous page
            header("Location: " . $_SERVER['HTTP_REFERER']);
            exit();
        }

        // Handle image upload
        if (isset($file['image'])) {
            $image = $_FILES['image'];
            $uploadResult = $this->uploadArtworkImage($image, $this->getArtworkId());
            if (!$uploadResult['success']) {
                // If image upload fails, delete the newly added artwork
                $this->deleteArtwork();

                // Set error message in session
                $_SESSION['error'] = $uploadResult['message'];

                // Redirect to the previous page
                header("Location: " . $_SERVER['HTTP_REFERER']);
                exit();
            }
        }

        // Set success message in session
        $_SESSION['message'] = 'Artwork added successfully';

        // Redirect to the previous page
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit();

    }

    /**
     * Update an existing artwork.
     * Redirect back with errors if unsuccessful.
     *
     * @param array $request The request data.
     */
    public function update($request, $file)
    {
        $this->setArtworkId($request['artwork_id']);
        $this->setTitle($request['title']);
        $this->setArtist($request['artist']);
        $this->setDescription($request['description']);
        $this->setPrice($request['price']);

        $result = $this->updateArtwork();

        if ($result['success']) {
            // Set success message in session
            $_SESSION['message'] = $result['message'];

            // Redirect to the previous page
            header("Location: " . $_SERVER['HTTP_REFERER']);
            exit();
        } else {
            // Set error message in session
            $_SESSION['error'] = $result['message'];

            // Redirect back to the form
            header("Location: " . $_SERVER['HTTP_REFERER']);
            exit();
        }
    }

    /**
     * Delete an artwork by ID.
     * Redirect back with errors if unsuccessful.
     *
     * @param int $artworkId The ID of the artwork to delete.
     */
    public function delete($artworkId)
    {
        $this->setArtworkId($artworkId);

        $result = $this->deleteArtwork();

        if ($result['success']) {
            // Set success message in session
            $_SESSION['message'] = $result['message'];
        } else {
            // Set error message in session
            $_SESSION['error'] = $result['message'];
        }

        // Redirect to the previous page
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit();
    }

    /**
     * Upload artwork image, considering deletion of the old image during update.
     *
     * @param array $image The uploaded image file.
     * @param int $artworkId The ID of the artwork being updated.
     * @return array The result of the upload operation.
     */
    private function uploadArtworkImage($image, $artworkId = null)
    {
        // Check if an old image exists for update
        $oldImage = null;
        if ($artworkId) {
            $oldImage = $this->getArtworkImage($artworkId);
        }

        // Delete the old image if it exists
        if ($oldImage) {
            $this->deleteArtworkImage($oldImage);
        }

        // Perform the upload of the new image
        $uploadDir = 'artwork_images/';
        $fileName = uniqid('artwork_') . '_' . time() . '.' . pathinfo($image['name'], PATHINFO_EXTENSION);
        $destination = $uploadDir . $fileName;

        if (move_uploaded_file($image['tmp_name'], $destination)) {
            // Update the artwork image in the database
            if ($artworkId) {
                $this->updateArtworkImage($artworkId, $fileName);
            }

            return ['success' => true, 'message' => 'Artwork image uploaded successfully'];
        } else {
            return ['success' => false, 'message' => 'Error uploading artwork image'];
        }
    }

    /**
     * Get the artwork image filename from the database.
     *
     * @param int $artworkId The ID of the artwork.
     * @return string|null The filename of the artwork image or null if not found.
     */
    private function getArtworkImage($artworkId)
    {
        $stmt = $this->conn->prepare('SELECT image FROM artworks WHERE id = ?');
        $stmt->execute([$artworkId]);
        return $stmt->fetchColumn();
    }

    /**
     * Delete the artwork image file.
     *
     * @param string $fileName The filename of the artwork image.
     */
    private function deleteArtworkImage($fileName)
    {
        $filePath = 'artwork_images/' . $fileName;
        if (file_exists($filePath)) {
            unlink($filePath);
        }
    }

    /**
     * Update artwork image in the database.
     *
     * @param int $artworkId The ID of the artwork.
     * @param string $fileName The name of the uploaded image file.
     */
    private function updateArtworkImage($artworkId, $fileName)
    {
        $stmt = $this->conn->prepare('UPDATE artworks SET image = ? WHERE id = ?');
        $stmt->execute([$fileName, $artworkId]);
    }

}
