<?php

class RequiredLengthValidator extends Validator {
    
    /**
     * Required length value.
     */
    private $requiredLength;
    
    /**
     * Set the required length value.
     * @param int $requiredLength
     * @throws Exception - the required length value should be an valid integer
     */
    public function __construct($requiredLength) {
        if (!filter_var($requiredLength, FILTER_VALIDATE_INT)) {
            throw new Exception('Invalid argument for required length');
        }
        $this->requiredLength = $requiredLength;
    }
    
    /**
     * Validate if the value length is exactly the same as is required.
     * @param string $value
     * @return boolean
     */
    public function validate($value) {
        if (!strlen($value) === $this->requiredLength) {
            $this->error = 'Invalid length';
            return false;
        }
        $this->validated = $value;
        return true;
    }
}
