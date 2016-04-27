<?php

class Autoloader {
    
    /**
     * List of paths.
     */
    private $paths = [];
    
    /**
     * Set the application classes paths.
     */
    public function __construct() {
        $this->paths = [
	ROOT . DS . 'lib' . DS . 'base' . DS,
	ROOT . DS . 'lib' . DS . 'model' . DS . 'domain' . DS,
	ROOT . DS . 'lib' . DS . 'model' . DS . 'mappers' . DS,
	ROOT . DS . 'lib' . DS . 'model' . DS . 'services' . DS,
	ROOT . DS . 'model' . DS . 'domain' . DS,
	ROOT . DS . 'model' . DS . 'mappers' . DS,
	ROOT . DS . 'model' . DS . 'services' . DS,
	ROOT . DS . 'controllers' . DS,
        ];
    }
    
    /**
     * Register the classes for autoloading. Classes paths are stored in the cache file. 
     * If class with path is not stored, it is loaded and cached.
     */
    public function register() {
        $paths = $this->paths;
        spl_autoload_register(function($className) use ($paths) {
	$cacheFile = ROOT . DS . 'cache' . DS . 'classpaths.cache';
	$pathCache = (file_exists($cacheFile)) ? unserialize(base64_decode(file_get_contents($cacheFile))) : [];
	if (!is_array($pathCache)) {
	    $pathCache = [];
	}
	if (array_key_exists($className, $pathCache)) {
	    if (file_exists($pathCache[$className])) {
	        require_once($pathCache[$className]);
	    }
	} else {
	    foreach($paths as $path) {
	        if (file_exists($path . $className . '.php')) {
		$pathCache[$className] = $path . $className . '.php';
		require_once($path . $className . '.php');
		break;
	        }
	    }
	}
	$serializedPaths = base64_encode(serialize($pathCache));
	if ($serializedPaths !== $pathCache) {
	    file_put_contents($cacheFile, $serializedPaths);
	}
        });
    }
}
