<?php
namespace citcervera\Model\Entities;

use citcervera\Model\Interfaces\IEntityBase;

class Pesca extends EntityBase implements IEntityBase
{
	private $_tableName = 'Pesca';
	private $_id = 'idPesca';
	var $idPesca;
	var $TipoTramo;
	var $Rio;
	var $Nombre;
	var $TipoPesca;
	var $Espacio;
	var $PeriodoHabil;
	var $DiasHabiles;
	var $CupoCapturas;
	var $TamanoCapturas;
	var $Cebos;
	var $PermisosDia;
	var $LimiteSuperior;
	var $LimiteInferior;
	var $Especies;
	var $Descripcion;
	var $ImgPesca;
	var $Longitud;
	var $Latitud;
	var $LongitudLimiteSuperior;
	var $LatitudLimiteSuperior;
	var $LongitudLimiteInferior;
	var $LatitudLimiteInferior;
	var $NucleoUrbano;
	var $encodedPoints;
	var $encodedLevels;
	var $numLevels;
	var $Zoom;
	var $Color;
	var $fecha;

	function Pesca(
$_idPesca,$_TipoTramo,$_Rio,$_Nombre,$_TipoPesca,$_Espacio,$_PeriodoHabil,$_DiasHabiles,$_CupoCapturas,$_TamanoCapturas,$_Cebos,$_PermisosDia,$_LimiteSuperior,$_LimiteInferior,$_Especies,$_Descripcion,$_ImgPesca,$_Longitud,$_Latitud,$_LongitudLimiteSuperior,$_LatitudLimiteSuperior,$_LongitudLimiteInferior,$_LatitudLimiteInferior,$_NucleoUrbano,$_encodedPoints,$_encodedLevels,$_numLevels,$_Zoom,$_Color,$_fecha){
		$this->idPesca = $_idPesca;
		$this->TipoTramo = $_TipoTramo;
		$this->Rio = $_Rio;
		$this->Nombre = $_Nombre;
		$this->TipoPesca = $_TipoPesca;
		$this->Espacio = $_Espacio;
		$this->PeriodoHabil = $_PeriodoHabil;
		$this->DiasHabiles = $_DiasHabiles;
		$this->CupoCapturas = $_CupoCapturas;
		$this->TamanoCapturas = $_TamanoCapturas;
		$this->Cebos = $_Cebos;
		$this->PermisosDia = $_PermisosDia;
		$this->LimiteSuperior = $_LimiteSuperior;
		$this->LimiteInferior = $_LimiteInferior;
		$this->Especies = $_Especies;
		$this->Descripcion = $_Descripcion;
		$this->ImgPesca = $_ImgPesca;
		$this->Longitud = $_Longitud;
		$this->Latitud = $_Latitud;
		$this->LongitudLimiteSuperior = $_LongitudLimiteSuperior;
		$this->LatitudLimiteSuperior = $_LatitudLimiteSuperior;
		$this->LongitudLimiteInferior = $_LongitudLimiteInferior;
		$this->LatitudLimiteInferior = $_LatitudLimiteInferior;
		$this->NucleoUrbano = $_NucleoUrbano;
		$this->encodedPoints = $_encodedPoints;
		$this->encodedLevels = $_encodedLevels;
		$this->numLevels = $_numLevels;
		$this->Zoom = $_Zoom;
		$this->Color = $_Color;
		$this->fecha = $_fecha;
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