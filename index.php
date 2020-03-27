<?php 
define('ROOT',__DIR__.DIRECTORY_SEPARATOR);
define('APP', ROOT.'app'.DIRECTORY_SEPARATOR);
define('VIEW', APP.'views'.DIRECTORY_SEPARATOR);
define('DATA', APP.'database'.DIRECTORY_SEPARATOR);
define('MODEL',APP.'models'.DIRECTORY_SEPARATOR);
define('CORE', APP.'core'.DIRECTORY_SEPARATOR);
define('CONTROLLER', APP.'controllers'.DIRECTORY_SEPARATOR);
define('TEMPLATES',VIEW.'Templates'.DIRECTORY_SEPARATOR);
define('EXTERNALS',APP."Externals".DIRECTORY_SEPARATOR);
define('GOOGLE',EXTERNALS.'GoogleLogin'.DIRECTORY_SEPARATOR);
define('PHPMAIL',EXTERNALS.'Mail'.DIRECTORY_SEPARATOR);
define('ORGANISATION','divyanshuujoshi@gmail.com');
define('MYIP','3.90.91.213');


spl_autoload_register(function ($classname){
    if (file_exists(CORE.$classname.'.php'))
        include (CORE.$classname.'.php') ;
    elseif (file_exists(CONTROLLER.$classname.'.php'))
        include (CONTROLLER.$classname.'.php');
    elseif (file_exists(CONTROLLER.$classname.'.php'))
        include (VIEW.$classname.'.php');
    elseif (file_exists(MODEL.$classname.'.php'))
        include (MODEL.$classname.'.php');
    elseif (file_exists(DATA.$classname.'.php'))
        {include (DATA.$classname.'.php');}
    elseif (file_exists(EXTERNALS.$classname.'.php'))
        {include (EXTERNALS.$classname.'.php');}
    elseif (file_exists(GOOGLE.$classname.'.php'))
        {include (GOOGLE.$classname.'.php');}
    elseif (file_exists(PHPMAIL.$classname.'.php'))
        {include (PHPMAIL.$classname.'.php');}
    else 
        die("<strong>No class found by name</strong> <pre>{$classname}</pre>.<br>");

});
$ip ="";
if(!empty($_SERVER['HTTP_CLIENT_IP'])){
    $ip = $_SERVER['HTTP_CLIENT_IP'];

}
else if(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];

}else{
    $ip = $_SERVER['REMOTE_ADDR'];
}
echo $ip;
$ins = new User();
$ins->storeIP($ip);
echo "here";

new Application;
