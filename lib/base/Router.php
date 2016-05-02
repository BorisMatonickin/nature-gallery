<?php

class Router {
    
    /**
     * The main request uri.
     */
    private $uri;
    
    /**
     * Controller name.
     */
    private $controller;
    
    /**
     * Action or method name of certain controller.
     */
    private $action;
    
    /**
     * Optional params set in URL.
     */
    private $params;
    
    /**
     * Default route for application set in the configuration.
     */
    private $route;
    
    /**
     * Array of all defined routes in configuration.
     */
    private $routes = [];
    
    /**
     * Array of all URL parts splitted by '/'.
     */
    private $pathParts = [];
    
    /**
     * Optional URL param reserved for language of the application.
     */
    private $language;
    
    /**
     * Config object reference.
     */
    private $config;
    
    /**
     * Sets object parameters.
     * @param Config $config - configuration object
     * @param string $uri - request uri
     */
    public function __construct(Config $config, $uri) {
        $this->config = $config;
        $filteredUri = filter_var($uri, FILTER_SANITIZE_URL);
        $this->uri = urldecode(trim($filteredUri, '/'));
        // default settings
        $this->routes = $this->config->getSetting('routes');
        $this->route = $this->config->getSetting('defaultRoute');
        $this->language = $this->config->getSetting('defaultLanguage');
        $this->controller = $this->config->getSetting('defaultController');
        $this->action = $this->config->getSetting('defaultAction');
        $this->parseUri();
    }
    
    /**
     * Parse uri in path parts and call the methods for populating object parameters 
     *  based on uri parameters.
     */
    private function parseUri() {
        $uriParts = explode('?', $this->uri);
        $path = $uriParts[0];
        $this->pathParts = explode('/', $path);
        
        if (count($this->pathParts)) {
            $this->getRouteFromUri();
            $this->getLanguageFromUri();
            $this->getControllerFromUri();
            $this->getActionFromUri();
            $this->params = $this->pathParts;
        }
    }
    
    /**
     * Get route from uri which is the first parameter in the pathParts array. Check if current pathParts 
     *   array key exists in routes array stored in the configuration object. Also checking for method 
     *   prefix is needed. If all condition are met the route is assigned to the object parameter and the 
     *   pathParts array is shifted.  
     */
    private function getRouteFromUri() {
        if (in_array(strtolower(current($this->pathParts)), array_keys($this->routes))) {
            $this->route = strtolower(current($this->pathParts));
            array_shift($this->pathParts);
        }
    }
    
    /**
     * Get language from uri which is the second parameter in the pathParts array and also an optional because 
     *   if default language is stored in the configuration object it can be empty. If language parameter is set in 
     *   the pathParts array it must be defined in languages array in the configuration object. If all conditions 
     *   are met the language is assigned to the object parameter and the pathParts array is shifted.
     */
    private function getLanguageFromUri() {
        $languages = $this->config->getSetting('languages');
        if (in_array(strtolower(current($this->pathParts)), $languages)) {
            $this->language = strtolower(current($this->pathParts));
            array_shift($this->pathParts);
        }
    }
    
    /**
     * Get controller parameter from uri which is the second parameter (if language or admin route is not set). 
     * Controller is assigned to object parameter and the pathParts array is shifted.
     */
    private function getControllerFromUri() {
        if (current($this->pathParts)) {
            $this->controller = strtolower(current($this->pathParts));
            array_shift($this->pathParts);
        }
    }
    
    /**
     * Get action (or current controller method) which is the third parameter in uri (if language or admin route 
     *   is not set). Action is assigned to the object parameter and the pathArray is shifted.
     */
    private function getActionFromUri() {
        if (current($this->pathParts)) {
            $this->action = strtolower(current($this->pathParts));
            array_shift($this->pathParts);
        }
    }
    
    /**
     * Getter methods for object parameters.
     */
    public function getUri() {
        return $this->uri;
    }

    public function getController() {
        return $this->controller;
    }

    public function getAction() {
        return $this->action;
    }

    public function getParams() {
        return $this->params;
    }

    public function getRoute() {
        return $this->route;
    }

    public function getLanguage() {
        return $this->language;
    }
}

