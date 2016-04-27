<?php

class MinLengthValidator extends Validator {
    
    /**
     * Mimimum string length allowed.
     */
    private $minLength;
    
    /**
     * Set the minimum string length allowed.
     * @param int $minLength
     * @throws Exception - the minimum string length value should be an valid integer
     */
    public function __construct($minLength) {
        if (!filter_var($minLength, FILTER_VALIDATE_INT)) {
            throw new Exception('Invalid argument for min length');
        }
        $this->minLength = $minLength;
    }
    
    /**
     * Validate if length of the value is not shorter than mimum allowed one.
     * @param string $value
     * @return boolean
     */
    public function validate($value) {
        if (strlen($value) < $this->minLength) {
            $this->error = 'Too short';
            return false;
        }
        $this->validated = $value;
        return true;
    }
}
