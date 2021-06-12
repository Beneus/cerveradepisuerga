<?php

namespace citcervera\Model\Entities;

use citcervera\Model\Interfaces\IEntityBase;

class Flora extends EntityBase implements IEntityBase
{
	private $_tableName = 'Flora';
	private $_id = 'idFlora';
	public $idFlora;
	public $NombreComun;
	public $NombreCientifico;
	public $Familia;
	public $Descripcion;
	public $Habitat;
	public $Usos;
	public $ImgDescripcion;
	public $ImgHabitat;
	public $ImgUsos;
	public $Fecha;


	function Flora(
		$_idFlora,
		$_NombreComun,
		$_NombreCientifico,
		$_Familia,
		$_Descripcion,
		$_Habitat,
		$_Usos,
		$_ImgDescripcion,
		$_ImgHabitat,
		$_ImgUsos,
		$_Fecha
	) {
		$this->idFlora = $_idFlora;
		$this->NombreComun = $_NombreComun;
		$this->NombreCientifico = $_NombreCientifico;
		$this->Familia = $_Familia;
		$this->Descripcion = $_Descripcion;
		$this->Habitat = $_Habitat;
		$this->Usos = $_Usos;
		$this->ImgDescripcion = $_ImgDescripcion;
		$this->ImgHabitat = $_ImgHabitat;
		$this->ImgUsos = $_ImgUsos;
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
