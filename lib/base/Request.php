<?php

class Request implements iRequest {
    
    /**
     * Check if page have $_POST request variables.
     */
    public function isPost() {
        if (count($_POST) > 0) {
            return true;
        }
        return false;
    }
    
    /**
     * Check if parameter has been set in $_POST or $_GET request.
     * @param string $param - the key to look for in request arrays
     */
    public function isParamSet($param) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            return isset($_POST[$param]);
        } elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
            return isset($_GET[$param]);
        }
        return null;
    }
    
    /**
     * Get param from $_POST or $_GET request.
     * @param string $param - the key to look for in request arrays
     */
    public function getParam($param) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            return (isset($_POST[$param])) ? trim(htmlspecialchars($_POST[$param])) : null;
        } elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
            return (isset($_GET[$param])) ? trim(strip_tags(urldecode($_GET[$param]))) : null;
        }
        return null;
    }
    
    /**
     * Get all $_POST request params.
     */
    public function getPostParams() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            return array_map(function($item) {
                return trim(htmlspecialchars($item)); 
            }, $_POST);
        }
        return null;
    }
    
    /**
     * Get all $_GET request params.
     */
    public function getGetParams() {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            return array_map(function($item) {
                return trim(strip_tags(urldecode($item)));
            }, $_GET);
        }
    }
    
    /**
     * Get the file.
     */
    public function getFile($name) {
        return (isset($_FILES[$name]) && is_array($_FILES[$name])) ? $_FILES[$name] : null;
    }
    
    /*
     * Allow specified parameters through GET request
     * @param array $allowedParam - array of allowed params
     * @return array - cleaned allowed params
     */
    public function allowedGetParams($allowedParams = array()) {
        $allowedArray = array();
        foreach ($allowedParams as $param) {
            if (isset($_GET[$param])) {
                $allowedArray[$param] = trim(strip_tags(urldecode($_GET[$param])));
            } else {
                $allowedArray[$param] = NULL;
            }
        }
        return $allowedArray;
   }
    
    /**
     * Redirect method when certain session params needs to be cleared. 
     * Therefore exit() function is used.
     * @param string $location - the location of redirection
     */
    public function redirect($location = 'http://nature.dev') {
        ob_start();
        header('Location: ' . $location);
        ob_end_flush();
        exit();
    }
    
    /**
     * Redirect user after successfull login process.
     * @param string $location - the location of redirection
     */
    public function redirectOnLogin($location = 'http://nature.dev') {
        ob_start();
        header('Location: ' . $location);
        ob_end_flush();
    }
    
    /**
     * Refresh the current page.
     */
    public function refresh() {
        ob_start();
        header('Refresh: 0.1');
        ob_end_flush();
    }
}