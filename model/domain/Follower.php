<?php

class Follower implements IFollower {
    
    /**
     * Table columns.
     */
    private $userId, $followerId;
    
    /**
     * Setter and getter method for the Follower object parameters.
     */
    public function setUserId($userId) {
        $this->userId = filter_var($userId, FILTER_SANITIZE_NUMBER_INT);
        return $this;
    }
    
    public function getUserId() {
        return $this->userId;
    }
    
    public function setFollowerId($follwerId) {
        $this->followerId = filter_var($follwerId, FILTER_SANITIZE_NUMBER_INT);
        return $this;
    }
    
    public function getFollowerId() {
        return $this->followerId;
    }
}

