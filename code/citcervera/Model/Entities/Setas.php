<?php

namespace citcervera\Model\Entities;

use citcervera\Model\Interfaces\IEntityBase;

class Setas extends EntityBase implements IEntityBase
{
	private $_tableName = 'Setas';
	private $_id = 'idSetas';
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

	function _POST()
	{
		$this->idSetas = parent::TakePOST('IDSETAS');
		$this->NombreComun = parent::TakePOST('NOMBRECOMUN',100);
		$this->NombreCientifico = parent::TakePOST('NOMBRECIENTIFICO',100);
		$this->Autor = parent::TakePOST('AUTOR',100);
		$this->Clasificacion = parent::TakePOST('CLASIFICACION');
		$this->Clase = parent::TakePOST('CLASE');
		$this->idSetasSubOrden = parent::TakePOST('IDSETASSUBORDEN');
		$this->Sombrero = htmlentities(parent::TakePOST('SOMBRERO'),ENT_QUOTES);
		$this->Pie = htmlentities(parent::TakePOST('PIE'),ENT_QUOTES);
		$this->Cuerpo = htmlentities(parent::TakePOST('CUERPO'),ENT_QUOTES);
		$this->Laminas = htmlentities(parent::TakePOST('LAMINAS'),ENT_QUOTES);
		$this->Himenio = htmlentities(parent::TakePOST('HIMENIO'),ENT_QUOTES);
		$this->Exporada = htmlentities(parent::TakePOST('EXPORADA'),ENT_QUOTES);
		$this->Carne = htmlentities(parent::TakePOST('CARNE'),ENT_QUOTES);
		$this->EpocaHabitat = htmlentities(parent::TakePOST('EPOCAHABITAT'),ENT_QUOTES);
		$this->Comestibilidad = htmlentities(parent::TakePOST('COMESTIBILIDAD'),ENT_QUOTES);
		$this->Comentarios = htmlentities(parent::TakePOST('COMENTARIOS'),ENT_QUOTES);
		$this->ImgSetas = parent::TakePOST('IMGSETAS');
		$this->Fecha = parent::TakePOST('FECHA');
	}

	function _GET()
	{
		$this->idSetas = parent::TakeGET('IDSETAS');
		$this->NombreComun = parent::TakeGET('NOMBRECOMUN',100);
		$this->NombreCientifico = parent::TakeGET('NOMBRECIENTIFICO',100);
		$this->Autor = parent::TakeGET('AUTOR',100);
		$this->Clasificacion = parent::TakeGET('CLASIFICACION');
		$this->Clase = parent::TakeGET('CLASE');
		$this->idSetasSubOrden = parent::TakeGET('IDSETASSUBORDEN');
		$this->Sombrero = parent::TakeGET('SOMBRERO');
		$this->Pie = parent::TakeGET('PIE');
		$this->Cuerpo = parent::TakeGET('CUERPO');
		$this->Laminas = parent::TakeGET('LAMINAS');
		$this->Himenio = parent::TakeGET('HIMENIO');
		$this->Exporada = parent::TakeGET('EXPORADA');
		$this->Carne = parent::TakeGET('CARNE');
		$this->EpocaHabitat = parent::TakeGET('EPOCAHABITAT');
		$this->Comestibilidad = parent::TakeGET('COMESTIBILIDAD');
		$this->Comentarios = htmlentities(parent::TakeGET('COMENTARIOS'),ENT_QUOTES);
		$this->ImgSetas = parent::TakeGET('IMGSETAS');
		$this->Fecha = parent::TakeGET('FECHA');
	}
}
