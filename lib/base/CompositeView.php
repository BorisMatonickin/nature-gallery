<?php

class CompositeView implements IView {
    
    /**
     * Array of views to be loaded.
     */
    private $views = [];
    
    /**
     * Add view to views array to be loaded.
     * @param IView $view
     */
    public function attachView(IView $view) {
        if (!in_array($view, $this->views, true)) {
            $this->views[] = $view;
        }
        return $this;
    }
    
    /**
     * Remove view from views array.
     * @param Iview $view
     */
    public function detachView(Iview $view) {
        $this->views = array_filter($this->views, function($value) use ($view) {
            return $value !== $view;
        });
        return $this;
    }
    
    /**
     * Rendering the content of each view in composite view array.
     */
    public function render() {
        $output = '';
        foreach ($this->views as $view) {
            $output .= $view->render();
        }
        return $output;
    }
}

