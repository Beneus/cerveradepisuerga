<?php
namespace citcervera\Model\Entities;

include_once('Models/Entities/EntityBase.php');

use citcervera\Model\Interfaces\IEntityBase;

class DirectorioSubServicio extends EntityBase implements IEntityBase
{
	private $_tableName = 'DirectorioSubServicio';
	private $_id = 'idDirectorioSubServicio';
	var $idDirectorioSubServicio;
	var $idDirectorio;
	var $idSubServicio;
	var $Fecha;

	function DirectorioSubServicio(
$_idDirectorioSubServicio,$_idDirectorio,$_idSubServicio,$_Fecha){
		$this->idDirectorioSubServicio = $_idDirectorioSubServicio;
		$this->idDirectorio = $_idDirectorio;
		$this->idSubServicio = $_idSubServicio;
		$this->Fecha = $_Fecha;
	}

	function GetTable(){
		return $this->_tableName;
	}

	function GetId(){
		return $this->_id;
	}
}