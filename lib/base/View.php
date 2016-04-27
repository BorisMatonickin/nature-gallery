<?php

class View implements ITemplate, IVarContainer, IView {
    
    /**
     * The name of the default template.
     */
    const DEFAULT_TEMPLATE = 'default.php';
    
    /**
     * The name of the default template.
     */
    private $template = self::DEFAULT_TEMPLATE;
    
    /**
     * Array of the variables which are passed to view file for handling.
     */
    private $vars = [];
    
    /**
     * Set the template and the variables.
     * @param string $template - the name of the template file
     * @param array $vars - variables that needs to be passed to the view file
     */
    public function __construct($template = null, $vars = []) {
        if ($template !== null) {
            $this->setTemplate($template);
        }
        if (!empty($vars)) {
            foreach ($vars as $var => $value) {
                $this->vars[$var] = $value;
            }
        }
    }
    
    /**
     * Set the template.
     * @param string $template - the name of the template
     * @throws Exception - view file should be readable file
     */
    public function setTemplate($template) {
        $view = VIEWS_PATH . DS . $template . '.php';
        if (!is_file($view) || !is_readable($view)) {
            throw new Exception('The template ' . $view . ' is invalid.');
        }
        $this->template = $view;
        return $this;
    }
    
    /**
     * Get the template.
     */
    public function getTemplate() {
        return $this->template;
    }
    
    /**
     * Set variables array that needs to be passed to the view file.
     */
    public function setVar($var, $value) {
        $this->vars[$var] = $value;
        return $this;
    }
    
    /**
     * Get the name of the variable stored in variables array for view file.
     * Variable also can be an instance of the closure.
     * @param string $var - the name of the variable
     * @throws Exception - the variable name should exists as index in array
     */
    public function getVar($var) {
        if (!isset($this->vars[$var])) {
            throw new Exception('Unable to get var ' . $var);
        }
        $variable = $this->vars[$var];
        return $variable instanceof Closure ? $variable($this) : $variable;
    }
    
    /**
     * Extract the variables array to be used in included template file and render the view.
     */
    public function render() {
        extract($this->vars);
        ob_start();
        include $this->template;
        return ob_get_clean();
    }
}

