<?php
namespace Citcervera\Models\Entities;

include_once('Models/Entities/EntityBase.php');

use Citcervera\Models\Interfaces\IEntityBase;

class NucleosUrbanos extends EntityBase implements IEntityBase
{
	private $_tableName = 'NucleosUrbanos';
	var $idNucleoUrbano;
	var $NucleosUrbanos;
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

	/*
	public function __construct(
		Array $properties=array()
		)
	{
		foreach($properties as $key => $value)
		{
		  	$this->{$key} = $value;
		}
	}
*/

	public function Init(Array $properties=array()){
		foreach($properties as $key => $value)
		{
		  	$this->{$key} = $value;
		}
	}
	
	function GetTable(){
		return $this->_tableName;
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
}

