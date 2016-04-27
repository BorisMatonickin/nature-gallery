<?php

class DefaultController extends Controller {
    
    /**
     * ImageService object reference.
     */
    private $imageService;
    
    /**
     * Set the object parameters.
     * @param ViewFactory $viewFactory
     * @param ImageService $imageService
     * @param Session $session
     */
    public function __construct(ViewFactory $viewFactory, ImageService $imageService) {
        parent::__construct($viewFactory);
        $this->imageService = $imageService;
    }
    
    /**
     * Main index method of the default page of the application. The session object is passed to the view 
     *   for checking flash messages.
     */
    public function index() {
        $categories = $this->imageService->getCategoriesWithImagesForIndex();
        $this->view->createView('index', ['categories' => $categories]);
    }
}
