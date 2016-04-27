<?php

class EmailValidator extends Validator {
    
    /**
     * Validate if the value is valid email address.
     * @param mixed $value
     * @return boolean
     */
    public function validate($value) {
        if (filter_var($value, FILTER_VALIDATE_EMAIL)) {
            $this->validated = $value;
            return true;
        }
        $this->error = 'Invalid email address';
        return false;
    }
}
