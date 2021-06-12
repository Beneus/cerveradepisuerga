<?php
error_reporting(E_ALL);
ini_set("display_errors","On");

define(__NAMESPACE__ ,'citcervera');
function __autoload($class_name)
{
    //echo $class_name . PHP_EOL;
	$class_name = str_replace('\\','/', $class_name);
    $class_name = str_replace('citcervera','../../..', $class_name);
	if(file_exists($class_name . '.php'))
	{
		require_once($class_name . '.php');
		return;
	}   
}
spl_autoload_register(__NAMESPACE__."\__autoload");

?>