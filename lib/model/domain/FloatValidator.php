<?php

class FloatValidator extends Validator {
    
    /**
     * Validate if the value is valid decimal number.
     * @param mixed $value
     * @return boolean
     */
    public function validate($value) {
        if (filter_var($value, FILTER_VALIDATE_FLOAT)) {
            $this->validated = $value;
            return true;
        }
        $this->error = 'Invalid decimal number';
        return false;
    }
}

