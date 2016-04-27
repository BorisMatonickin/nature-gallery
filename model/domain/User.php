<?php

class User implements IUser {
    
    /**
     * Table columns.
     */
    private $id, $email, $username, $password, $firstName, $lastName, 
        $gender, $city, $state, $country, $active, $role, $coverImage, $profileImage, $about;
    
    /**
     * Getter and setter methods for the User object parameters.
     */
    public function setId($id) {
        $this->id = filter_var($id, FILTER_SANITIZE_NUMBER_INT);
        return $this;
    }

    public function getId() {
        return $this->id;
    }
    
    public function setEmail($email) {
        $this->email = filter_var($email, FILTER_SANITIZE_EMAIL);
        return $this;
    }

    public function getEmail() {
        return $this->email;
    }
    
    public function setUsername($username) {
        $this->username = filter_var($username, FILTER_SANITIZE_STRING);
        return $this;
    } 
    
    public function getUsername() {
        return $this->username;
    }
    
    public function setPasswordForRegister($password) {
        $hashPassword = password_hash($password, PASSWORD_BCRYPT);
        $this->password = $hashPassword;
        return $this;
    }
    
    public function getPasswordForRegister() {
        return $this->password;
    }
    
    public function setPassword($password) {
        $this->password = $password;
    }
    
    public function getPassword() {
        return $this->password;
    }
    
    public function setFirstName($firstName) {
        $this->firstName = filter_var($firstName, FILTER_SANITIZE_STRING);
        return $this;
    }
    
    public function getFirstName() {
        return $this->firstName;
    }
    
    public function setLastName($lastName) {
        $this->lastName = filter_var($lastName, FILTER_SANITIZE_STRING);
        return $this;
    }
    
    public function getLastName() {
        return $this->lastName;
    }
    
    public function setGender($gender) {
        $this->gender = filter_var($gender, FILTER_SANITIZE_STRING);
        return $this;
    }
    
    public function getGender() {
        return $this->gender;
    }
    
    public function setCity($city) {
        $this->city = filter_var($city, FILTER_SANITIZE_STRING);
        return $this;
    }
    
    public function getCity() {
        return $this->city;
    }
    
    public function setState($state) {
        $this->state = filter_var($state, FILTER_SANITIZE_STRING);
        return $this;
    }
    
    public function getState() {
        return $this->state;
    }
    
    public function setCountry($country) {
        $this->country = filter_var($country, FILTER_SANITIZE_STRING);
        return $this;
    }
    
    public function getCountry() {
        return $this->country;
    }
    
    public function setActive($active) {
        $this->active = $active;
        return $this;
    }
    
    public function getActive() {
        return $this->active;
    }
    
    public function setRole($role) {
        if (($role !== 'admin') && ($role !== 'user')) {
            throw new InvalidArgumentException('The user role is invalid');
        }
        $this->role = $role;
        return $this;
    }
    
    public function getRole() {
        return $this->role;
    }
    
    public function setCoverImage($coverImage) {
        $this->coverImage = $coverImage;
        return $this;
    }
    
    public function getCoverImage() {
        return $this->coverImage;
    }
    
    public function setProfileImage($profileImage) {
        $this->profileImage = $profileImage;
        return $this;
    }
    
    public function getProfileImage() {
        return $this->profileImage;
    }
    
    public function setAbout($about) {
        $this->about = filter_var($about, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
        return $this;
    }
    
    public function getAbout() {
        return $this->about;
    }
}
    