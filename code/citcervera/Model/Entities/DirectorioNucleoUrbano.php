<?php
namespace citcervera\Model\Entities;

include_once('Models/Entities/EntityBase.php');

use citcervera\Model\Interfaces\IEntityBase;

class DirectorioNucleoUrbano extends EntityBase implements IEntityBase
{
	var $idDirectorioNucleoUrbano;
	var $idDirectorio;
	var $idNucleoUrbano;
	var $Fecha;

	function DirectorioNucleoUrbano(
$_idDirectorioNucleoUrbano,$_idDirectorio,$_idNucleoUrbano,$_Fecha){
		$this->idDirectorioNucleoUrbano = $_idDirectorioNucleoUrbano;
		$this->idDirectorio = $_idDirectorio;
		$this->idNucleoUrbano = $_idNucleoUrbano;
		$this->Fecha = $_Fecha;
	}
}