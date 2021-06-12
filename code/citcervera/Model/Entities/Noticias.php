<?php
namespace citcervera\Model\Entities;

use citcervera\Model\Interfaces\IEntityBase;

class Noticias extends EntityBase implements IEntityBase
{
	private $_tableName = 'Noticias';
	private $_id = 'idNoticia';
	public $idNoticia;
	public $Titulo;
	public $Entradilla;
	public $Cuerpo;
	public $Fuente;
	public $ImgNoticia;
	public $DocNoticia;
	public $FechaNoticia;
	public $Fecha;

	function Noticias(
		$_idNoticia,
		$_Titulo,
		$_Entradilla,
		$_Cuerpo,
		$_Fuente,
		$_ImgNoticia,
		$_DocNoticia,
		$_FechaNoticia,
		$_Fecha
	) {
		$this->idNoticia = $_idNoticia;
		$this->Titulo = $_Titulo;
		$this->Entradilla = $_Entradilla;
		$this->Cuerpo = $_Cuerpo;
		$this->Fuente = $_Fuente;
		$this->ImgNoticia = $_ImgNoticia;
		$this->DocNoticia = $_DocNoticia;
		$this->FechaNoticia = $_FechaNoticia;
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
		$this->idNoticia 		= parent::TakePOST('IDNOTICIA');
		$this->Titulo 			= parent::TakePOST('TITULO', 255);
		$this->Entradilla 		= parent::TakePOST('ENTRADILLA', 255);
		$this->Cuerpo 			= parent::TakePOST('CUERPO');
		$this->Fuente 			= parent::TakePOST('FUENTE', 16);
		$this->ImgNoticia 		= parent::TakePOST('IMGNOTICIA', 100);
		$this->DocNoticia 		= parent::TakePOST('DOCNOTICIA', 255);
		$this->FechaNoticia 	= parent::TakePOST('FECHANOTICIA');
		$this->Fecha 			= parent::TakePOST('FECHA');
		
	}

	function _GET()
	{
		$this->idNoticia 		= parent::TakeGET('IDNOTICIA');
		$this->Titulo 			= parent::TakeGET('TITULO', 255);
		$this->Entradilla 		= parent::TakeGET('ENTRADILLA', 255);
		$this->Cuerpo 			= parent::TakeGET('CUERPO');
		$this->Fuente 			= parent::TakeGET('FUENTE', 16);
		$this->ImgNoticia 		= parent::TakeGET('IMGNOTICIA', 100);
		$this->DocNoticia 		= parent::TakeGET('DOCNOTICIA', 255);
		$this->FechaNoticia 	= parent::TakeGET('FECHANOTICIA');
		$this->Fecha 			= parent::TakeGET('FECHA');
	}
}
