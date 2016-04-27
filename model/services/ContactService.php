<?php

class ContactService {
    
    /**
     * 
     */
    private $contactEntity;
    
    /**
     * ValidationService object reference.
     */
    private $validator;
    
    /**
     * Mailer object reference.
     */
    private $mailer;
    
    /**
     * Set the object parameters.
     * @param ValidationService $validator
     * @param Mailer $mailer
     */
    public function __construct(Contact $contactEntity, ValidationService $validator, Mailer $mailer) { 
        $this->validator = $validator;
        $this->mailer = $mailer;
        $this->contactEntity = $contactEntity;
    }
    
    /**
     * 
     */
    public function validateContactDetails($sourceParams = []) {
        $this->validator->addSource($sourceParams);
        $rules = $this->contactRules();
        $this->validator->addRules($rules);
        
        if ($this->validator->validate()) {
	$validated = $this->validator->getValidated();
	$this->contactEntity->setName($validated['name'])
		        ->setEmail($validated['email'])
		        ->setMessage($validated['message']);
	return true;
        }
        return false;
    }
    
    /**
     * Send the email to site admin.
     */
    public function sendEmailToAdmin() {
        $name = $this->contactEntity->getName();
        $email = $this->contactEntity->getEmail();
        $message = $this->contactEntity->getMessage();
        $this->mailer->sendMailToAdmin($name, $email, $message);
    }
    
    /**
     * Get the errors from the validation process.
     * @return array
     */
    public function getErrors() {
        return $this->validator->getErrors();
    }
    
    /**
     * @return - array of rules for contact form validation
     */
    private function contactRules() {
        return [
	'name' => ['required', 'minLength:2', 'maxLength:80', 'spamFilter', ],
	'email' => ['email', 'required', 'minLength:5', 'maxLength:60', 'spamFilter', 'regexp:/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/i'],
	'message' => ['required', 'spamFilter', 'regexp:/^[a-zA-Z0-9?$@#()\'"!,+\-=_;.&%\s]+$/'],
	'captcha' => ['required', 'alphaNum', 'sessionMatch:captcha']
        ];
    }
}

