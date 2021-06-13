<?php
namespace citcervera\Model\Entities;

use citcervera\Model\Interfaces\IEntityBase;

class Agenda extends EntityBase implements IEntityBase
{
	private $_tableName = 'Agenda';
	private $_id = 'idAgenda';
	public $idAgenda;
	public $idNucleoUrbano;
	public $Evento;
	public $Lugar;
	public $Descripcion;
	public $Precio;
	public $idTipoEvento;
	public $FechaEvento;
	public $HoraEvento;
	public $Email;
	public $URL;
	public $Telefono;
	public $Contacto;
	public $ImgAgenda;
	public $DocAgenda;
	public $Fecha;
	
	
	public function __construct()
	{
		//parent::__construct();
	}

	public function Init(Array $properties=array())
	{
		foreach($properties as $key => $value)
		{
		  	$this->{$key} = $value;
		}
	}
	
	function GetTable(){
		return $this->_tableName;
	}

	function GetId(){
		return $this->_id;
	}


	function Agenda(
		$_idAgenda,
		$_idNucleoUrbano,
		$_Evento,
		$_Lugar,
		$_Descripcion,
		$_Precio,
		$_idTipoEvento,
		$_FechaEvento,
		$_HoraEvento,
		$_Email,
		$_URL,
		$_Telefono,
		$_Contacto,
		$_ImgAgenda,
		$_DocAgenda,
		$_Fecha)
	{
		$this->idAgenda 		= $_idAgenda;
		$this->idNucleoUrbano 	= $_idNucleoUrbano;
		$this->Evento 			= $_Evento;
		$this->Lugar 			= $_Lugar;
		$this->Descripcion 		= $_Descripcion;
		$this->Precio 			= $_Precio;
		$this->idTipoEvento 	= $_idTipoEvento;
		$this->FechaEvento 		= $_FechaEvento;
		$this->HoraEvento 		= $_HoraEvento;
		$this->Email 			= $_Email;
		$this->URL 				= $_URL;
		$this->Telefono 		= $_Telefono;
		$this->Contacto 		= $_Contacto;
		$this->ImgAgenda 		= $_ImgAgenda;
		$this->DocAgenda 		= $_DocAgenda;
		$this->Fecha 			= $_Fecha;
	}

	public function ValidateRules()
	{
		$validation = [
			'Evento' => [
				'required' => true
			],
			'FechaEvento' => [
				'format' => 'fechaCorta'
			],
			'HoraEvento' => [
				'format' => 'horaCorta'
			]
		];
		return $validation;
	}





	function _POST()
	{
		$this->idAgenda 		= parent::TakePOST('IDAGENDA');
		$this->Evento 			= parent::TakePOST('EVENTO',255);
		$this->Lugar 			= parent::TakePOST('LUGAR', 255);
		$this->idNucleoUrbano 	= parent::TakePOST('IDNUCLEOURBANO');
		$this->Telefono 		= parent::TakePOST('TELEFONO',16);
		$this->Email 			= parent::TakePOST('EMAIL',100);
		$this->URL 				= parent::TakePOST('URL', 255);
		$this->Contacto 		= parent::TakePOST('CONTACTO',50);
		$this->Precio 			= parent::TakePOST('PRECIO');
		$this->idTipoEvento 	= parent::TakePOST('IDTIPOEVENTO');
		$this->Descripcion 		= htmlentities(parent::TakePOST('DESCRIPCION'),ENT_QUOTES);
		$this->HoraEvento 		= parent::TakePOST('HORAEVENTO');
		$this->FechaEvento 		= parent::TakePOST('FECHAEVENTO'); // dddd/mm/dd
		$this->ImgAgenda 		= parent::TakePOST('IMGAGENDA');
		$this->DocAgenda 		= parent::TakePOST('DOCAGENDA');
		$this->Fecha 			= parent::TakePOST('FECHA');
	}

	function _GET()
	{
		$this->idAgenda 		= parent::TakeGET('IDAGENDA');
		$this->Evento 			= parent::TakeGET('EVENTO',255);
		$this->Lugar 			= parent::TakeGET('LUGAR', 255);
		$this->idNucleoUrbano 	= parent::TakeGET('IDNUCLEOURBANO');
		$this->Telefono 		= parent::TakeGET('TELEFONO',16);
		$this->Email 			= parent::TakeGET('EMAIL',100);
		$this->URL 				= parent::TakeGET('URL', 255);
		$this->Contacto 		= parent::TakeGET('CONTACTO',50);
		$this->Precio 			= parent::TakeGET('PRECIO');
		$this->idTipoEvento 	= parent::TakeGET('IDTIPOEVENTO');
		$this->Descripcion 		= htmlentities(parent::TakeGET('DESCRIPCION'),ENT_QUOTES);
		$this->HoraEvento 		= parent::TakeGET('HORAEVENTO');
		$this->FechaEvento 		= parent::TakeGET('FECHAEVENTO'); // dddd/mm/dd
		$this->ImgAgenda 		= parent::TakeGET('IMGAGENDA');
		$this->DocAgenda 		= parent::TakeGET('DOCAGENDA');
		$this->Fecha 			= parent::TakeGET('FECHA');
	}
}