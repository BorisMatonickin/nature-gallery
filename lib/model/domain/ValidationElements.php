<?php

class ValidationElements {
    
    /**
     * Array of validation elements.
     */
    private $validationElements = [];
    
    /**
     * Array of valdiation errors.
     */
    private $errors = [];
    
    /**
     * Array of validated values.
     */
    private $validated = [];
    
    /**
     * Add element to the array of validation elements.
     * @param string $name
     * @param ValidatorComposite $element
     */
    public function addElement($name, $element) {
        $this->validationElements[$name] = $element;
        return $this;
    }
    
    /**
     * Call isValid method on each validation element which is of type ValidatorComposite. Populates errors or 
     *   validated array based on the result of the method call.
     */
    public function validate() {
        foreach ($this->validationElements as $name => $element) {
            if ($element->isValid()) {
                $this->validated[$name] = $element->getValidated();
            } else {
                $this->errors[$name] = $element->getErrors();
            }
        }
    }
    
    /**
     * Check if errors array is empty.
     * @return boolean
     */
    public function isValid() {
        return (empty(array_filter($this->errors))) ? true : false;
    }
    
    /**
     * Get the errors array.
     * @return array
     */
    public function getErrors() {
        return $this->errors;
    }
    
    /**
     * Get the validated values array.
     * @return array
     */
    public function getValidated() {
        return $this->validated;
    }
}
