<?php
namespace citcervera\Model\Entities;

include_once('Models/Entities/EntityBase.php');

use citcervera\Model\Interfaces\IEntityBase;

class Escudos extends EntityBase implements IEntityBase
{
	var $idEscudo;
	var $Nombre;
	var $Direccion;
	var $idNucleoUrbano;
	var $Descripcion;
	var $ImgDescripcion;
	var $Fecha;

	function Escudos(
$_idEscudo,$_Nombre,$_Direccion,$_idNucleoUrbano,$_Descripcion,$_ImgDescripcion,$_Fecha){
		$this->idEscudo = $_idEscudo;
		$this->Nombre = $_Nombre;
		$this->Direccion = $_Direccion;
		$this->idNucleoUrbano = $_idNucleoUrbano;
		$this->Descripcion = $_Descripcion;
		$this->ImgDescripcion = $_ImgDescripcion;
		$this->Fecha = $_Fecha;
	}
}