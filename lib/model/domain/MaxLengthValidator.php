<?php

class MaxLengthValidator extends Validator {
    
    /**
     * Maximum string length allowed.
     */
    private $maxLength;
    
    /**
     * Set the maximum string length allowed.
     * @param int $maxLength
     * @throws Exception - the maximum length value should be an valid integer
     */
    public function __construct($maxLength) {
        if (!filter_var($maxLength, FILTER_VALIDATE_INT)) {
            throw new Exception('Invalid argument for max length');
        }
        $this->maxLength = $maxLength;
    }
    
    /**
     * Validate if length of the value doesn't pass the maximum allowed one.
     * @param string $value
     * @return boolean
     */
    public function validate($value) {
        if (strlen($value) > $this->maxLength) {
            $this->error = 'Too long';
            return false;
        }
        $this->validated = $value;
        return true;
    }
}

