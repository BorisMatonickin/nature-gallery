<?php

class CategoryMapper extends PdoDataMapper {
    
    /**
     * Set the object parameters.
     * @param PdoAdapter $pdo
     */
    public function __construct(PdoAdapter $pdo) {
        parent::__construct($pdo);
    }
    
    /**
     * Fetch all names of the categories.
     * @return array
     */
    public function fetchCategoriesName() {
        $sql = "SELECT id, category FROM category";
        return $this->getAllColumns($sql, 'id');
    }
    
    /**
     * Fetch 6 random images from each category. Images are concatenated with IDs into string.
     * @return mixed - array of data or PDO errors
     */
    public function fetchCategoriesWithImages() {
        try {
	$sql = "SELECT c.id AS catId, c.category, "
	        . "SUBSTRING_INDEX(GROUP_CONCAT(i.id, '-', i.name ORDER BY RAND() SEPARATOR ','), ',', 6) AS images, "
	        . "COUNT(ic.image_id) AS countImages FROM category c "
	        . "JOIN image_category ic ON c.id = ic.cat_id "
	        . "JOIN image i ON i.id = ic.image_id "
	        . "GROUP BY(ic.cat_id) HAVING countImages > 4 "
	        . "ORDER BY RAND()";
	return $this->getAllColumns($sql, 'catId');
        } catch (PDOException $e) {
	return $this->returnPdoErrors($e);
        }
    }
    
    /**
     * Fetch images from category.
     * @param int $catId
     * @return mixed - array of data or PDO errors
     */
    public function fetchImagesFromCategory($catId) {
        try {
	$sql = "SELECT i.id AS image_id, i.name, i.caption FROM image i "
	        . "JOIN image_category ic ON ic.image_id = i.id "
	        . "JOIN category c ON c.id = ic.cat_id "
	        . "WHERE c.id = ?";
	return $this->getAllColumns($sql, 'image_id', [$catId]);
        } catch (PDOException $e) {
	return $this->returnPdoErrors($e);
        }
    }
    
    /**
     * Fetch category details.
     * @param int $catId
     * @return mixed - array of data or PDO errors
     */
    public function fetchCategoryDetails($catId) {
        try {
	$sql = "SELECT id, category, description FROM category WHERE id = ?";
	return $this->getColumns($sql, [$catId]);
        } catch (PDOException $e) {
	return $this->returnPdoErrors($e);
        }
    }
}

