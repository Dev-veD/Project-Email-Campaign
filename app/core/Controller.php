<?php

class Controller {
    protected $view;
    protected $dataForView=[];
    public function view($view_name, $data = []){
        $this -> view = new View($view_name, $data);
    }
}   

?>