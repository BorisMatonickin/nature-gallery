<?php

class LoginService {
    
    /**
     * ObjectFactory reference.
     */
    private $factory;
    
    /**
     * UserMapper object reference.
     */
    private $userMapper;
    
    /**
     * Validator object reference.
     */
    private $validator;
    
    /**
     * Session object reference.
     */
    private $session;
    
    /**
     * Sets the object parameters.
     * @param ObjectFactory $factory
     * @param UserMapper $userMapper
     * @param Validator $validator
     * @param Session $session
     */
    public function __construct(ObjectFactory $factory, UserMapper $userMapper, ValidationService $validator, Session $session) {
        $this->factory = $factory;
        $this->userMapper = $userMapper;
        $this->validator = $validator;
        $this->session = $session;
    }
    
    /**
     * Validate user input from the login form and check the login parameters if the validation 
     *   process has been passed.
     * @param array $sourceParams
     * @return boolean
     */
    public function login($sourceParams = []) {
        $this->validator->addSource($sourceParams);
        $this->validator->addRules($this->loginRules());

        if ($this->validator->validate()) {
            $validated = $this->validator->getValidated();
            $user = $this->factory->create('User');
            $user->setUsername($validated['username'])
                 ->setPassword($validated['password']);
            return $this->checkLoginParams($user);
        }
    }
    
    /**
     * Check the user login credencials in the user mapper object. Put the values in the session array.
     * @param IUser $user
     * @return boolean
     */
    private function checkLoginParams(IUser $user) {
        $row = $this->userMapper->fetchOnLogin($user);
        if ($row !== false) {
            $this->session->regenerateId();
            $userDetails = ['userId' => $row['id'],
                     'username' => $row['username'],
                     'loggedIn' => true,
                     'role' => $row['role']];
            $this->session->put('user', $userDetails);
            $this->session->flash('success', 'Welcome ' . $row['username'] . ', you are now logged in');
            return true;
        }
        return false;
    }
    
    /**
     * Login validation rules array.
     * @return array
     */
    private function loginRules() {
        return [
            'username' => ['alphaNum', 'required', 'minLength:2', 'maxLength:80', 'regexp:/^[A-Za-z0-9\-]{2,20}$/i'],
            'password' => ['required', 'minLength:6', 'maxLength:40', 'regexp:/[a-zA-Z0-9\!\@\#\$\%\^\&\*\(\)\_\+]$/i'],
        ];
    }
    
    /**
     * Get errors from the validation process.
     * @return array
     */
    public function getErrors() {
        return $this->validator->getErrors();
    }
}

