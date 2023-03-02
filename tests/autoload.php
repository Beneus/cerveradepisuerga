<?php
include_once __DIR__.'/../vendor/autoload.php';

$classLoader = new \Composer\Autoload\ClassLoader();
$classLoader->addPsr4("tests\\", __DIR__, true);
$classLoader->register();

define(__NAMESPACE__ ,'citcervera');

function __citcervera_libraries($class_name)
{

	$class_name = str_replace('\\','/', 'code\\' . $class_name);
//echo $class_name;
	if(file_exists($class_name . '.php'))
	{
		require_once($class_name . '.php');
		return;
	}   
}

spl_autoload_register("__citcervera_libraries");
