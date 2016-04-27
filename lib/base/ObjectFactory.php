<?php
    
class ObjectFactory {

    /**
     * Create new object using RefelectionClass.
     * @param string $objectName
     * @param array $args - optional array of parameters that needs to be passed to constructor
     */
    public function create($objectName, $args = []) {
        $reflectionClass = new ReflectionClass($objectName);
        if (isset($args) && is_array($args)) {
            return $reflectionClass->newInstanceArgs($args);
        } else {
            return $reflectionClass;
        }
    }
}
