<?php

class SessionMatchValidator extends Validator {
    
    /**
     * Session object reference.
     */
    private $session;
    
    /**
     * The name of the field to be validate against.
     */
    private $matchName;
    
    /**
     * Set the object parameters.
     * @param Session $session
     * @param $matchName
     */
    public function __construct(Session $session, $matchName) {
        $this->session = $session;
        $this->matchName = $matchName;
    }
    
    /**
     * Validate if value matches the field stored in the session.
     * @param mixed $value
     * @return boolean
     */
    public function validate($value) {
        $valueMatchAgainst = $this->session->get($this->matchName);
        if ($value !== $valueMatchAgainst) {
            $this->error = 'Invalid entry';
            return false;
        }
        $this->validated = $value;
        return true;
    }
}
