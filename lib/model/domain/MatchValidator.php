<?php

class MatchValidator extends Validator {
    
    /**
     * Field to match against.
     */
    private $fieldToMatch;
    
    /**
     * Set the field to match against.
     * @param mixed $fieldToMatch
     */
    public function __construct($fieldToMatch) {
        $this->fieldToMatch = $fieldToMatch;
    }
    
    /**
     * Validate if the value matches given field to match against.
     * @param mixed $value
     * @return boolean
     */
    public function validate($value) {
        if ($value !== $this->fieldToMatch) {
            $this->error = 'Entries are not the same.';
            return false;
        }
        $this->validated = $value;
        return true;
    }
}

