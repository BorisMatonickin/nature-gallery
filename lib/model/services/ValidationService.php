<?php

class ValidationService {
    
    /**
     * Validation rules array.
     */
    private $rules = [];
    
    /**
     * Source array of values to be validated.
     */
    private $source = [];
    
    /**
     * ObjectFactory object reference.
     */
    private $factory;
    
    /**
     * ValidationElements object reference.
     */
    private $valElements;
    
    /**
     * PdoDataMapper object reference.
     */
    private $pdoMapper;
    
    /**
     * Session object reference.
     */
    private $session;
    
    /**
     * Array of accessible rules for validation.
     */
    private $allowedRules = ['unique', 'alpha', 'alphaNum', 'integer', 'float', 'email', 'regexp', 'required', 'minLength', 'maxLength', 'match', 
                        'sessionMatch', 'requiredLength', 'spamFilter'];
    
    /**
     * Set the object parameters.
     * @param PdoDataMapper $pdoMapper
     * @param Session $session
     * @param ObjectFactory $factory
     * @param ValidationElements $valElements
     */
    public function __construct(PdoDataMapper $pdoMapper, Session $session, ObjectFactory $factory, ValidationElements $valElements) {
        $this->factory = $factory;
        $this->valElements = $valElements;
        $this->pdoMapper = $pdoMapper;
        $this->session = $session;
    }
    
    /**
     * Add array of rules.
     * @param array $rules
     */
    public function addRules($rules = []) {
        $this->rules = $rules;
    }
    
    /**
     * Add one rule to the rules array.
     * @param string $field - the name of the field of the source array
     * @param string $rule
     */
    public function addRule($field, $rule = '') {
        if (array_key_exists($field, $this->rules)) {
            array_unshift($this->rules[$field], $rule);
        } else {
            $this->rules[$field][] = $rule;
        }
    }
    
    /**
     * Add the source with values for validation.
     * @param array $source
     */
    public function addSource($source = []) {
        $this->source = $source;
    }
    
    /**
     * Validate all validation elements.
     * @return boolean
     */
    public function validate() {
        $this->createValidators();
        $this->valElements->validate();
        return ($this->valElements->isValid()) ? true : false;
    }

    /**
     * Create validator objects based on rules array passed to the object.
     */
    private function createValidators() {
        $valElementsArray = [];
        foreach ($this->rules as $sourceField => $rules) {
            // creates composition for each source field defined in rules array
            $fieldValidator = $this->factory->create('ValidatorComposite');
            foreach ($rules as $rule) {
                // extract validator name from rule (separated with : if args exists)
                $ruleValidatorName = $this->extractValidatorFromRule($rule);
                $this->checkAllowedRule($ruleValidatorName);
                // if required rule is not set and source field is empty proceed with validation
                if (($ruleValidatorName !== 'required') && (empty($this->source[$sourceField]))) {
                    continue;
                }
                // validator class name to be created 
                $validatorName = ucfirst($ruleValidatorName . 'Validator');
                // extract possible object arguments 
                $args = $this->extractArgsFromRule($rule);
                // if field must match other field exact value for named field should be passed to the validator constructor
                if ($ruleValidatorName === 'match') {
                    $valueToMatch = $this->source[$args[0]];
                    $matchValidator = $this->factory->create($validatorName, [$valueToMatch]);
                    $fieldValidator->addValidator($matchValidator);
                } elseif ($ruleValidatorName === 'sessionMatch') {
                    // if field must match value in the session, session object needs to be passed to the validator constructor
                    $sessionMatchVal = $this->factory->create($validatorName, [$this->session, $args[0]]);
                    $fieldValidator->addValidator($sessionMatchVal);
                } elseif ($ruleValidatorName === 'unique') {
                    $uniqueValidator = $this->factory->create($validatorName, [$this->pdoMapper, $args[0], $args[1]]);
                    $fieldValidator->addValidator($uniqueValidator);
                } else {
                    // created validator object
                    $validator = $this->factory->create($validatorName, $args);
                    // add validator to source field validators composite
                    $fieldValidator->addValidator($validator);
                }
            }
            // field value is set in the source array
            $fieldValue = isset($this->source[$sourceField]) ? $this->source[$sourceField] : null;
            // perform validation on field
            $fieldValidator->validate($fieldValue);
            // all validators for each field collected into single array
            $valElementsArray[] = [$sourceField => $fieldValidator];
        }
        foreach ($valElementsArray as $key => $validators) {
            foreach ($validators as $fieldName => $validator) {
                // add all validators of each field to the general process of validation
                $this->valElements->addElement($fieldName, $validator);
            }
        }
    }
    
    /**
     * Check if rule passed in rules array is defined in accessible rules array.
     * @param string $rule
     * @throw Exception - the rule must be defined inside the class
     */
    private function checkAllowedRule($rule) {
        if (!in_array($rule, $this->allowedRules)) {
            throw new Exception($rule . ' rule is not defined');
        }
    }
    
    /**
     * Extract validator name from rule based on : separator if it exists.
     * @param string $rule
     * @return string
     */
    private function extractValidatorFromRule($rule) {
        $validator = explode(':', $rule);
        if (!empty($validator)) {
            return $validator[0];
        }
        return $rule;
    }
    
    /**
     * Extract optional arguments from the rule based on : separator if it exists.
     * @param string $rule
     * @return array - the array of arguments
     */
    private function extractArgsFromRule($rule) {
        $args = explode(':', $rule);
        if (!empty($args)) {
            return array_slice($args, 1);
        }
        return [];
    }
    
    /**
     * Get the first value for each field of the validated values array.
     * @return array - the validated values array
     */
    public function getValidated() {
        $validated = [];
        $values = $this->valElements->getValidated();
        foreach ($values as $field => $valid) {
            if (isset($valid[0])) {
                $validated[$field] = $valid[0];
            }
        }
        return $validated;
    }
    
    /**
     * Get the first error for each field of errors array.
     * @return array - the array of errors
     */
    public function getErrors() {
        $errors = [];
        $validationErrors = $this->valElements->getErrors();
        foreach ($validationErrors as $field => $error) {
            if (isset($error)) {
                $errors[$field] = reset($error);
            }
        }
        return $errors;
    }
}
