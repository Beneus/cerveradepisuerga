<?php
namespace Citcervera;

ini_set('display_errors', 1);
error_reporting(E_ALL);

include_once('Models/Managers/Manager.php');
include_once('Models/Entities/Agenda.php');
include_once('Models/Entities/Santoral.php');
use citcervera\Model\Managers\Manager;
use citcervera\Model\Entities\Agenda;
use citcervera\Model\Entities\Santoral;

$agendaEntity = new Agenda();
$agendaManager = new Manager($agendaEntity);
$santoralEntity = new Santoral();
$santoralManager = new Manager($santoralEntity);
//$ret = $Manager->Get(1182);
//var_dump($ret);

//$ret = $Manager->GetAll();
//var_dump($ret);
//$ret->idAgenda = 1;
//$ret->Email = 'benjamín@benjamine.es';

//echo $Manager->Save($ret);

//echo $Manager->Delete(1190);
//echo $Manager->Delete(12);

//$search = $agendaManager->Search(array('Email'=>'benjamín@benjamin.es','Lugar'=>'Restaurante Peñalabra'), array('%s','%s'));

//$search = $agendaManager->Search(array('Year(FechaEvento)'=>'2013'), array('%s'));


$search = $santoralManager->Search(array('Mes'=>'enero', 'Dia' => '18'),array('%s','%s'));
echo $search[0]->Santos;

echo json_encode($search);
//var_dump($search);