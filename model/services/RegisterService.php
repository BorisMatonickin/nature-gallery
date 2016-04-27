<?php

class RegisterService {

    /**
     * User object reference.
     */
    private $user;
    
    /**
     * UserMapper object reference.
     */
    private $userMapper;
    
    /**
     * Validator object reference.
     */
    private $validator;
    
    /**
     * Mailer object reference.
     */
    private $mailer;
    
    /**
     * Set the object parameters.
     * @param User $user
     * @param UserMapper $userMapper
     * @param Validator $validator
     * @param Mailer $mailer
     */
    public function __construct(User $user, UserMapper $userMapper, ValidationService $validator, Mailer $mailer) {
        $this->user = $user;
        $this->userMapper = $userMapper;
        $this->validator = $validator;
        $this->mailer = $mailer;
    }
    
    /**
     * Validate user input from the registration form. If the validation process has passed values are added 
     *   to the user object for inserting new user into database. 
     *   
     */
    public function register($sourceParams = []) {         
        $this->validator->addSource($sourceParams);
        $rules = $this->registerRules();
        $this->validator->addRules($rules);

        if ($this->validator->validate()) {
            $validated = $this->validator->getValidated();
            $active = md5(uniqid(rand(), true));
            $this->user->setEmail($validated['email'])
                   ->setUsername($validated['username'])
                   ->setPasswordForRegister($validated['password'])
                   ->setGender($validated['gender'])
                   ->setActive($active)
                   ->setRole('user');
            return $this->userMapper->insertOnRegister($this->user);
        } else {
            return false;
        }
    }
    
    /**
     * Register validation rules array.
     * @return array
     */
    private function registerRules() {
        return [
            'username' => ['alphaNum', 'required', 'unique:user:username', 'minLength:2', 'maxLength:80', 'regexp:/^[A-Za-z0-9\-]{2,80}$/i'],
            'email' => ['email', 'required', 'unique:user:email', 'minLength:5', 'maxLength:60', 'regexp:/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/i'],
            'password' => ['required', 'minLength:6', 'maxLength:40', 'match:passwordConfirm'],
            'passwordConfirm' => ['required', 'minLength:6', 'maxLength:40', 'regexp:/[a-zA-Z0-9\!\@\#\$\%\^\&\*\(\)\_\+]$/i'],
            'gender' => ['alpha', 'required'],
            'captcha' => ['alphaNum', 'required', 'sessionMatch:captcha'],
        ];
        
    }
    
    /**
     * Send the activation code to the user provided email address.
     */
    public function sendActivationCode() {
        $username = $this->user->getUsername();
        $email = $this->user->getEmail();
        $activationCode = $this->user->getActive();
        $this->mailer->sendActivationCode($username, $email, $activationCode);
    }
    
    /**
     * Get errors from the validation process.
     * @return array
     */
    public function getErrors() {
        return $this->validator->getErrors();
    }
}

