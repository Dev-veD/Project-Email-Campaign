<?php 

define('ROOT','/home/divyanshu/REALLY FILNAL/');
define('APP_PATH', ROOT.'app'.DIRECTORY_SEPARATOR);
define('VIEW_PATH', APP_PATH.'views'.DIRECTORY_SEPARATOR);
define('DATA_PATH', APP_PATH.'database'.DIRECTORY_SEPARATOR);
define('MODEL_PATH',APP_PATH.'models'.DIRECTORY_SEPARATOR);
define('CORE_PATH', APP_PATH.'core'.DIRECTORY_SEPARATOR);
define('CONTROLLER_PATH', APP_PATH.'controllers'.DIRECTORY_SEPARATOR);

$modules = [ROOT,CORE_PATH,APP_PATH,CONTROLLER_PATH,DATA_PATH];
set_include_path(get_include_path().PATH_SEPARATOR.implode(PATH_SEPARATOR,$modules));
spl_autoload_register('spl_autoload',false);
?>

