<?php

class AlphaValidator extends Validator {
    
    /**
     * Validate if the value has only letters. Space is allowed.
     * @param mixed $value
     * @return boolean
     */
    public function validate($value) {
        if (!ctype_alpha(str_replace(' ', '', $value))) {
            $this->error = 'Only letters allowed';
            return false;
        }        
        $this->validated = $value;
        return true;
    }
}
