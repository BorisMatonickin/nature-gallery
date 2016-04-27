<?php

class Category implements ICategory {
    
    /**
     * Table columns.
     */
    private $id, $name, $description;
    
    /**
     * Setter and getter methods for the Category object parameters.
     */
    public function setId($id) {
        $this->id = filter_var($id, FILTER_SANITIZE_NUMBER_INT);
        return $this;
    }
    
    public function getId() {
        return $this->id;
    }
    
    public function setName($name) {
        $this->name = filter_var($name, FILTER_SANITIZE_STRING);
        return $this;
    }
    
    public function getName() {
        return $this->name;
    }
    
    public function setDescription($description) {
        $this->description = $description;
        return $this;
    }
    
    public function getDescription() {
        return $this->description;
    }
}
