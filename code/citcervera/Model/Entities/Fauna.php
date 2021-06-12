<?php

namespace citcervera\Model\Entities;

use citcervera\Model\Interfaces\IEntityBase;

class Fauna extends EntityBase implements IEntityBase
{
	private $_tableName = 'Fauna';
	private $_id = 'idFauna';
	public $idFauna;
	public $NombreComun;
	public $NombreCientifico;
	public $Familia;
	public $Descripcion;
	public $Habitat;
	public $ImgDescripcion;
	public $ImgHabitat;
	public $Fecha;

	function Fauna(
		$_idFauna,
		$_NombreComun,
		$_NombreCientifico,
		$_Familia,
		$_Descripcion,
		$_Habitat,
		$_ImgDescripcion,
		$_ImgHabitat,
		$_Fecha
	) {
		$this->idFauna = $_idFauna;
		$this->NombreComun = $_NombreComun;
		$this->NombreCientifico = $_NombreCientifico;
		$this->Familia = $_Familia;
		$this->Descripcion = $_Descripcion;
		$this->Habitat = $_Habitat;
		$this->ImgDescripcion = $_ImgDescripcion;
		$this->ImgHabitat = $_ImgHabitat;
		$this->Fecha = $_Fecha;
	}

	function GetTable()
	{
		return $this->_tableName;
	}

	function GetId()
	{
		return $this->_id;
	}
}
