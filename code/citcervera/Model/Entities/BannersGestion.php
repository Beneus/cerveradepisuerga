<?php

namespace citcervera\Model\Entities;

use citcervera\Model\Interfaces\IEntityBase;

class BannersGestion extends EntityBase implements IEntityBase
{
	private $_tableName = 'BannersGestion';
	private $_id = 'idBannersGestion';
	public $idBannersGestion;
	public $idBanner;
	public $TextoBanner;
	public $UrlBanner;
	public $FechaInicio;
	public $FechaFin;
	public $Pagina;
	public $Publicar;
	public $Orden;
	public $Fecha;

	function BannersGestion(
		$_idBannersGestion,
		$_idBanner,
		$_TextoBanner,
		$_UrlBanner,
		$_FechaInicio,
		$_FechaFin,
		$_Pagina,
		$_Publicar,
		$_Orden,
		$_Fecha
	) {
		$this->idBannersGestion = $_idBannersGestion;
		$this->idBanner = $_idBanner;
		$this->TextoBanner = $_TextoBanner;
		$this->UrlBanner = $_UrlBanner;
		$this->FechaInicio = $_FechaInicio;
		$this->FechaFin = $_FechaFin;
		$this->Pagina = $_Pagina;
		$this->Publicar = $_Publicar;
		$this->Orden = $_Orden;
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
