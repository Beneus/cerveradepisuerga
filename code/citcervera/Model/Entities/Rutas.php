<?php

namespace citcervera\Model\Entities;

use citcervera\Model\Interfaces\IEntityBase;

class Rutas extends EntityBase implements IEntityBase
{
	private $_tableName = 'Rutas';
	private $_id = 'IdRuta';
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
}
