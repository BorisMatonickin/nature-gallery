<?php

class Contact {
    
    /**
     * Entity parameters.
     */
    private $name, $email, $message;
    
    /**
     * Getter and setter methods for Contact object parameters.
     */
    public function setName($name) {
        $this->name = filter_var($name, FILTER_SANITIZE_STRING);
        return $this;
    }
    
    public function getName() {
        return $this->name;
    }
    
    public function setEmail($email) {
        $this->email = filter_var($email, FILTER_SANITIZE_EMAIL);
        return $this;
    }
    
    public function getEmail() {
        return $this->email;
    }
    
    public function setMessage($message) {
        $this->message = filter_var($message, FILTER_SANITIZE_STRING);
        return $this;
    }
    
    public function getMessage() {
        return $this->message;
    }
}
