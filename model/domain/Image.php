<?php

class Image implements IImage {
    
    /**
     * Table columns.
     */
    private $id, $userId, $name, $type, $size, $width, $height, $caption, $description;
    
    /**
     * Table columns of relational tables.
     */
    private $categoryId;
    private $tagIds = [];
    
    /**
     * Getter and setter methods for Image object parameters.
     */
    public function setId($id) {
        $this->id = filter_var($id, FILTER_SANITIZE_NUMBER_INT);
        return $this;
    }
    
    public function getId() {
        return $this->id;
    }
    
    public function setUserId($userId) {
        $this->userId = filter_var($userId, FILTER_SANITIZE_NUMBER_INT);
        return $this;
    }
    
    public function getUserId() {
        return $this->userId;
    }
    
    public function setName($name) {
        $this->name = filter_var($name, FILTER_SANITIZE_STRING);
        return $this;
    }
    
    public function getName() {
        return $this->name;
    }
    
    public function setType($type) {
        $this->type = filter_var($type, FILTER_SANITIZE_STRING);
        return $this;
    }
    
    public function getType() {
        return $this->type;
    }
    
    public function setSize($size) {
        $this->size = filter_var($size, FILTER_SANITIZE_NUMBER_INT);
        return $this;
    }
    
    public function getSize() {
        return $this->size;
    }
    
    public function setWidth($width) {
        $this->width = filter_var($width, FILTER_SANITIZE_NUMBER_INT);
        return $this;
    }
    
    public function getWidth() {
        return $this->width;
    }
    
    public function setHeight($height) {
        $this->height = filter_var($height, FILTER_SANITIZE_NUMBER_INT);
        return $this;
    }
    
    public function getHeight() {
        return $this->height;
    }
    
    public function setCaption($caption) {
        $this->caption = filter_var($caption, FILTER_SANITIZE_STRING);
        return $this;
    }
    
    public function getCaption() {
        return $this->caption;
    }
    
    public function setDescription($description) {
        $this->description = $description;
        return $this;
    }
    
    public function getDescription() {
        return $this->description;
    }
    
    public function setImageCategory($categoryId) {       
        $this->categoryId = filter_var($categoryId, FILTER_SANITIZE_NUMBER_INT);
        return $this;
    }
    
    public function getImageCategory() {
        return $this->categoryId;
    }
    
    public function setImageTags($tagIds = []) {
        foreach ($tagIds as $tagId) {
            $this->tagIds[] = filter_var($tagId, FILTER_SANITIZE_NUMBER_INT);
        }
        return $this;
    }
    
    public function getImageTags() {
        return $this->tagIds;
    }
}
