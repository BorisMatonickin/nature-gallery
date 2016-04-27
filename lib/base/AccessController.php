<?php

class AccessController {
    
    /**
     * Session object reference.
     */
    private $session;
    
    /**
     * Request object reference.
     */
    private $request;
    
    /**
     * Array of the access rules.
     */
    private $accessRules = [];
    
    /**
     * Available roles for the access through application.
     * Guest - every user visiting application without any restriction
     * User - the user that is registered in the application
     * Admin - the administrator of the application
     */
    private $roles = ['guest', 'user', 'admin', 'owner'];
    
    /**
     * Set the session object reference.
     * Set the request object reference.
     * Set the user info array optained from session.
     * @param Session $session
     * @param Request $request
     */
    public function __construct(Session $session, Request $request) {
        $this->session = $session;
        $this->request = $request;
    }
    
    /**
     * Set access rules array.
     * @param array $accessRules
     */
    public function setAccessRules($accessRules = []) {
        $this->accessRules = $accessRules;
    }
    
    /**
     * Check access rules array and call appropriate methods which applies particular 
     *   restriction based on user role.
     * @param string controllerMethod
     */
    public function checkAccess($controllerMethod) {
        foreach ($this->accessRules as $action => $role) {
            if ($action === $controllerMethod) {
                $this->checkRole($role);
                switch ($role) {
                    case 'guest':
                        $this->forbidAccessForLogged();
                        break;
                    case 'user':
                        $this->forbidAccessForGuest();
                        break;
                    case 'admin':
                        $this->forbidAccessToAdminArea();
                        break;
                }
            }
        }
    }
    
    /**
     * Check if the user role for checking against access rules is set in the available 
     *  roles array.
     * @param string $role
     * @throws Exception - the user role must be defined
     */
    private function checkRole($role) {
        if (!in_array($role, $this->roles)) {
            throw new Exception('The role ' . $role . ' is undefined');
        }
    }
    
    /**
     * Forbid access for logged user based on session user data eg. logged user 
     *   can't access registration page.
     */
    private function forbidAccessForLogged() {
        if ($this->session->isUserLoggedIn()) {
            $this->request->redirect();
        }
    }
    
    /**
     * Forbid access for regular user based on session user data, from visiting areas which 
     *   are allowed to view only by registered and logged users.
     */
    private function forbidAccessForGuest() {
        if ($this->session->isUserLoggedIn() === false) {
            $this->request->redirect();
        }
    }
    
    /**
     * Forbid access to admin area for any user that have not privilege of administrator role based 
     *   on session user data.
     */
    private function forbidAccessToAdminArea() {
        if ($this->session->isUserAdmin() === false) {
            $this->request->redirect();
        }
    }
}
