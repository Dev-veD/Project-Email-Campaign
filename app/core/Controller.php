<?php

class Controller {

    protected $view;

    public function view($view_name, $data = []){
        $this -> view = new View($view_name, $data);
    }

}

?>