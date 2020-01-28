<?php

class View{
    protected $view_file;
    protected $view_data = [];

    public function __construct($view_file, $view_data = [] ){
        
        $this -> view_file = str_replace('#',DIRECTORY_SEPARATOR,$view_file);
        $this -> view_data = $view_data;
    } 

    public function render(){
    
        if ( file_exists( VIEW. $this -> view_file .'.phtml') ){
            include VIEW . $this -> view_file .'.phtml';
        }
        else
            die("<pre>View File Mssing of {$this -> view_file}</pre><br>");
    }

    public function getAction(){
        return explode(DIRECTORY_SEPARATOR,$this->view_file);
    } 

}

?>