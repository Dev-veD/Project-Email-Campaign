<?php 
define('ROOT',__DIR__.DIRECTORY_SEPARATOR);
define('APP', ROOT.'app'.DIRECTORY_SEPARATOR);
define('VIEW', APP.'views'.DIRECTORY_SEPARATOR);
define('DATA', APP.'database'.DIRECTORY_SEPARATOR);
define('MODEL',APP.'models'.DIRECTORY_SEPARATOR);
define('CORE', APP.'core'.DIRECTORY_SEPARATOR);
define('CONTROLLER', APP.'controllers'.DIRECTORY_SEPARATOR);
define('TEMPLATES',VIEW.'Templates'.DIRECTORY_SEPARATOR);

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
    else 
        die("<strong>No class found by name</strong> <pre>{$classname}</pre>.<br>");

});
new Application;

