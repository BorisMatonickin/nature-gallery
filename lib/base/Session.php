<?php

class Session {
    
    /**
     * Types of flash messages.
     */
    private $types = ['error', 'warning', 'info', 'success'];
    
    /**
     * Set the session file save path and start the session. 
     */
    public function init() {
        session_save_path(ROOT . DS . 'lib' . DS . 'base' . DS . 'session');
		session_set_cookie_params(0, '/', '', true, true);
        session_start();
    }
    
    /**
     * Regenerates session id. Used after important application action eg. login process.
     */
    public function regenerateId() {
        session_regenerate_id();
    }
    
    /*
     * Check if session variable exists.
     * @param string $name - the name of the session index
     * @return bool
     */
    public function exists($name) {
        if (!empty($name)) {
            return (isset($_SESSION[$name])) ? true : false;
        }
    }

    /*
     * Put the value of the variable in the session.
     * @param string $name - the name of the session index
     * @param string $value - the value to be put
     */
    public function put($name, $value) {
        if (!empty($name) && !empty($value)) {
            return $_SESSION[$name] = $value;
        }
    }

    /*
     * Get the session variable.
     * @param string $name - the name of the session index
     */
    public function get($name) {
        if (!empty($name)) {
            return $_SESSION[$name];
        }
    }

    /*
     * Delete variable from session.
     * @param string $name - the name of the session index
     */
    public function delete($name) {
        if ($this->exists($name)) {
            unset($_SESSION[$name]);
        }
    }

    /**
     * Destroy all session data.
     */
    public function destroy() {
        $_SESSION = [];
        session_destroy();
        setcookie(session_name(), '', time()-3600);
        session_regenerate_id();
    }
    
    /*
     * Set flash messages.
     * @param string $name - the name of the session index
     * @param string $message - flash message to be stored in the session
     */
    public function flash($name = 'message', $message = '') {
        if ($this->exists($name) && in_array($name, $this->types)) {
            $session = $this->get($name);
            $this->delete($name);
            return $session;
        } else {
            $this->put($name, $message);
        }
    }
    
    /**
     * Check if flash message exists in session based on allowed type of the message.
     */
    public function hasFlash() {
        $type = $this->checkFlashType();
        if (!is_null($type)) {
            return !empty($_SESSION[$type]);
        }
        return false;
    }
    
    /*
     * Get flash message based on type.
     */
    public function getFlashMessage() {
        $type = $this->checkFlashType();
        if (!is_null($type) && !empty($_SESSION[$type])) {
            return $this->flash($type);
        }
        return null;
    }
    
    /**
     * Add bootstrap css classes to the dislayed message based on the type.
     */
    public function addAlertClass() {
        $type = $this->checkFlashType();
        switch($type) {
            case 'error':
                return 'alert alert-danger';
            case 'warning':
                return 'alert alert-warning';
            case 'info':
                return 'alert alert-info';
            case 'success':
                return 'alert alert-success';
            default:
                return 'alert alert-info';
        }
    }

    /**
     * Check flash message type.
     */
    private function checkFlashType() {
        foreach ($this->types as $type) {
            if ($this->exists($type)) {
                return $type;
            }
        }
        return null;
    }
    
    /**
     * Check if user is logged in by checking session array data.
     * @return boolean
     */
    public function isUserLoggedIn() {
        $userInfo = $this->getUserInfo();
        return ((array_key_exists('loggedIn', $userInfo)) && ($userInfo['loggedIn'] === true)) ? true : false;
    }
    
    /**
     * Checking if user is admin by checking session array data.
     * @return boolean
     */
    public function isUserAdmin() {
        $userInfo = $this->getUserInfo();
        if ($this->isUserLoggedIn()) {
            return ((array_key_exists('role', $userInfo)) && ($userInfo['role'] === 'admin')) ? true : false;
        }
        return false;
    }
    
    /**
     * Get user info array from the session.
     * @return array
     */
    public function getUserInfo() {
       return ($this->exists('user')) ? $this->get('user') : [];
    }
}
