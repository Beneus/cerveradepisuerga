<?php

namespace citcervera\Model\Entities;

use citcervera\Model\Interfaces\IEntityBase;

class Documentos extends EntityBase implements IEntityBase
{
	private $_tableName = 'Documentos';
	private $_id = 'idDoc';
	var $idDoc;
	var $Ambito;
	var $idAmbito;
	var $Archivo;
	var $Path;
	var $Tipo;
	var $Tamano;
	var $Titulo;
	var $Pie;
	var $Publicar;
	var $Orden;
	var $Fecha;

	function GetTable()
	{
		return $this->_tableName;
	}

	function GetId()
	{
		return $this->_id;
	}

	function Documentos(
		$_idDoc,
		$_Ambito,
		$_idAmbito,
		$_Archivo,
		$_Path,
		$_Tipo,
		$_Tamano,
		$_Titulo,
		$_Pie,
		$_Publicar,
		$_Orden,
		$_Fecha
	) {
		$this->idDoc 		= $_idDoc;
		$this->Ambito 		= $_Ambito;
		$this->idAmbito 	= $_idAmbito;
		$this->Archivo 		= $_Archivo;
		$this->Path 		= $_Path;
		$this->Tipo 		= $_Tipo;
		$this->Tamano 		= $_Tamano;
		$this->Titulo 		= $_Titulo;
		$this->Pie 			= $_Pie;
		$this->Publicar 	= $_Publicar;
		$this->Orden 		= $_Orden;
		$this->Fecha 		= $_Fecha;
	}

	function _POST()
	{
		$this->idDoc 		= parent::TakePOST('IDDOC');
		$this->Ambito 		= parent::TakePOST('AMBITO');
		$this->idAmbito 	= parent::TakePOST('IDAMBITO');
		$this->Archivo 		= parent::TakePOST('ARCHIVO', 100);
		$this->Path 		= parent::TakePOST('PATH', 100);
		$this->Tipo 		= parent::TakePOST('TIPO', 50);
		$this->Tamano 		= parent::TakePOST('TAMANO');
		$this->Titulo 		= parent::TakePOST('TITULO', 100);
		$this->Pie 			= parent::TakePOST('PIE', 250);
		$this->Publicar 	= parent::TakePOST('PUBLICAR');
		$this->Orden 		= parent::TakePOST('ORDEN');
		$this->Fecha 		= parent::TakePOST('FECHA');
	}

	function _GET()
	{
		$this->idDoc 		= parent::TakeGET('IDDOC');
		$this->Ambito 		= parent::TakeGET('AMBITO');
		$this->idAmbito 	= parent::TakeGET('IDAMBITO');
		$this->Archivo 		= parent::TakeGET('ARCHIVO', 100);
		$this->Path 		= parent::TakeGET('PATH', 100);
		$this->Tipo 		= parent::TakeGET('TIPO', 50);
		$this->Tamano 		= parent::TakeGET('TAMANO');
		$this->Titulo 		= parent::TakeGET('TITULO', 100);
		$this->Pie 			= parent::TakeGET('PIE', 250);
		$this->Publicar 	= parent::TakeGET('PUBLICAR');
		$this->Orden 		= parent::TakeGET('ORDEN');
		$this->Fecha 		= parent::TakeGET('FECHA');
	}
}
