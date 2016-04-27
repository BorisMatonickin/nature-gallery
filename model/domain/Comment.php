<?php

class Comment implements IComment {
    
    /*
     * Table columns.
     */
    private $id, $userId, $imageId, $comment;
    
    public function __construct() {}
    
    /**
     * Getter and setter methods for Comment object parameters. 
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
    
    public function setImageId($imageId) {
        $this->imageId = filter_var($imageId, FILTER_SANITIZE_NUMBER_INT);
        return $this;
    }
    
    public function getImageId() {
        return $this->imageId;
    }
    
    public function setComment($comment) {
        $this->comment = $comment;
        return $this;
    }
    
    public function getComment() {
        return $this->comment;
    }
}

