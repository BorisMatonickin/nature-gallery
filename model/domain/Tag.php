<?php

class Tag implements ITag {
    
    /**
     * Table columns.
     */
    private $id, $tag;
    
    /**
     * Setter and getter methods for the Tag object parameters.
     */
    public function setId($id) {
        $this->id = filter_var($id, FILTER_SANITIZE_NUMBER_INT);
        return $this;
    }
    
    public function getId() {
        return $this->id;
    }
    
    public function setTag($tagName) {
        $this->tag = filter_var($tagName, FILTER_SANITIZE_STRING);
        return $this;
    }
    
    public function getTag() {
        return $this->tag;
    }
}

