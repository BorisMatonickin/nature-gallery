<?php

abstract class Controller {
    
    /**
     * ViewFactory object reference.
     */
    protected $view;
    
    /**
     * Set the ViewFactory object reference.
     * @param ViewFactory $viewFactory
     */
    public function __construct(ViewFactory $viewFactory) {
        $this->view = $viewFactory;
    }
}