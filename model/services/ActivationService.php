<?php

class ActivationService {
    
    /**
     * Object factory reference.
     */
    private $factory;
    
    /**
     * UserMapper reference.
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
     * Set teh object parameters.
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
     * Validate allowed $_GET request parameters against validation rules. If validation process is successfull
     *   the user status is updated to beeing active.
     * @param Request $request
     */
    public function activate(Request $request) {
        $params = $request->allowedGetParams(['email', 'activationCode']);
        $this->validator->addSource($params);
        $rules = $this->activationRules();
        $this->validator->addRules($rules);
        
        if ($this->validator->validate()) {
            $validated = $this->validator->getValidated();
            $user = $this->factory->create('User');
            $user->setEmail($validated['email'])
                 ->setActive($validated['activationCode']);
            $this->updateActiveUser($user);
        } else {
            $this->session->flash('error', 'Your account could not be activated. Please re-check the link or contact the system administrator.');
        }
    }
    
    /**
     * Update user active status.
     * @param User $user
     */
    private function updateActiveUser(User $user) {
        $check = $this->userMapper->updateActiveUser($user);
        if ($check === true) {
            $this->session->flash('success', 'Your account is now active. You may now login');
        } else {
            $this->session->flash('error', 'Your account could not be activated. Please re-check the link or contact the system administrator.');
        }
    }
    
    /**
     * Activation parameters validation rules array.
     * @return array
     */
    private function activationRules() {
        return [
            'email' => ['email', 'required', 'minLength:2', 'maxLength:80', 'regexp:/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/i'],
            'activationCode' => ['alphaNum', 'required', 'requiredLength:32'],
        ];
    }
}

