<?php

class CategoriesController extends Controller {
    
    /**
     * CategoryService object reference.
     */
    private $categoryService;
    
    /**
     * Set the object parameters.
     * @param ViewFactory $viewFactory
     * @param CategoryService $categoryService
     */
    public function __construct(ViewFactory $viewFactory, CategoryService $categoryService) {
        parent::__construct($viewFactory);
        $this->categoryService = $categoryService;
    }
    
    /**
     * Main categories view with images inside each one.
     */
    public function index() {
        $categories = $this->categoryService->getCategoriesWithImages();
        $vars = ['categories' => $categories];
        $this->view->createView('categories', $vars);
    }
    
    /** 
     * View images from category.
     * @param int $catId
     */
    public function view($catId) {
        $category = $this->categoryService->getCategoryDetails($catId);
        $images = $this->categoryService->getImagesFromCategory($catId);
        $vars = ['category' => $category, 'images' => $images];
        $this->view->createView('view_category', $vars);
    }
}

