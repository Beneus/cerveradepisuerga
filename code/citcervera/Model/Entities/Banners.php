<?php
namespace citcervera\Model\Entities;

use citcervera\Model\Interfaces\IEntityBase;

class Banners extends EntityBase implements IEntityBase
{
	private $_tableName = 'Banners';
	public $idBanner;
	public $TextoBanner;
	public $UrlBanner;
	public $Banner;
	public $Tamano;
	public $Ancho;
	public $Alto;
	public $Orden;
	public $Fecha;

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

	function GetId()
	{
		return $this->_id;
	}
}
