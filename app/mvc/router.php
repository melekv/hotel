<?php

class Router {
    // setup controller for home page
    private $page = 'Home';
    private $method = 'index';
    private $params = [];

    function __construct($req_uri) {
        $route = $this->parseUrl($req_uri);

        if ($route[0] == '') return;

        // first element is the controller name
        // make the first letter uppercase
        $this->page = ucfirst($route[0]);
        $c = $this->page . 'Controller';

        try {
            if(class_exists($c)) {
        
                // second element is the method name
                if(isset($route[1])) {
                    if(method_exists($c, $route[1])) {
                        $this->method = $route[1];
        
                        // third element is the parameter
                        // convert to array
                        if(isset($route[2])) {
                            $this->params = array_slice($route, 2, count($route) - 2);
                        }
                    } else {
                        throw new Exception('Method does not exist');
                    }
                }
            } else {
                throw new Exception('<h1>Page does not exist!</h1>');
            }
        } catch (Exception $e) {
            $this->page = 'Home';
            echo 'Error: ' . $e->getMessage();
        }
    }

    private function parseUrl($req_uri) : array {
        $path = filter_var(trim($req_uri, '/'), FILTER_SANITIZE_URL);
        return explode('/', $path);
    }

    // public function getModel() {
    //     $m = $this->page . 'Model';
    //     return new $m();
    // }

    public function getView() {
        $v = $this->page . 'View';
        return new $v();
    }

    public function getController() { // $model) {
        $c = $this->page . 'Controller';
        return new $c(); // $model);
    }

    public function getMethod() {
        return $this->method;
    }

    public function getParams() {
        return $this->params;
    }

    public function getPageName() {
        return $this->page;
    }
}

$r = new Router($_SERVER['REQUEST_URI']);

// $model = $r->getModel();
$model = new Model();
$view = $r->getView();
$controller = $r->getController(); // $model);

$method = $r->getMethod();
$params = $r->getParams();

?>