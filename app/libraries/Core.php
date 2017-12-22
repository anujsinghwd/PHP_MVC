<?php
    /*
     * App Core class
     * create url and  load core controller
     * URL Format - /controller/method/params
     */
    
class Core {
    protected $currentController = 'Pages';
    protected $currentMethod = 'index';
    protected $params = [];

    public function __construct(){
        //print_r($this->getUrl());
        $url = $this->getUrl();

        //Look in controller for first index or value
        if(file_exists('../app/controllers/' . ucwords($url[0]) . '.php')) {
            // If exists as cotroller
            $this->currentController = ucwords($url[0]);
            //unset 0 index
            unset($url[0]);
        }

        //Require the controller
        require_once "../app/controllers/".$this->currentController .'.php';

        //Instantiate current controller
        $this->currentController = new $this->currentController;

        //check for the second part of the url
        if(isset($url[1])) {
            //check method is exists or not
            if(method_exists($this->currentController, $url[1])) {
                $this->currentMethod = $url[1];
                unset($url[1]);
            }
        }

        // Get Params
        $this->params = $url ? array_values($url) : [];

        // Call a callback with array of params
        call_user_func_array([$this->currentController, $this->currentMethod], $this->params);
    }

    public function getUrl(){
        if(isset($_GET['url'])) {
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);
            return $url;
        }
        
    }
}     

