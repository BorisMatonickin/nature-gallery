<?php

class ValidatorComposite {
    
    /**
     * Array of the validators.
     */
    private $validators = [];
    
    /**
     * Array of the errors.
     */
    private $errors = [];
    
    /**
     * Array of the validated values.
     */
    private $validated = [];
    
    /**
     * Add validator to validators array.
     * @param Validator $validator
     */
    public function addValidator($validator) {
        $this->validators[] = $validator;
        return $this;
    }
    
    /**
     * Call validate method of each validator in validators array. Populate validated or errors array based 
     *   on the result of validate method.
     * @param mixed $value
     */
    public function validate($value) {
        foreach ($this->validators as $validator) {
            if ($validator->validate($value)) {
                $this->validated[] = $validator->getValidated();
            } else {
                $this->errors[] = $validator->getError();
            } 
        }
    }
    
    /**
     * Check if validator composite is valid by checking if errors array is empty.
     * @return boolean
     */
    public function isValid() {
        return (empty(array_filter($this->errors))) ? true : false;
    }
    
    /**
     * Get the validation errors array.
     * @return array
     */
    public function getErrors() {
        return array_filter($this->errors);
    }
    
    /**
     * Get the validated values array.
     * @return array
     */
    public function getValidated() {
        return array_map('trim', $this->validated);
    }
}