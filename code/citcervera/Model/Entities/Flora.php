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

	function _POST()
	{
		$this->idFlora = parent::TakePOST('IDFLORA');
		$this->NombreComun = parent::TakePOST('NOMBRECOMUN');
		$this->NombreCientifico = parent::TakePOST('NOMBRECIENTIFICO');
		$this->Familia = parent::TakePOST('FAMILIA');
		$this->Descripcion = htmlentities(parent::TakePOST('DESCRIPCION'),ENT_QUOTES);
		$this->Habitat = htmlentities(parent::TakePOST('HABITAT'),ENT_QUOTES);
		$this->Usos = htmlentities(parent::TakePOST('USOS'),ENT_QUOTES);
		$this->ImgDescripcion = parent::TakePOST('IMGDESCRIPCION',255);
		$this->ImgHabitat = parent::TakePOST('IMGHABITAT',255);
		$this->ImgUsos = parent::TakePOST('IMGUSOS',255);
		$this->Fecha = parent::TakePOST('FECHA');
	}

	function _GET()
	{
		$this->idFlora = parent::TakeGET('IDFLORA');
		$this->NombreComun = parent::TakeGET('NOMBRECOMUN');
		$this->NombreCientifico = parent::TakeGET('NOMBRECIENTIFICO');
		$this->Familia = parent::TakeGET('FAMILIA');
		$this->Descripcion = htmlentities(parent::TakeGET('DESCRIPCION'),ENT_QUOTES);
		$this->Habitat = htmlentities(parent::TakeGET('HABITAT'),ENT_QUOTES);
		$this->Usos = htmlentities(parent::TakeGET('USOS'),ENT_QUOTES);
		$this->ImgDescripcion = parent::TakeGET('IMGDESCRIPCION',255);
		$this->ImgHabitat = parent::TakeGET('IMGHABITAT',255);
		$this->ImgUsos = parent::TakeGET('IMGUSOS',255);
		$this->Fecha = parent::TakeGET('FECHA');
	}
}
