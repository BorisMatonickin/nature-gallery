<?php

class SpamFilterValidator extends Validator {
    
    /**
     * Validated if value contains some invalid keywords which enable possible header injection.
     * @param mixed $value
     * @return boolean
     */
    public function validate($value) {
        $notAllowed = ['cc:', 'bcc:', 'to:', 'content-type:', 'mime-version:', 'multipart/mixed', 'content-transfer-encoding:', '\r', '\n', '%0a', '%0d'];
        foreach ($notAllowed as $x) {
	if (stripos($value, $x) !== false) {
	    $this->error = 'Invalid format';
	    return false;
	}
        }
        $this->validated = $value;
        return true;
    } 
}
