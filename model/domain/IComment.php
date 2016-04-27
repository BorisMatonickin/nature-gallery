<?php

interface IComment {
    
    public function setId($id);
    public function getId();
    public function setUserId($userId);
    public function getUserId();
    public function setImageId($imageId);
    public function getImageId();
    public function setComment($comment);
    public function getComment();
}