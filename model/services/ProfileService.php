<?php

class ProfileService {
    
    /**
     * UserMapper object reference.
     */
    private $userMapper;
    
    /**
     * ImageMapper object reference.
     */
    private $imageMapper;
    
    /**
     * ValidationService object reference.
     */
    private $validator;
    
    /**
     * ObjectFactory object reference.
     */
    private $factory;
    
    /**
     * UploadService object factory.
     */
    private $uploadService;
    
    /**
     * Set the object parameters.
     * @param UserMapper $userMapper
     * @param ImageMapper $imageMapper
     */
    public function __construct(UserMapper $userMapper, ImageMapper $imageMapper, ValidationService $validator, ObjectFactory $factory, UploadFileService $uploadService) {
        $this->userMapper = $userMapper;
        $this->imageMapper = $imageMapper;
        $this->validator = $validator;
        $this->factory = $factory;
        $this->uploadService = $uploadService;
    }
    
    /**
     * Get the user details for main profile page.
     * @param int $userId
     * @return array
     */
    public function getUserDetails($userId) {
        $sanitized = $this->validateAndSanitizeUserId($userId);
        return $this->userMapper->fetchUserDetails($sanitized);
    }
    
    /**
     * Get images from the user.
     * @param int $userId
     * @return array
     */
    public function getUserImages($userId) {
        $sanitized = $this->validateAndSanitizeUserId($userId);
        return $this->imageMapper->fetchUserImages($sanitized);
    }
    
    /**
     * Get all images from the user.
     * @param int $userId
     * @return array
     */
    public function getAllImagesFromUser($userId) {
        $sanitized = $this->validateAndSanitizeUserId($userId);
        return $this->imageMapper->fetchAllImagesFromUser($sanitized);
    }
    
    /**
     * Get the profile image of the user.
     * @param int $userId
     * @return array
     */
    public function getProfileImage($userId) {
        $sanitized = $this->validateAndSanitizeUserId($userId);
        return $this->userMapper->fetchProfileImage($sanitized);
    }
    
    /**
     * Set user details on edit profile info. All fields are optional except username and gender. 
     * They are updated only if they are different then previously stored values.
     * @param int $userId
     * @param array $sourceParams
     * @return boolean 
     */
    public function edit($userId, $sourceParams = []) {
        $val = $this->validateOnEdit($userId, $sourceParams);
        if ($val) {
            $validated = $this->validator->getValidated();
            $sanitizedId = $this->validateAndSanitizeUserId($userId);
            $user = $this->factory->create('User');
            $user->setId($sanitizedId)
                 ->setUsername($validated['username'])
                 ->setGender($validated['gender']);
            if (isset($validated['firstName'])) {
                $user->setFirstName($validated['firstName']);
            }
            if (isset($validated['lastName'])) {
                $user->setLastName($validated['lastName']);
            }
            if (isset($validated['city'])) {
                $user->setCity($validated['city']);
            }
            if (isset($validated['state'])) {
                $user->setState($validated['state']);
            }
            if (isset($validated['country'])) {
                $user->setCountry($validated['country']);
            }
            if (isset($validated['about'])) {
                $user->setAbout($validated['about']);
            }
            return $this->userMapper->updateUserDetails($user);
        }
        return false;
    }
    
    /**
     * Set the user object parameters regarding to profile image.
     * @param int $userId
     * @param array $file - array of file data from the form
     * @param array $sourceParams
     */
    public function uploadProfileImage($userId, $file = [], $sourceParams = []) {
        $val = $this->validateOnUploadProfileImage($sourceParams);
        $fileVal = $this->validateUploadedFile($file);
        if ($val && $fileVal) {
            $sanitizedId = $this->validateAndSanitizeUserId($userId);
            $image = $this->uploadService->getFileName();
            $user = $this->factory->create('User');
            $user->setId($sanitizedId)
                 ->setProfileImage($image);
            return $this->userMapper->updateProfileImage($user);
        }
        return false;
    }
    
    /**
     * Delete old profile image.
     * @param string $image
     */
    public function deleteProfileImage($image) {
        $this->uploadService->destroyFile($image);
    }
    
