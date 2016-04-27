<?php

class ViewFactory {
    
    /**
     * ObjectFactory object reference.
     */
    private $factory;
    
    /**
     * CompositeView object reference.
     */
    private $composite;
    
    /**
     * Session object reference;
     */
    private $session;
    
    /**
     * Sets the object properties.
     * @param ObjectFactory $factory
     * @param CompositeView $compositeView
     */
    public function __construct(ObjectFactory $factory, CompositeView $compositeView, Session $session) {
        $this->factory = $factory;
        $this->composite = $compositeView;
        $this->session = $session;
    }
    
    /**
     * Create site template from passed in view file. The header and footer files are part of every page so they 
     *   are created in the method by default. If variables array is set each variable is passed to the main view 
     *   content as name => value pair. Session object is passed to the header and the footer.
     * @param string $view - the name of the view file
     * @param array $vars - the array of variables that needs to be passed to the view file 
     */
    public function createView($view, $vars = []) {
        $header = $this->factory->create('View', ['header']);
        $header->setVar('session', $this->session);
        
        $viewContent = $this->factory->create('View', [$view]);
        
        $footer = $this->factory->create('View', ['footer']);
        $footer->setVar('session', $this->session);
        
        if (!empty($vars)) {
            foreach ($vars as $var => $value) {
                $viewContent->setVar($var, $value);
            }
        }        
        echo $this->composite->attachView($header)
                  ->attachView($viewContent)
                  ->attachView($footer)
                  ->render();
    }
}

