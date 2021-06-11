<?php

namespace citcervera\Model\Entities;

include_once('Models/Entities/EntityBase.php');

use citcervera\Model\Interfaces\IEntityBase;

class Banners extends EntityBase implements IEntityBase
{
	private $_tableName = 'Banners';
	var $idBanner;
	var $TextoBanner;
	var $UrlBanner;
	var $Banner;
	var $Tamano;
	var $Ancho;
	var $Alto;
	var $Orden;
	var $Fecha;

	function Banners(
		$_idBanner,
		$_TextoBanner,
		$_UrlBanner,
		$_Banner,
		$_Tamano,
		$_Ancho,
		$_Alto,
		$_Orden,
		$_Fecha
	) {
		$this->idBanner = $_idBanner;
		$this->TextoBanner = $_TextoBanner;
		$this->UrlBanner = $_UrlBanner;
		$this->Banner = $_Banner;
		$this->Tamano = $_Tamano;
		$this->Ancho = $_Ancho;
		$this->Alto = $_Alto;
		$this->Orden = $_Orden;
		$this->Fecha = $_Fecha;
	}

	function GetTable()
	{
		return $this->_tableName;
	}

	function GetId(){
		return $this->_id;
	}
}