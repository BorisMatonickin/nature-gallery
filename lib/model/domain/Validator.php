<?php

abstract class Validator {
    
    protected $error;

    protected $validated;
    
    public function getError() {
        return $this->error;
    }
    
    public function getValidated() {
        return $this->validated;
    }
}

