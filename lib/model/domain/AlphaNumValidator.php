<?php

class AlphaNumValidator extends Validator {
    
    /**
     * Validate if the value has letters and numbers only. Space is allowed.
     * @param mixed $value - the value to validate
     * @return boolean
     */
    public function validate($value) {
        if (!ctype_alnum(str_replace(' ', '', $value))) {           
            $this->error = 'Only letters and numbers allowed';
            return false;
        }
        $this->validated = $value;
        return true;
    }
}    

