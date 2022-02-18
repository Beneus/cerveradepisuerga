<?php
namespace citcervera\Model\Entities;

use citcervera\Model\Interfaces\IEntityBase;

class NucleosUrbanos extends EntityBase implements IEntityBase
{
	private $_tableName = 'NucleosUrbanos';
	private $_id = 'idNucleoUrbano';
	var $idNucleoUrbano;
	var $idArea;
	var $NombreNucleoUrbano;
	var $CodigoPostal;
	var $Altitud;
	var $Latitud;
	var $Longitud;
	var $GoogleMaps;
	var $Descripcion;
	var $Historia;
	var $ImgDescripcion;
	var $ImgHistoria;
	var $Fecha;

	public function Init(Array $properties=array()){
		foreach($properties as $key => $value)
		{
		  	$this->{$key} = $value;
		}
	}
	
	function GetTable(){
		return $this->_tableName;
	}

	function GetId(){
		return $this->_id;
	}

	function NucleosUrbanos(
		$_idNucleoUrbano,
		$_NucleosUrbanos,
		$_idArea,
		$_NombreNucleoUrbano,
		$_CodigoPostal,
		$_Altitud,
		$_Latitud,
		$_Longitud,
		$_GoogleMaps,
		$_Descripcion,
		$_Historia,
		$_ImgDescripcion,
		$_ImgHistoria,
		$_Fecha
		)
	{
		$this->idNucleoUrbano = $_idNucleoUrbano;
		$this->NucleosUrbanos = $_NucleosUrbanos;
		$this->idArea = $_idArea;
		$this->NombreNucleoUrbano = $_NombreNucleoUrbano;
		$this->CodigoPostal = $_CodigoPostal;
		$this->Altitud = $_Altitud;
		$this->Latitud = $_Latitud;
		$this->Longitud = $_Longitud;
		$this->GoogleMaps = $_GoogleMaps;
		$this->Descripcion = $_Descripcion;
		$this->Historia = $_Historia;
		$this->ImgDescripcion = $_ImgDescripcion;
		$this->ImgHistoria = $_ImgHistoria;
		$this->Fecha = $_Fecha;
	}


	function _POST()
	{
		$this->idNucleoUrbano = parent::TakePOST('IDNUCLEOURBANO');
		$this->idArea = parent::TakePOST('IDAREA');
		$this->NombreNucleoUrbano = parent::TakePOST('NOMBRENUCLEOURBANO', 255);
		$this->CodigoPostal = parent::TakePOST('HISTORIA', 255);
		$this->Altitud = parent::TakePOST('HISTORIA', 255);
		$this->Latitud = parent::TakePOST('HISTORIA', 255);
		$this->Longitud = parent::TakePOST('HISTORIA', 255);
		$this->GoogleMaps = parent::TakePOST('HISTORIA', 255);
		$this->Descripcion 		= htmlentities(parent::TakePOST('DESCRIPCION'), ENT_QUOTES);
		$this->Historia = parent::TakePOST('HISTORIA', 255);
		$this->ImgDescripcion 	= parent::TakePOST('IMGDESCRIPCION', 255);
		$this->ImgHistoria = parent::TakePOST('IMGHISTORIA', 255);
		$this->Fecha 			= parent::TakePOST('FECHA');

	}

	function _GET()
	{

		$this->idNucleoUrbano = parent::TakeGET('IDNUCLEOURBANO');
		$this->idArea = parent::TakeGET('IDAREA');
		$this->NombreNucleoUrbano = parent::TakeGET('NOMBRENUCLEOURBANO', 255);
		$this->CodigoPostal = parent::TakeGET('HISTORIA', 255);
		$this->Altitud = parent::TakeGET('HISTORIA', 255);
		$this->Latitud = parent::TakeGET('HISTORIA', 255);
		$this->Longitud = parent::TakeGET('HISTORIA', 255);
		$this->GoogleMaps = parent::TakeGET('HISTORIA', 255);
		$this->Descripcion 		= htmlentities(parent::TakeGET('DESCRIPCION'), ENT_QUOTES);
		$this->Historia = parent::TakeGET('HISTORIA', 255);
		$this->ImgDescripcion 	= parent::TakeGET('IMGDESCRIPCION', 255);
		$this->ImgHistoria = parent::TakeGET('IMGHISTORIA', 255);
		$this->Fecha 			= parent::TakeGET('FECHA');

	}
}

