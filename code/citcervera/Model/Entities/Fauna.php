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

	function _POST()
	{
		$this->idFauna = parent::TakePOST('IDFAUNA');
		$this->NombreComun = parent::TakePOST('NOMBRECOMUN');
		$this->NombreCientifico = parent::TakePOST('NOMBRECIENTIFICO');
		$this->Familia = parent::TakePOST('FAMILIA');
		$this->Descripcion = htmlentities(parent::TakePOST('DESCRIPCION'),ENT_QUOTES);
		$this->Habitat = htmlentities(parent::TakePOST('HABITAT'),ENT_QUOTES);
		$this->ImgDescripcion = parent::TakePOST('IMGDESCRIPCION',255);
		$this->ImgHabitat = parent::TakePOST('IMGHABITAT',255);
		$this->Fecha = parent::TakePOST('FECHA');
	}

	function _GET()
	{
		$this->idFauna = parent::TakeGET('IDFAUNA');
		$this->NombreComun = parent::TakeGET('NOMBRECOMUN');
		$this->NombreCientifico = parent::TakeGET('NOMBRECIENTIFICO');
		$this->Familia = parent::TakeGET('FAMILIA');
		$this->Descripcion = htmlentities(parent::TakeGET('DESCRIPCION'),ENT_QUOTES);
		$this->Habitat = htmlentities(parent::TakeGET('HABITAT'),ENT_QUOTES);
		$this->ImgDescripcion = parent::TakeGET('IMGDESCRIPCION',255);
		$this->ImgHabitat = parent::TakeGET('IMGHABITAT',255);
		$this->Fecha = parent::TakeGET('FECHA');
	}
}
