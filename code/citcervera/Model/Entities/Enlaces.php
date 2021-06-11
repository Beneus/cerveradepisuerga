<?php
namespace citcervera\Model\Entities;

include_once('Models/Entities/EntityBase.php');

use citcervera\Model\Interfaces\IEntityBase;

class Enlaces extends EntityBase implements IEntityBase
{
	var $idEnlace;
	var $TextoEnlace;
	var $Descripcion;
	var $UrlEnlace;
	var $Orden;
	var $Fecha;

	function Enlaces(
$_idEnlace,$_TextoEnlace,$_Descripcion,$_UrlEnlace,$_Orden,$_Fecha){
		$this->idEnlace = $_idEnlace;
		$this->TextoEnlace = $_TextoEnlace;
		$this->Descripcion = $_Descripcion;
		$this->UrlEnlace = $_UrlEnlace;
		$this->Orden = $_Orden;
		$this->Fecha = $_Fecha;
	}

	function GetTable(){
		//return $this->_tableName;
	}
}