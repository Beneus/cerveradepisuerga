<?php
define(__NAMESPACE__ ,'citcervera');

function __citcervera_libraries($class_name)
{
	$class_name = str_replace('\\','/', 'code\\' . $class_name);
	if(file_exists($class_name . '.php'))
	{
		require_once($class_name . '.php');
		return;
	}   
}
spl_autoload_register("__citcervera_libraries");


session_start();
ini_set('display_errors', 1);
error_reporting(E_ALL);

// conexión a base de datos
function Conectarse($servidor,$basedatos,$usuario,$password)
{

	try{
		if (!($link = mysqli_connect($servidor,$usuario,$password)))
		{
			
			echo "Error conectando a la base de datos";
			exit();
		}
		if (!mysqli_select_db($link,$basedatos))
			{
				
				echo "Error seleccionando la base de datos";
				exit();
			}
		$link -> set_charset("utf8");
		return $link;
	}catch(Exception $e){
		echo $e;
		die($e);
	}
	
}

function ConnBDCervera()
{
	return Conectarse("db","citcerveradb","root","12345");
}

function segundo_domingo_marzo($anyo)
{
	
	for($i = 8; $i < 15; $i++){
		if (date("w",mktime(0,0,0,3,$i,$anyo)) == 0){
			return mktime(1,59,59,3,$i,$anyo); // si mayor suma 8
			break;
		}
	}	
}

function ultimo_domingo_marzo($anyo)
{
	
	for($i = 25; $i < 32; $i++){
		if (date("w",mktime(0,0,0,3,$i,$anyo)) == 0){
			return mktime(17,59,59,3,$i,$anyo);// si mayor suma 9
			break;
		}
	}	
}

function ultimo_domingo_octubre($anyo)
{
	
	for($i = 25; $i < 32; $i++){
		if (date("w",mktime(0,0,0,10,$i,$anyo)) == 0){
			return mktime(16,59,59,10,$i-1,$anyo);// si mayor suma 10
			break;
		}
	}	
}

function ultimo_domingo_octubre_SAN_JOSE($anyo)
{
	for($i = 25; $i < 32; $i++){
		if (date("w",mktime(0,0,0,10,$i,$anyo)) == 0){
			return mktime(1,59,59,10,$i,$anyo);// si mayor suma 10
			break;
		}
	}	
}

function primer_domingo_noviembre($anyo)
{
	for($i = 1; $i < 8; $i++){
		if (date("w",mktime(0,0,0,11,$i,$anyo)) == 0){
			return mktime(1,59,59,11,$i,$anyo);// si mayor suma 9
			break;
		}
	}	
}

function diferencia_horaria()
{
	$ahora = strtotime("now");
	if(($ahora > segundo_domingo_marzo(date("Y"))) && ($ahora <= ultimo_domingo_marzo(date("Y")))){
		return 8;
	}elseif(($ahora > ultimo_domingo_octubre(date("Y"))) && ($ahora <= ultimo_domingo_octubre_SAN_JOSE(date("Y")))){
		return 10;
	}else{
		return 9;
	}
}


?>
