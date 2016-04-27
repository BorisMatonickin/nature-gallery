<?php

class FormService {
    
    /**
     * Session object reference.
     */
    private $session;
    
    /**
     * Request object reference.
     */
    private $request;
    
    /**
     * Security object reference.
     */
    private $security;
    
    /**
     * Set the object parameters.
     * @param Session $session
     * @param Request $request
     * @param Security $security
     */
    public function __construct(Session $session, Request $request, Security $security) {
        $this->session = $session;
        $this->request = $request;
        $this->security = $security;
    }
    
    
}
