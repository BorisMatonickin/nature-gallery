<?php

interface IImage {
    
    public function setId($id);
    public function getId();
    public function setUserId($userId);
    public function getUserId();
    public function setName($name);
    public function getName();
    public function setType($type);
    public function getType();
    public function setSize($size);
    public function getSize();
    public function setWidth($width);
    public function getWidth();
    public function setHeight($height);
    public function getHeight();
    public function setCaption($caption);
    public function getCaption();
    public function setDescription($description);
    public function getDescription();
    public function setImageCategory($categoryId);
    public function getImageCategory();
    public function setImageTags($tagIds = []);
    public function getImageTags();
}

