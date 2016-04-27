<?php

interface IUser {
    
    public function setId($id);
    public function getId();
    public function setEmail($email);
    public function getEmail();
    public function setUsername($username);
    public function getUsername();
    public function setPassword($password);
    public function getPassword();
    public function setFirstName($firstName);
    public function getFirstName();
    public function setLastName($lastName);
    public function getLastName();
    public function setGender($gender);
    public function getGender();
    public function setCity($city);
    public function getCity();
    public function setState($state);
    public function getState();
    public function setCountry($country);
    public function getCountry();
    public function setActive($active);
    public function getActive();
    public function setRole($role);
    public function getRole();
    public function setCoverImage($coverImage);
    public function getCoverImage();
    public function setProfileImage($profileImage);
    public function getProfileImage();
    public function setAbout($about);
    public function getAbout();
}

