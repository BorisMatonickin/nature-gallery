<?php

class RequiredValidator extends Validator {
    
    /**
     * Validate if value is required.
     * @param mixed $value
     */
    public function validate($value) {
        if (empty($value)) {
            $this->error = 'Required';
        }
    }
}

