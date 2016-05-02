<?php  
    
class Application {
    
    /**
     * Router object reference.
     */
    private $router;
    
    /**
     * AccessConstroller object reference.
     */
    private $accessController;
    
    /**
     * Auryn Injector object reference.
     */
    private $injector;
    
    /**
     * Set objects references parameters needed in class.
     * @param AccessController $accessController
     * @param \Auryn\Injector $injector
     * @param Router $router
     */
    public function __construct(AccessController $accessController, \Auryn\Injector $injector, Router $router) {
        $this->accessController = $accessController;
        $this->injector = $injector;
        $this->router = $router;
    }
    
    /**
     * Run the application by setting appropriate controller class and method.
     */
    public function run() {       
        $controllerClass = ucfirst($this->router->getController()) . 'Controller';
        $controllerMethod = $this->router->getAction();
        $this->setControllerObject($controllerClass, $controllerMethod);
    }
    
    /**
     * Set the controller object and before calling the appropriate method check access rules for user 
     *   visiting the application.
     * @param string $controllerClass
     * @param string $controllerMethod
     * @throws Exception - called method of the controller object must exists
     */
    private function setControllerObject($controllerClass, $controllerMethod) {
        $controllerObject = $this->injector->make($controllerClass);
        if (method_exists($controllerObject, $controllerMethod)) {
            $this->checkAccessRules($controllerObject, $controllerMethod);
            $args = $this->getUriParams();
            if (isset($args)) {
                call_user_func_array([$controllerObject, $controllerMethod], $args);
            } else {
                $controllerObject->$controllerMethod();
            }
        } else {
            throw new Exception('Method ' . $controllerMethod . ' of class ' . $controllerClass . ' does not exists.');
        }
    }
    
    /**
     * If method accessRules exists in the controller object, AccessController object checks the rules and 
     *   perform actions accordingly. If method does not exists the visited part of the application is 
     *   accessible by every user.
     * @param string $controllerObject
     * @param string $controllerMethod
     */
    private function checkAccessRules($controllerObject, $controllerMethod) {
        if (method_exists($controllerObject, 'accessRules')) {
            $accessRules = $controllerObject->accessRules();
            $this->accessController->setAccessRules($accessRules);
            $this->accessController->checkAccess($controllerMethod);
        }
    }
    
    /**
     * Get optional uri parameters.
     * @return array
     */
    private function getUriParams() {
        $params = $this->router->getParams();
        if (isset($params) && !empty($params)) {
            return $params;
        }
        return null;
    }
    
    /**
     * Get the router object.
     * @return object Router
     */
    public function getRouter() {
        return $this->router;
    }
}