    /**
     * Validate edit profile form data. Add unique rule to validation rules if user tries to change their username.
	 * @param int $userId
     * @param array $sourceParams
     * @return boolean
     */
    private function validateOnEdit($userId, $sourceParams = []) {
        $userDetails = $this->getUserDetails($userId);
        $this->validator->addSource($sourceParams);
        $rules = $this->editProfileRules();
        $this->validator->addRules($rules);
        if ($sourceParams['username'] !== $userDetails['username']) {
            $rule = 'unique:user:username';
            $this->validator->addRule('username', $rule);
        }
        return ($this->validator->validate()) ? true : false;
    }
    
    /**
     * Validate data from the upload profile image form.
     * @param array $sourceParams
     * @return boolean
     */
    private function validateOnUploadProfileImage($sourceParams = []) {
        $this->validator->addSource($sourceParams);
        $rules = $this->uploadProfileImageRules();
        $this->validator->addRules($rules);
        return ($this->validator->validate()) ? true : false;
    }
    
    /**
     * Validate and upload image file.
     * @param array $file - array of file data from the form
     * @return boolean
     */
    private function validateUploadedFile($file = []) {
        $this->uploadService->setMaxFileSize(2097152);
        $allowedFileTypes = ['jpg' => 'image/jpeg', 'png' => 'image/png', 'gif' => 'image/gif'];
        $this->uploadService->setAllowedFileTypes($allowedFileTypes);
        $uploadDir = ROOT . DS . 'webroot' . DS . 'img' . DS;
        $this->uploadService->setUploadDir($uploadDir);
        $val = $this->uploadService->attachFile($file);
        return ($val === true) ? true : false;
    }
    
    /**
     * @return array of rules for edit profile form entries
     */
    private function editProfileRules() {
        return [
            'username' => ['required', 'alphaNum', 'minLength:2', 'maxLength:80', 'regexp:/^[A-Za-z0-9]{2,80}$/i'],
            'gender' => ['required', 'alpha', 'minLength:2', 'maxLength:10'],
            'firstName' => ['alpha', 'minLength:2', 'maxLength:20', 'regexp:/^[A-Za-z]{2,20}$/i'],
            'lastName' => ['alpha', 'minLength:2', 'maxLength:40', 'regexp:/^[A-Za-z]{2,40}$/i'],
            'city' => ['alpha', 'minLength:2', 'maxLength:60', 'regexp:/^[A-Za-z\s]{2,60}$/i'],
            'state' => ['alpha', 'minLength:2', 'maxLength:60', 'regexp:/^[A-Za-z\s]{2,60}$/i'],
            'country' => ['alpha', 'minLength:2', 'maxLength:60', 'regexp:/^[A-Za-z\s]{2,60}$/i'],
            'about' => ['regexp:/^[a-zA-Z0-9?$@#()\'"!,+\-=_;.&%\s]+$/'],
        ];
    }
    
    /**
     * @return array of rules for upload profile image rules
     */
    private function uploadProfileImageRules() {
        return [
            'captcha' => ['alphaNum', 'required', 'sessionMatch:captcha'],
        ];
    }
    
    /**
     * Validate and sanitize user id which should be an valid integer.
     * @param int $userId
     * @throws Exception - user id must be an valid integer
     * @return int
     */
    private function validateAndSanitizeUserId($userId) {
        if (!filter_var($userId, FILTER_VALIDATE_INT)) {
            throw new Exception('Invalid parameter for user id');
        }
        $sanitized = filter_var($userId, FILTER_SANITIZE_NUMBER_INT);
        return $sanitized;
    }
    
    /**
     * Get the errors from validation service.
     * @return array
     */
    public function getErrors() {
        return $this->validator->getErrors();
    }
    
    /**
     * Get the error from file validation and upload process.
     * @return string
     */
    public function getFileError() {
        return $this->uploadService->getError();
    }
    
    /**
     * Get values passed the validation from validation service.
     * @return array
     */
    public function getValidated() {
        return $this->validator->getValidated();
    }
}

