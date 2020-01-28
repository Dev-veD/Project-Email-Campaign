<?php

class Application {
    protected $controller='homeController' ;
    protected $action='index';
    protected $params=[];

    public function __construct(){
        $this->prepareURL();
        
        if(file_exists(CONTROLLER.$this->controller.'.php')){
            
           $this -> controller =  new $this -> controller;
           if(method_exists($this -> controller, $this -> action)){
                call_user_func_array([$this -> controller, $this -> action], $this -> params);
            }
            else
            {
                die ("No method found under name <pre>{$this -> action}</pre><br>");
            }
        }
        else 
            die ("No file found at <pre>".CONTROLLER."$this->controller.php</pre><br>");

    }


    public function prepareURL(){
        $URI = trim($_SERVER['REQUEST_URI'],'/');
        if(!empty($URI)){
            $url = explode('&',$URI);
            $this -> controller = isset($url[0])?$url[0]."Controller": "homeController" ;
            $this -> action = isset($url[1])?$url[1]: "index" ;
            unset($url[0],$url[1]);
            $this -> params = (!empty($url))? array_values($url):[] ;
        }
       
    }

    
 

}
