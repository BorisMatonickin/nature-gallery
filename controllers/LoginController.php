<?php

class LoginController extends Controller {
    
    /**
     * LoginService object reference.
     */
    private $loginService;
    
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
     * @param ViewFactory $factory
     * @param LoginService $loginService
     * @param Request $request
     */
    public function __construct(ViewFactory $factory, LoginService $loginService, Request $request, Security $security) {
        parent::__construct($factory);
        $this->loginService = $loginService;
        $this->request = $request;
        $this->security = $security;
    }
    
    /**
     * Main index page of the login process. Displays login form and process login action. Set the csrf token 
     *  for the form and check if it's valid. Get the post parameters and pass them to the login service.
     */
    public function index() {
        $vars = ['input' => $this->request];
        if ($this->request->isParamSet('login')) {
            $formToken = $this->request->getParam('token');
            $this->security->checkCsrfToken($formToken);
            $sourceParams = $this->request->getPostParams();
            $login = $this->loginService->login($sourceParams);
            if ($login === true) {
                $this->security->deleteTokenFromSession('csrfToken');
                $this->request->redirect();
            } elseif ($login === false) {
                $vars['loginError']= 'Invalid username/password combination';
                $vars['token'] = $this->security->generateToken();
            } else {
                $vars['errors'] = $this->loginService->getErrors();
                $vars['token'] = $this->security->generateToken();
            }
        }
        $vars['token'] = $this->security->generateToken();
        $this->view->createView('login', $vars);
    }
    
    /**
     * @return array - the array of access rules for the controller actions
     */
    public function accessRules() {
        return ['index' => 'guest'];
    }
}
