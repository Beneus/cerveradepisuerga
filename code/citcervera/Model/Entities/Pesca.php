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
		$_idPesca,
		$_TipoTramo,
		$_Rio,
		$_Nombre,
		$_TipoPesca,
		$_Espacio,
		$_PeriodoHabil,
		$_DiasHabiles,
		$_CupoCapturas,
		$_TamanoCapturas,
		$_Cebos,
		$_PermisosDia,
		$_LimiteSuperior,
		$_LimiteInferior,
		$_Especies,
		$_Descripcion,
		$_ImgPesca,
		$_Longitud,
		$_Latitud,
		$_LongitudLimiteSuperior,
		$_LatitudLimiteSuperior,
		$_LongitudLimiteInferior,
		$_LatitudLimiteInferior,
		$_NucleoUrbano,
		$_encodedPoints,
		$_encodedLevels,
		$_numLevels,
		$_Zoom,
		$_Color,
		$_fecha
	) {
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
		$this->idPesca = parent::TakePOST('IDPESCA');
		$this->TipoTramo = parent::TakePOST('TIPOTRAMO');
		$this->Rio = parent::TakePOST('RIO',50);
		$this->Nombre = parent::TakePOST('NOMBRE',50);
		$this->TipoPesca = parent::TakePOST('TIPOPESCA');
		$this->Espacio = parent::TakePOST('ESPACIO');
		$this->PeriodoHabil = parent::TakePOST('PERIODOHABIL',50);
		$this->DiasHabiles = parent::TakePOST('DIASHABILES',50);
		$this->CupoCapturas = parent::TakePOST('CUPOCAPTURAS');
		$this->TamanoCapturas = parent::TakePOST('TAMANOCAPTURAS');
		$this->Cebos = parent::TakePOST('CEBOS',100);
		$this->PermisosDia = parent::TakePOST('PERMISOSDIA');
		$this->LimiteSuperior = parent::TakePOST('LIMITESUPERIOR',255);
		$this->LimiteInferior = parent::TakePOST('LIMITEINFERIOR',255);
		$this->Especies = parent::TakePOST('ESPECIES',50);
		$this->Descripcion = htmlentities(parent::TakePOST('DESCRIPCION'), ENT_QUOTES);
		$this->ImgPesca = parent::TakePOST('IMGPESCA', 255);
		$this->Longitud = parent::TakePOST('LONGITUD',50);
		$this->Latitud = parent::TakePOST('LATITUD',50);
		$this->LongitudLimiteSuperior = parent::TakePOST('LONGITUDLIMITESUPERIOR',50);
		$this->LatitudLimiteSuperior = parent::TakePOST('LATITUDLIMITESUPERIOR',50);
		$this->LongitudLimiteInferior = parent::TakePOST('LONGITUDLIMITEINFERIOR',50);
		$this->LatitudLimiteInferior = parent::TakePOST('LATITUDLIMITEINFERIOR',50);
		$this->NucleoUrbano = parent::TakePOST('NUCLEOURBANO',50);
		$this->encodedPoints = parent::TakePOST('ENCODEDPOINTS',500);
		$this->encodedLevels = parent::TakePOST('ENCODEDLEVELS',100);
		$this->numLevels = parent::TakePOST('NUMLEVELS',50);
		$this->Zoom = parent::TakePOST('ZOOM');
		$this->Color = parent::TakePOST('COLOR',50);
		$this->fecha = parent::TakePOST('FECHA');
	}

	function _GET()
	{
		$this->idPesca = parent::TakeGET('IDPESCA');
		$this->TipoTramo = parent::TakeGET('TIPOTRAMO');
		$this->Rio = parent::TakeGET('RIO',50);
		$this->Nombre = parent::TakeGET('NOMBRE',50);
		$this->TipoPesca = parent::TakeGET('TIPOPESCA');
		$this->Espacio = parent::TakeGET('ESPACIO');
		$this->PeriodoHabil = parent::TakeGET('PERIODOHABIL',50);
		$this->DiasHabiles = parent::TakeGET('DIASHABILES',50);
		$this->CupoCapturas = parent::TakeGET('CUPOCAPTURAS');
		$this->TamanoCapturas = parent::TakeGET('TAMANOCAPTURAS');
		$this->Cebos = parent::TakeGET('CEBOS',100);
		$this->PermisosDia = parent::TakeGET('PERMISOSDIA');
		$this->LimiteSuperior = parent::TakeGET('LIMITESUPERIOR',255);
		$this->LimiteInferior = parent::TakeGET('LIMITEINFERIOR',255);
		$this->Especies = parent::TakeGET('ESPECIES',50);
		$this->Descripcion = htmlentities(parent::TakeGET('DESCRIPCION'), ENT_QUOTES);
		$this->ImgPesca = parent::TakeGET('IMGPESCA', 255);
		$this->Longitud = parent::TakeGET('LONGITUD',50);
		$this->Latitud = parent::TakeGET('LATITUD',50);
		$this->LongitudLimiteSuperior = parent::TakeGET('LONGITUDLIMITESUPERIOR',50);
		$this->LatitudLimiteSuperior = parent::TakeGET('LATITUDLIMITESUPERIOR',50);
		$this->LongitudLimiteInferior = parent::TakeGET('LONGITUDLIMITEINFERIOR',50);
		$this->LatitudLimiteInferior = parent::TakeGET('LATITUDLIMITEINFERIOR',50);
		$this->NucleoUrbano = parent::TakeGET('NUCLEOURBANO',50);
		$this->encodedPoints = parent::TakeGET('ENCODEDPOINTS',500);
		$this->encodedLevels = parent::TakeGET('ENCODEDLEVELS',100);
		$this->numLevels = parent::TakeGET('NUMLEVELS',50);
		$this->Zoom = parent::TakeGET('ZOOM');
		$this->Color = parent::TakeGET('COLOR',50);
		$this->fecha = parent::TakeGET('FECHA');
	}
}
