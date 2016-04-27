<?php

class ImageMapper extends PdoDataMapper {
    
    /**
     * Set the object parameters.
     * @param PdoAdapter $pdo
     */
    public function __construct(PdoAdapter $pdo) {
        parent::__construct($pdo);
    }
    
    /**
     * Fetch the 5 image from 4 categories for main index page. Images are concatenated into string in each category
     *   and later separated on appropriate part of application.
     * @return mixed - array of data if query is successfull or errors if not
     */
    public function fetchCategoriesWithImagesForIndex() {
        try {
            $sql = "SELECT c.id AS catId, c.category, "
                . "SUBSTRING_INDEX(GROUP_CONCAT(i.id, '-', i.name ORDER BY RAND() SEPARATOR ','), ',', 5) AS images, "
                . "COUNT(ic.image_id) AS countImages FROM category c "
                . "JOIN image_category ic ON c.id = ic.cat_id "
                . "JOIN image i ON i.id = ic.image_id "
                . "GROUP BY(ic.cat_id) HAVING countImages > 4 "
                . "ORDER BY RAND() LIMIT 5";
            return $this->getAllColumns($sql, 'catId');
        } catch (PDOException $e) {
            return $this->returnPdoErrors($e);
        }
    }
    
    /**
     * Fetch the image details.
     * @param int $imageId
     * @return mixed - array of data if query is successfull or errors if not
     */
    public function fetchImageDetails($imageId) {
        try {
            $sql = "SELECT i.id AS image_id, i.name, i.user_id, i.caption, i.description, c.category, "
                . "DATE_FORMAT(i.created_at, '%d %b %Y') AS date_created, u.username "
                . "FROM image i "
                . "JOIN user u ON i.user_id = u.id "
                . "JOIN image_category ic ON ic.image_id = i.id "
                . "JOIN category c ON ic.cat_id = c.id "
                . "WHERE i.id = ?";
            return $this->getColumns($sql, [$imageId]);
        } catch (PDOException $e) {
            return $this->returnPdoErrors($e);
        }
    }
    
    /**
     * Fetch 6 random images of the user.
     * @param int $userId
     * @return mixed - array of data if query is successfull or errors if not
     */
    public function fetchUserImages($userId) {
        try {
            $sql = "SELECT id, name, caption FROM image WHERE user_id = ? ORDER BY RAND() LIMIT 6";
            return $this->getAllColumns($sql, 'id', [$userId]);
        } catch (PDOException $e) {
            return $this->returnPdoErrors($e);
        }
    }
    
    /**
     * Fetch all images of the user.
     * @param int $userId
     * @return mixed - array of data if query is successfull or errors if not
     */
    public function fetchAllImagesFromUser($userId) {
        try {
            $sql = "SELECT id, name, caption FROM image WHERE user_id = ?";
            return $this->getAllColumns($sql, 'id', [$userId]);
        } catch (PDOException $e) {
            return $this->returnPdoErrors($e);
        }
    }
    
    /**
     * Insert image and image categories using MySQL transaction.
     * @param IImage $image
     * @return mixed - boolean or PDO errors
     */
    public function insertImage(IImage $image) {
        try {
            $userId = $image->getUserId();
            $name = $image->getName();
            $type = $image->getType();
            $size = $image->getSize();
            $width = $image->getWidth();
            $height = $image->getHeight();
            $caption = $image->getCaption();
            $description = $image->getDescription();
            $catId = $image->getImageCategory();
            
            $this->pdo->beginTransaction();
            
            $sql1 = "INSERT INTO image (user_id, name, type, size, width, height, caption, description) "
                    . "VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $this->pdo->prepare($sql1);
            $stmt->execute([$userId, $name, $type, $size, $width, $height, $caption, $description]);
            $imageId = $this->pdo->lastInsertId();
            
            $sql2 = "INSERT INTO image_category (image_id, cat_id) VALUES (?, ?)";
            $stmt2 = $this->pdo->prepare($sql2);
            $stmt2->execute([$imageId, $catId]);
            
            return $this->pdo->commit();
        } catch (PDOException $e) {
            $this->pdo->rollback();
            return $this->returnPdoErrors($e);
        }
    }
    
    /**
     * Update image details.
     * @param IImage $image
     */
    public function updateImageDetails(IImage $image) {
        try {
            $imageId = $image->getId();
            $caption = $image->getCaption();
            $description = $image->getDescription();
            $catId = $image->getImageCategory();
	
            $this->pdo->beginTransaction();
	
	$sql1 = "UPDATE image SET caption = ?, description = ? WHERE id = ?";
	$stmt = $this->pdo->prepare($sql1);
	$stmt->execute([$caption, $description, $imageId]);
	
	$sql2 = "DELETE FROM image_category WHERE image_id = ? LIMIT 1";
	$stmt2 = $this->pdo->prepare($sql2);
	$stmt2->execute([$imageId]);
	
	$sql3 = "INSERT INTO image_category (image_id, cat_id) VALUES (?, ?)";
	$stmt3 = $this->pdo->prepare($sql3);
	$stmt3->execute([$imageId, $catId]);
	
            return $this->pdo->commit();
        } catch (PDOException $e) {
	$this->pdo->rollback();
	return $this->returnPdoErrors($e);
        }
    }
    
    /**
     * Delete image from the database.
     * @param IImage $image
     */
    public function deleteImage(IImage $image) {
        try {
	$imageId = $image->getId();
	$sql = "DELETE FROM image WHERE id = ? LIMIT 1";
	$stmt = $this->pdo->prepare($sql);
	$delete = $stmt->execute([$imageId]);
	return (($delete === 1) || ($delete === true)) ? true : false;
        } catch (PDOException $e) {
	return $this->returnPdoErrors($e);
        }
    }
}
