<?php
error_reporting(E_ALL);
ini_set("display_errors", "On");

define(__NAMESPACE__, 'citcervera');
function my_autoloader($class_name)
{
    //echo $class_name . PHP_EOL;
    $class_name = str_replace('\\', '/', $class_name);
    $class_name = str_replace('citcervera', '../../..', $class_name);
    if (file_exists($class_name . '.php')) {
        require_once($class_name . '.php');
        return;
    }
}
spl_autoload_register('my_autoloader');


function getEntityfromPath()
{
    $path = explode("/", getcwd());
    end($path);
    $entityName = ucfirst(prev($path));

    return 'citcervera\\Model\\Entities\\' . $entityName;
}

function getController()
{
    return 'citcervera\\Controller\\Controller';
}


function isEmail($email)
{
    return preg_match('|^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]{2,})+$|i', $email);
}

function isValidaFechaCorta($Fecha)
{
	//  dd/mm/aaaa
	$date = explode("/", $Fecha);
    if(count($date) !== 3){
        return false;
    }

	$dia = trim($date[0]);
	$mes = trim($date[1]);
	$anyo = trim($date[2]);

    if($dia === '' || $mes === '' || $anyo === ''){
        return false;
    }

    if(is_int(intval($dia)) and is_int(intval($mes))and is_int(intval($anyo))){
        echo is_int(intval($anyo));
        if (checkdate($mes,$dia,$anyo)){
            return true;
        }else{
            return false;
        }
    }else{
        return false;
    }	
	
}

function isValidaHoraCorta($Hora)
{
		//  dd/mm/aaaa
	$tiempo = explode(":", $Hora);
    if(count($tiempo) !== 2){
        return false;
    }

	$hora = $tiempo[0];
	$minuto = $tiempo[1];

    if($hora === '' || $minuto === ''){
        return false;
    }
    
    $hora = intval($hora);
    if (($hora < 0) || ($hora > 23)){
        return false;
    }

    $minuto = intval($minuto);
    if(is_numeric($minuto)){
        if($minuto < 0 || $minuto > 59){
            return false;
        }
    }else{
        return false;
    }
	return true;
}

function validate($entity, $data)
{
    $validation['status'] =  'OK';
    $validation['code'] =  200;
    $ErrorMsn = [];
    foreach ($entity->ValidateRules() as $fieldKey => $fieldValue) {
        foreach ($fieldValue as $ruleKey => $ruelValue) {
            switch ($ruleKey) {
                case 'required':
                    if ($ruelValue) {
                        if (!($data->{$fieldKey})) {
                            array_push($ErrorMsn, [$fieldKey => $fieldKey . ' es obligatorio']);
                        }
                    }
                    break;
                case 'min-length':
                    if (strlen($data->{$fieldKey}) < $ruelValue) {
                        array_push($ErrorMsn, [$fieldKey => $fieldKey . ' debe de tener al menos ' . $ruelValue . ' caracteres']);
                    }
                    break;
                case 'format':
                    if ('email' === $ruelValue) {
                        if (!isEmail($data->{$fieldKey}))
                            array_push($ErrorMsn, [$fieldKey => $fieldKey . ' no valido']);
                    }
                    if ('fechaCorta' === $ruelValue) {
                        if (!isValidaFechaCorta($data->{$fieldKey}))
                            array_push($ErrorMsn, [$fieldKey => $fieldKey . ' no valido']);
                    }
                    if ('horaCorta' === $ruelValue) {
                        if (!isValidaHoraCorta($data->{$fieldKey}))
                            array_push($ErrorMsn, [$fieldKey => $fieldKey . ' no valido']);
                    }
                    break;
            }
        }
    }
    if (count($ErrorMsn) > 0) {
        $validation['status'] =  'No created';
    }
    $validation['errors'] = $ErrorMsn;
    return $validation;
}
