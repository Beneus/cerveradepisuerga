<?php

namespace citcervera\Model\Entities;

use citcervera\Model\Interfaces\IEntityBase;

class Rutas extends EntityBase implements IEntityBase
{
	private $_tableName = 'Rutas';
	private $_id = 'idRuta';
	public $idRuta;
	public $Ruta;
	public $Inicio;
	public $Llegada;
	public $Distancia;
	public $Tiempo;
	public $Desnivel;
	public $Piso;
	public $Dificultad;
	public $Epoca;
	public $Descripcion;
	public $Flora;
	public $Fauna;
	public $ImgDescripcion;
	public $ImgFlora;
	public $ImgFauna;
	public $URL;
	public $Fecha;

	public function __construct()
	{
		//parent::__construct();
	}
	
	function Rutas(
		$_idRuta,
		$_Ruta,
		$_Inicio,
		$_Llegada,
		$_Distancia,
		$_Tiempo,
		$_Desnivel,
		$_Piso,
		$_Dificultad,
		$_Epoca,
		$_Descripcion,
		$_Flora,
		$_Fauna,
		$_ImgDescripcion,
		$_ImgFlora,
		$_ImgFauna,
		$_URL,
		$_Fecha
	) {
		$this->idRuta = $_idRuta;
		$this->Ruta = $_Ruta;
		$this->Inicio = $_Inicio;
		$this->Llegada = $_Llegada;
		$this->Distancia = $_Distancia;
		$this->Tiempo = $_Tiempo;
		$this->Desnivel = $_Desnivel;
		$this->Piso = $_Piso;
		$this->Dificultad = $_Dificultad;
		$this->Epoca = $_Epoca;
		$this->Descripcion = $_Descripcion;
		$this->Flora = $_Flora;
		$this->Fauna = $_Fauna;
		$this->ImgDescripcion = $_ImgDescripcion;
		$this->ImgFlora = $_ImgFlora;
		$this->ImgFauna = $_ImgFauna;
		$this->URL = $_URL;
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
		$this->idRuta = parent::TakePOST('IDRUTA');
		$this->Ruta = parent::TakePOST('RUTA');
		$this->Inicio = parent::TakePOST('INICIO');
		$this->Llegada = parent::TakePOST('LLEGADA');
		$this->Distancia = parent::TakePOST('DISTANCIA');;
		$this->Tiempo = parent::TakePOST('TIEMPO');
		$this->Desnivel = parent::TakePOST('DESNIVEL');
		$this->Piso = parent::TakePOST('PISO');
		$this->Dificultad = parent::TakePOST('DIFICULTAD');
		$this->Epoca = parent::TakePOST('EPOCA');
		$this->Descripcion = htmlentities(parent::TakePOST('DESCRIPCION'),ENT_QUOTES);
		$this->Flora = parent::TakePOST('FLORA');
		$this->Fauna = parent::TakePOST('FAUNA');
		$this->ImgDescripcion = parent::TakePOST('IMGDESCRIPCION',255);
		$this->ImgFlora = parent::TakePOST('IMGFLORA',255);
		$this->ImgFauna = parent::TakePOST('IMGFAUNA',255);
		$this->Fecha = parent::TakePOST('FECHA');

	}

	function _GET()
	{
		$this->idRuta = parent::TakeGET('IDRUTA');
		$this->Ruta = parent::TakeGET('RUTA');
		$this->Inicio = parent::TakeGET('INICIO');
		$this->Llegada = parent::TakeGET('LLEGADA');
		$this->Distancia = parent::TakeGET('DISTANCIA');;
		$this->Tiempo = parent::TakeGET('TIEMPO');
		$this->Desnivel = parent::TakeGET('DESNIVEL');
		$this->Piso = parent::TakeGET('PISO');
		$this->Dificultad = parent::TakeGET('DIFICULTAD');
		$this->Epoca = parent::TakeGET('EPOCA');
		$this->Descripcion = htmlentities(parent::TakeGET('DESCRIPCION'),ENT_QUOTES);
		$this->Flora = parent::TakeGET('FLORA');
		$this->Fauna = parent::TakeGET('FAUNA');
		$this->ImgDescripcion = parent::TakeGET('IMGDESCRIPCION',255);
		$this->ImgFlora = parent::TakeGET('IMGFLORA',255);
		$this->ImgFauna = parent::TakeGET('IMGFAUNA',255);
		$this->Fecha = parent::TakeGET('FECHA');
	}
}
