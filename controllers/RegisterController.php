<?php

class RegisterController extends Controller {
    
    /**
     * RegisterService object reference.
     */
    private $registerService;
    
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
     * @param ViewFactory $viewFactory
     * @param RegisterService $registerService
     * @param Request $request
     * @param Security $security
     */
    public function __construct(ViewFactory $viewFactory, RegisterService $registerService, Request $request, Security $security) {
        parent::__construct($viewFactory);
        $this->registerService = $registerService;
        $this->request = $request;
        $this->security = $security;
    }
    
    /**
     * Main index page of the registration process. Displays register form and process the registration of users. 
     * Set the csrf token for the form and check if it's valid. Set the captcha image for the form. Get the post 
     *   parameters and pass them to the register service. If registration process is successfull mail with 
     *   activation code is send to the provided email address.
     */
    public function index() {
        $vars = ['input' => $this->request];
        if ($this->request->isParamSet('register')) {
            $formToken = $this->request->getParam('token');
            $this->security->checkCsrfToken($formToken);
            $sourceParams = $this->request->getPostParams();
            $register = $this->registerService->register($sourceParams);
            if ($register) {
                $this->security->deleteTokenFromSession('csrfToken');
                $this->security->deleteTokenFromSession('captcha');
                $this->registerService->sendActivationCode();
            } else {
                $vars['errors'] = $this->registerService->getErrors();
                $vars['token'] = $this->security->generateToken();
                $vars['captcha'] = $this->security->generateCaptcha();
            }
        }
        $vars['token'] = $this->security->generateToken();
        $vars['captcha'] = $this->security->generateCaptcha();
        $this->view->createView('register', $vars);
    }
    
    /**
     * @return array - the array of access rules for the controller action
     */
    public function accessRules() {
        return ['index' => 'guest'];
    }
}
