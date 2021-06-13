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


function isEmail($email)
{
    return preg_match('|^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]{2,})+$|i', $email);
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
                        if(!($data->{$fieldKey})){
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
                    break;
            }
        }
    }
    if(count($ErrorMsn) > 0){
        $validation['status'] =  'No created';
    }
    $validation['errors'] = $ErrorMsn;
    return $validation;
}
