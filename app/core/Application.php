<?php

class Application
{
    protected $controller='homeController' ;
    protected $action='index';
    protected $params=[];
    protected $error = false;
    protected $message = "Error";

    public function __construct()                   //Load the Controller and Requested Action as Well               
    {
        $this->prepareURL();
        
        if (file_exists(CONTROLLER.$this->controller.'.php')) {
            $this -> controller =  new $this -> controller;
            if (method_exists($this -> controller, $this -> action)) {
                call_user_func_array([$this -> controller, $this -> action], $this -> params);
            } else {
                $this -> error = true;
                $this -> message = "No method found under name <pre>{$this -> action}</pre><br>";
            }
        } else {
            $this -> error = true;
            $this -> message = "No file found at <pre>".CONTROLLER."$this->controller.php</pre><br>";
        }
        if ($this->error) {
            $error = new oopsController;
            $error->oopsNotFound($this->message);
            $this->error = false;
        }
    }

    public function prepareURL()                    //Fetch Useful Information from URL and Assign Controller its action
    {
        
        $URI = trim($_SERVER['REQUEST_URI'], '/');
        if (!empty($URI)) {
            $url = explode('&', $URI);
            $x = explode('?', $url[1]);
            $url[1]= $x[0];
            $this -> controller = isset($url[0])?$url[0]."Controller": "homeController" ;
            $this -> action = isset($url[1])?$url[1]: "index" ;
            unset($url[0],$url[1]);
            $this -> params = (!empty($url))? array_values($url):[] ;
        }
    }
}
