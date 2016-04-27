<?php

class IntegerValidator extends Validator {
    
    /**
     * Validate if the value is valid integer.
     * @param mixed $value
     * @return boolean
     */
    public function validate($value) {
        if (filter_var($value, FILTER_VALIDATE_INT)) {
            $this->validated = $value;
            return true;
        }
        $this->error = 'Invalid number';
        return false;
    }
}

