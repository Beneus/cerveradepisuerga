<?php
namespace citcervera\Model\Entities;

include_once('Models/Entities/EntityBase.php');

use citcervera\Model\Interfaces\IEntityBase;

class ServiciosTuristicos extends EntityBase implements IEntityBase
{
	var $idServicioTuristico;
	var $Nombre;
	var $Imagen;
	var $Orden;
	var $Fecha;

	function ServiciosTuristicos(
$_idServicioTuristico,$_Nombre,$_Imagen,$_Orden,$_Fecha){
		$this->idServicioTuristico = $_idServicioTuristico;
		$this->Nombre = $_Nombre;
		$this->Imagen = $_Imagen;
		$this->Orden = $_Orden;
		$this->Fecha = $_Fecha;
	}
}