<?php

class CategoryService {
    
    /**
     * CategoryMapper reference.
     */
    private $categoryMapper;
    
    /**
     * Set the object parameters.
     * @param CategoryMapper $categoryMapper
     */
    public function __construct(CategoryMapper $categoryMapper) {
        $this->categoryMapper = $categoryMapper;
    }
    
    /**
     * Get category names with belonging images.
     * @return array
     */
    public function getCategoriesWithImages() {
        return $this->categoryMapper->fetchCategoriesWithImages();
    }
    
    /**
     * Get images from category.
     * @param $catId - the ID of the category
     * @return array
     */
    public function getImagesFromCategory($catId) {
        $sanitizedCatId = $this->validateAndSanitizeId($catId);
        return $this->categoryMapper->fetchImagesFromCategory($sanitizedCatId);
    }
    
    /**
     * Get category details.
     * @param int $catId
     * @return array
     */
    public function getCategoryDetails($catId) {
        $sanitizedCatId = $this->validateAndSanitizeId($catId);
        return $this->categoryMapper->fetchCategoryDetails($sanitizedCatId);
    }
    
    /**
     * Validate and sanitize integer number.
     * @param int $id
     */
    private function validateAndSanitizeId($id) {
        if (!filter_var($id, FILTER_VALIDATE_INT)) {
	throw new InvalidArgumentException('Invalid parameter for id');
        }
        $sanitized = filter_var($id, FILTER_SANITIZE_NUMBER_INT);
        return $sanitized;
    }
}

