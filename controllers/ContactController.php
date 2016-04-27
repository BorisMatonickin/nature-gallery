<?php

class ContactController extends Controller {
    
    /**
     * ContactService object reference.
     */
    private $contactService;
    
    /**
     * Security object reference.
     */
    private $security;
    
    /**
     * Request object reference.
     */
    private $request;
    
    /**
     * Set the object parameters.
     * @param ViewFactory $viewFactory
     * @param ContactService $contactService
     */
    public function __construct(ViewFactory $viewFactory, ContactService $contactService, Security $security, Request $request) {
        parent::__construct($viewFactory);
        $this->contactService = $contactService;
        $this->security = $security;
        $this->request = $request;
    }
    
    /**
     * Contact form processing.
     */
    public function index() {
        $vars = ['input' => $this->request];
        if ($this->request->isParamSet('contact')) {
	$formToken = $this->request->getParam('token');
	$this->security->checkCsrfToken($formToken);
	$sourceParams = $this->request->getPostParams();
	$contact = $this->contactService->validateContactDetails($sourceParams);
	if ($contact) {
	    $this->security->deleteTokenFromSession('token');
	    $this->security->deleteTokenFromSession('captcha');
	    $this->contactService->sendEmailToAdmin();
	} else {
	    $vars['errors'] = $this->contactService->getErrors();
	    $vars['token'] = $this->security->generateToken();
	    $vars['captcha'] = $this->security->generateCaptcha();
	}
        }
        $vars['token'] = $this->security->generateToken();
        $vars['captcha'] = $this->security->generateCaptcha();
        $this->view->createView('contact', $vars);
    }
}

