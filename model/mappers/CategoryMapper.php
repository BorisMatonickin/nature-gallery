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
}

