<?php

class ActivateController extends Controller {
    
    /**
     * ActivationService object reference.
     */
    private $activationService;
    
    /**
     * Request object reference.
     */
    private $request;
    
    /**
     * Sets the object parameters.
     * @param ViewFactory $factory
     * @param ActivationService $activationService
     * @param Request $request
     */
    public function __construct(ViewFactory $factory, ActivationService $activationService, Request $request) {
        parent::__construct($factory);
        $this->activationService = $activationService;
        $this->request = $request;
    }
    
    /**
     * Main index method of the activation process after registration.
     */
    public function index() {
        $this->activationService->activate($this->request);      
        $this->request->redirect();
    }
}
