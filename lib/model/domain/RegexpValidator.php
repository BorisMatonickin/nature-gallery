<?php

class RegexpValidator extends Validator {
    
    /**
     * Regular expression pattern.
     */
    private $regexpPattern;
    
    /**
     * Set the regular expression pattern.
     * @param string $regexpPattern
     * @throws exception - the regular expression pattern should be string
     */
    public function __construct($regexpPattern) {
        if (!is_string($regexpPattern)) {
            throw new Exception('Invalid parameter for regexp pattern');
        }
        $this->regexpPattern = $regexpPattern;
    }
    
    /**
     * Validate if the value matches the regular expression pattern.
     * @param mixed $value
     * @return boolean
     */
    public function validate($value) {
        if (filter_var($value, FILTER_VALIDATE_REGEXP, ['options' => ['regexp' => $this->regexpPattern]])) {
            $this->validated = $value;
            return true;
        }
        $this->error = 'Invalid format';
        return false;
    }
}
