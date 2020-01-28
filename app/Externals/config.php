<?php
    session_start();
    require_once "GoogleAPI/vendor/autoload.php";
    $gClient = new Google_Client();
    $gClient -> setClientId("874482795755-0lb98qq1thq0kp8knl1t435cj2e7if9e.apps.googleusercontent.com");
    $gClient -> setClientSecret("vbmtc0aEXVKStqND1e5yjCMz");
    $gClient -> setApplicationName("Login ");
    $gClient -> setRedirectUri("http://localhost/app/Externals/g-callback.php");
    $gClient -> addScope("https://www.googleapis.com/auth/plus.login https://www.googleapis.com/auth/userinfo.email ");
?>