<?php

class Config {
    
    /**
     * Array of configuration settings.
     */
    private $settings = [];
    
    /**
     * Get the setting from stored array of settings.
     * @param string $key - the name of stored setting
     */
    public function getSetting($key) {
        return (isset($this->settings[$key])) ? $this->settings[$key] : null;
    }
    
    /**
     * Set the seting by storing it in array.
     * @param string $key - the name of the setting
     * @param $value - the value to be stored in settings array
     */
    public function setSetting($key, $value) {
        $this->settings[$key] = $value;
    }
}

