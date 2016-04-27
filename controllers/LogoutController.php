<?php

class LogoutController extends Controller {
    
    /**
     * Session object reference.
     */
    private $session;
    
    /**
     * Request object reference.
     */
    private $request;
    
    /**
     * Set the object parameters.
     * @param Session $session
     * @param Request $request
     */
    public function __construct(ViewFactory $factory, Session $session, Request $request) {
        parent::__construct($factory);
        $this->session = $session;
        $this->request = $request;
    }
    
    /**
     * Main index page of the logout process. Session is destroyed and user is redirected.
     */
    public function index() {
        $this->session->destroy();
        $this->request->redirect();
    }
}

