<?php

class ProfileController extends Controller {
    
    /**
     * ProfileService object reference.
     */
    private $profileService;
    
    /**
     * Session object reference.
     */
    private $session;
    
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
     * @param ProfileService $profileService
     */
    public function __construct(ViewFactory $viewFactory, ProfileService $profileService, Session $session, Request $request, Security $security) {
        parent::__construct($viewFactory);
        $this->profileService = $profileService;
        $this->session = $session;
        $this->request = $request;
        $this->security = $security;
    }
    
    /**
     * Main profile view.
     * @param int $userId
     */
    public function view($userId) {
        $userDetails = $this->profileService->getUserDetails($userId);
        $this->checkUserIsValid((int)$userId, (int)$userDetails['user_id']);
        $userImages = $this->profileService->getAllImagesFromUser($userId);
        $vars = ['userDetails' => $userDetails, 'userImages' => $userImages];
        if ($this->session->exists('user')) {
            $sessionUser = $this->session->get('user');
            $vars['sessionUser'] = $sessionUser;
        }
        $this->view->createView('view_profile', $vars);
    }
    
    /**
     * Edit profile info form processing.
     * @param int $userId
     */
    public function edit($userId) {
        $this->checkUserIsOwner((int)$userId);
        $userDetails = $this->profileService->getUserDetails($userId);
        $vars = ['userDetails' => $userDetails, 'input' => $this->request];
        if ($this->request->isParamSet('update')) {
            $formToken = $this->request->getParam('token');
            $this->security->checkCsrfToken($formToken);
            $sourceParams = $this->request->getPostParams();
            $edit = $this->profileService->edit($userId, $sourceParams);
            if ($edit) {
                $this->security->deleteTokenFromSession('csrfToken');
                $this->session->flash('success', 'Your profile has been updated');
                $this->request->redirect('http://nature.dev/profile/view/' . $userId);
            } else {
                $vars['token'] = $this->security->generateToken();
                $vars['errors'] = $this->profileService->getErrors();
            }
        }
        $vars['token'] = $this->security->generateToken();
        $this->view->createView('edit_profile', $vars);
    }
    
    /**
     * Upload profile image form processing.
     * @param int $userId
     */
    public function upload($userId) {
        $this->checkUserIsOwner((int)$userId);
        $profileImage = $this->profileService->getProfileImage($userId);
        $vars = ['profileImage' => $profileImage];
        if ($this->request->isParamSet('uploadImage')) {
            $formToken = $this->request->getParam('token');
            $this->security->checkCsrfToken($formToken);
            $file = $this->request->getFile('profileImage');
            $sourceParams = $this->request->getPostParams();
            $uploadImage = $this->profileService->uploadProfileImage($userId, $file, $sourceParams);
            if ($uploadImage) {
                $this->profileService->deleteProfileImage($profileImage);
                $this->security->deleteTokenFromSession('captcha');
                $this->session->flash('success', 'Your profile image has been updated');
                $this->request->redirect('http://nature.dev/profile/view/' . $userId);
            } else {
                $vars['token'] = $this->security->generateToken();
                $vars['captcha'] = $this->security->generateCaptcha();
                $vars['errors'] = $this->profileService->getErrors();
                $vars['uploadError'] = $this->profileService->getFileError();
            }
        }    
        $vars['token'] = $this->security->generateToken();
        $vars['captcha'] = $this->security->generateCaptcha();
        $this->view->createView('upload_profile_img', $vars);
    }
    
    /**
     * Access rules array.
     * @return array
     */
    public function accessRules() {
        return [
            'edit' => 'user',
            'upload' => 'user',
        ];
    }
    
    /**
     * Check if user id exists in the database. If not the user is redirected to the index page with 
     *   appropriate message.
     * @param int $userId
     * @param int $databaseUserId
     */
    private function checkUserIsValid($userId, $databaseUserId) {
        if ($userId !== $databaseUserId) {
            $this->session->flash('error', 'Page not found.');
            $this->request->redirect();
        }
    }
    
    /**
     * Check if user is the owner of the profile. If not the user is redirected to the index page 
     *   with appropriate message.
     * @param int $userId
     */
    private function checkUserIsOwner($userId) {
        $sessionUser = $this->session->getUserInfo();
        if ($userId !== $sessionUser['userId']) {
	$this->session->flash('error', 'Page not found.');
	$this->request->redirect();
        }
    }
}
