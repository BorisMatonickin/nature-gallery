<?php   
    
class Security {   
    
    /**
     * Session object reference.
     */
    private $session;
    
    /**
     * Request object reference.
     */
    private $request;
    
    /**
     * Captcha object reference.
     */
    private $captcha;
    
    /**
     * Sets the object parameters.
     * @param Session $session
     * @param Request $request
     * @param Captcha $captcha
     */
    public function __construct(Session $session, Request $request, Captcha $captcha) {
        $this->session = $session;
        $this->request = $request;
        $this->captcha = $captcha;
    }
    
    /**
     * Generate and put csrf token in the session array.
     */
    public function generateToken() {
        return $this->session->put('csrfToken', md5(uniqid(rand(), true)));
    }
    
    /**
     * Check passed in csrf token against the one stored in the session array.
     * @param string $token
     */
    public function checkCsrfToken($token) {
        $sessionToken = $this->session->get('csrfToken');          
        if ($token !== $sessionToken) {
            $this->session->flash('error', 'An error occured. We apologize for any inconvenience.');
            $this->request->redirect();
        }
    }
    
    /**
     * Delete csrf token from session when it's not more usable.
     */
    public function deleteTokenFromSession($name) {
        $this->session->delete($name);
    }
    
    /**
     * Generate captcha image throught Captcha object's image() method.
     */
    public function generateCaptcha() {
        return $this->captcha->image();
    }
}
