<?php
class home{
    protected static $G_url;
    function _construct(){
        $G_url = loginController::initGoogle();
    }
}
?>