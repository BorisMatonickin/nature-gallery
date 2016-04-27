<?php

class ImagesController extends Controller {
    
    /**
     * ImageService object reference.
     */
    private $imageService;
    
    /**
     * CommentService object reference.
     */
    private $commentService;
    
    /**
     * Session object reference.
     */
    private $session;
    
    /**
     * Security object reference. 
     */
    private $security;
    
    /**
     * Request object reference.
     */
    private $request;
    
    /**
     * Set the object parameters.
     * @param ViewFactory $viewFactory
     * @param ImageService $imageService
     */
    public function __construct(ViewFactory $viewFactory, ImageService $imageService, CommentService $commentService, 
                               Session $session, Security $security, Request $request) {
        parent::__construct($viewFactory);
        $this->imageService = $imageService;
        $this->commentService = $commentService;
        $this->session = $session;
        $this->security = $security;
        $this->request = $request;
    }
    
    /**
     * View the choosen image. Page also process commenting the image which is possible only by logged in user.
     * Display slider with other images from the owner of the currently viewed image.
     * @param int $imageId
     */
    public function view($imageId) {
        $image = $this->imageService->getImageDetails($imageId);
        $userId = $image['user_id'];
        $userImages = $this->imageService->getUserImages($userId);
        $comments = $this->commentService->getCommentsByImageId($imageId);
        $sessionUser = $this->session->getUserInfo();
        $vars = ['image' => $image, 'comments' => $comments, 'input' => $this->request, 'sessionUser' => $sessionUser, 'userImages' => $userImages];
        if ($this->request->isParamSet('submitComment')) {
            $formToken = $this->request->getParam('token');
            $this->security->checkCsrfToken($formToken);
            $sourceParams = $this->request->getPostParams();
            $insertComment = $this->commentService->comment($sourceParams);
            if ($insertComment === true) {
                $this->security->deleteTokenFromSession('csrfToken');
                $this->request->refresh();
            } else {
                $vars['token'] = $this->security->generateToken();
                $vars['errors'] = $this->commentService->getErrors();
            }
        }
        $vars['token'] = $this->security->generateToken();
        $this->view->createView('view_image', $vars);
    }
    
    /**
     * Upload image form processing.
     */
    public function upload() {
        $userInfo = $this->session->getUserInfo();
        $userId = $userInfo['userId'];
        $categories = $this->imageService->getCategoriesName();
        $vars = ['input' => $this->request, 'categories' => $categories];
        if ($this->request->isParamSet('upload')) {
            $formToken = $this->request->getParam('token');
            $this->security->checkCsrfToken($formToken);
            $sourceParams = $this->request->getPostParams();
            $file = $this->request->getFile('image');
            $upload = $this->imageService->uploadImage($userId, $file, $sourceParams);
            if ($upload) {
                $this->security->deleteTokenFromSession('csrfToken');
                $this->security->deleteTokenFromSession('captcha');
                $this->session->flash('success', 'Image has been uploaded');
                $this->request->redirect('http://nature.dev/profile/view/' . $userId);
            } else {
                $vars['errors'] = $this->imageService->getErrors();
                $vars['uploadError'] = $this->imageService->getFileError();
                $vars['token'] = $this->security->generateToken();
                $vars['captcha'] = $this->security->generateCaptcha();
            }
        }        
        $vars['token'] = $this->security->generateToken();
        $vars['captcha'] = $this->security->generateCaptcha();
        $this->view->createView('upload_image', $vars);
    }
    
    /**
     * Edit image form processing.
     * @param int $imageId
     */
    public function edit($imageId) {
        $image = $this->imageService->getImageDetails($imageId);
        $this->checkUserIsImageOwner((int)$image['user_id']);
        $categories = $this->imageService->getCategoriesName();
        $vars = ['image' => $image, 'categories' => $categories, 'input' => $this->request];
        if ($this->request->isParamSet('update')) {
	$formToken = $this->request->getParam('token');
	$this->security->checkCsrfToken($formToken);
	$sourceParams = $this->request->getPostParams();
	$edit = $this->imageService->editImage($imageId, $sourceParams);
	if ($edit) {
	    $this->security->deleteTokenFromSession('csrfToken');
	    $this->session->flash('success', 'Image has been updated');
	    $this->request->redirect('http://nature.dev/images/view/' . $imageId);
	} else {
	    $vars['errors'] = $this->imageService->getErrors();
	    $vars['token'] = $this->security->generateToken();
	}
        }   
        $vars['token'] = $this->security->generateToken();
        $this->view->createView('edit_image', $vars);
    }
    
    /**
     * Delete image form processing.
     * @param int $imageId
     */
    public function delete($imageId) {
        $image = $this->imageService->getImageDetails($imageId);
        $this->checkUserIsImageOwner((int)$image['user_id']);
        $vars = ['image' => $image];
        if ($this->request->isParamSet('delete')) {
	$formToken = $this->request->getParam('token');
	$this->security->checkCsrfToken($formToken);
	$this->deleteImage($imageId, $image['name']);
        } elseif ($this->request->isParamSet('cancel')) {
	$this->request->redirect('http://nature.dev/images/view/' . $imageId);
        } else {
	$vars['token'] = $this->security->generateToken();
        }
        $vars['token'] = $this->security->generateToken();
        $this->view->createView('delete_image', $vars);
    }
    
    /**
     * Processing of deleting the image. Redirect the user with appropriate message based on 
     *   success or failure of image deletion.
     * @param int $imageId
     * @param string $imageName
     */
    public function deleteImage($imageId, $imageName) {
        $delete = $this->imageService->deleteImage($imageId, $imageName);
        if ($delete) {
	$this->session->flash('success', 'Image has been deleted.');
	$this->request->redirect();
        } else {
	$this->session->flash('error', 'An error occurred. Image has not been deleted.');
	$this->request->redirect();
        }
    }
    
    /**
     * @return array - the array of access rules for the controller actions
     */
    public function accessRules() {
        return [
            'upload' => 'user',
            'edit' => 'user',
        ];
    }
    
    /**
     * Check if user is owner of the image. If not the user is redirected to the index page with 
     *   appropriate message.
     * @param int $userId
     */ 
    private function checkUserIsImageOwner($userId) {
        $sessionUser = $this->session->getUserInfo();
        if ($userId !== $sessionUser['userId']) {
	$this->session->flash('error', 'Page not found');
	$this->request->redirect();
        }
    }
}
