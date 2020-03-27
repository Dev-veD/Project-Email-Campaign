<?php

class GLogin{
    public static function getConfiguredClient(){
        require_once "GoogleAPI/vendor/autoload.php";
        $gClient = new Google_Client();
        $gClient -> setClientId("");
        $gClient -> setClientSecret("");
        $gClient -> setApplicationName("Login ");
        $gClient -> setRedirectUri("http://localhost/login&g_callback");
        $gClient -> addScope("https://www.googleapis.com/auth/plus.login https://www.googleapis.com/auth/userinfo.email ");
        return $gClient;
    }
}

?>