<?php

namespace citcervera\Model\Entities;

use citcervera\Model\Interfaces\IEntityBase;

class Setas extends EntityBase implements IEntityBase
{
	private $_tableName = 'Setas';
	private $_id = 'IdSetas';
	public $idSetas;
	public $NombreComun;
	public $NombreCientifico;
	public $Autor;
	public $Clasificacion;
	public $Clase;
	public $idSetasSubOrden;
	public $Sombrero;
	public $Pie;
	public $Cuerpo;
	public $Laminas;
	public $Himenio;
	public $Exporada;
	public $Carne;
	public $EpocaHabitat;
	public $Comestibilidad;
	public $Comentarios;
	public $ImgSetas;
	public $Fecha;

	function Setas(
		$_idSetas,
		$_NombreComun,
		$_NombreCientifico,
		$_Autor,
		$_Clasificacion,
		$_Clase,
		$_idSetasSubOrden,
		$_Sombrero,
		$_Pie,
		$_Cuerpo,
		$_Laminas,
		$_Himenio,
		$_Exporada,
		$_Carne,
		$_EpocaHabitat,
		$_Comestibilidad,
		$_Comentarios,
		$_ImgSetas,
		$_Fecha
	) {
		$this->idSetas = $_idSetas;
		$this->NombreComun = $_NombreComun;
		$this->NombreCientifico = $_NombreCientifico;
		$this->Autor = $_Autor;
		$this->Clasificacion = $_Clasificacion;
		$this->Clase = $_Clase;
		$this->idSetasSubOrden = $_idSetasSubOrden;
		$this->Sombrero = $_Sombrero;
		$this->Pie = $_Pie;
		$this->Cuerpo = $_Cuerpo;
		$this->Laminas = $_Laminas;
		$this->Himenio = $_Himenio;
		$this->Exporada = $_Exporada;
		$this->Carne = $_Carne;
		$this->EpocaHabitat = $_EpocaHabitat;
		$this->Comestibilidad = $_Comestibilidad;
		$this->Comentarios = $_Comentarios;
		$this->ImgSetas = $_ImgSetas;
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
