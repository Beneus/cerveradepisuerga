<?php

namespace citcervera\Model\Entities;

include_once('Models/Entities/EntityBase.php');

use citcervera\Model\Interfaces\IEntityBase;

class BannersVistos extends EntityBase implements IEntityBase
{
	private $_tableName = 'BannersVistos';
	var $idBannersVistos;
	var $idBanner;
	var $idBannersGestion;
	var $Banner;
	var $TextoBanner;
	var $UrlBanner;
	var $Pagina;
	var $IP;
	var $Referer;
	var $Fecha;

	function BannersVistos(
		$_idBannersVistos,
		$_idBanner,
		$_idBannersGestion,
		$_Banner,
		$_TextoBanner,
		$_UrlBanner,
		$_Pagina,
		$_IP,
		$_Referer,
		$_Fecha
	) {
		$this->idBannersVistos = $_idBannersVistos;
		$this->idBanner = $_idBanner;
		$this->idBannersGestion = $_idBannersGestion;
		$this->Banner = $_Banner;
		$this->TextoBanner = $_TextoBanner;
		$this->UrlBanner = $_UrlBanner;
		$this->Pagina = $_Pagina;
		$this->IP = $_IP;
		$this->Referer = $_Referer;
		$this->Fecha = $_Fecha;
	}

	function GetTable()
	{
		return $this->_tableName;
	}
}
