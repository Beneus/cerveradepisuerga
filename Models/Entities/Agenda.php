<?php
namespace Citcervera\Models\Entities;

include_once('Models/Entities/EntityBase.php');

use Citcervera\Models\Interfaces\IEntityBase;

class Agenda extends EntityBase implements IEntityBase
{
	private $_tableName = 'Agenda';
	var $idAgenda;
	var $idNucleoUrbano;
	var $Evento;
	var $Lugar;
	var $Descripcion;
	var $Precio;
	var $idTipoEvento;
	var $FechaEvento;
	var $HoraEvento;
	var $Email;
	var $URL;
	var $Telefono;
	var $Contacto;
	var $ImgAgenda;
	var $DocAgenda;
	var $Fecha;
	/*
	public function __construct(
		Array $properties=array()
		)
	{
		foreach($properties as $key => $value)
		{
		  	$this->{$key} = $value;
		}
	}
*/

	public function Init(Array $properties=array()){
		foreach($properties as $key => $value)
		{
		  	$this->{$key} = $value;
		}
	}
	
	function GetTable(){
		return $this->_tableName;
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
		$this->idAgenda = $_idAgenda;
		$this->idNucleoUrbano = $_idNucleoUrbano;
		$this->Evento = $_Evento;
		$this->Lugar = $_Lugar;
		$this->Descripcion = $_Descripcion;
		$this->Precio = $_Precio;
		$this->idTipoEvento = $_idTipoEvento;
		$this->FechaEvento = $_FechaEvento;
		$this->HoraEvento = $_HoraEvento;
		$this->Email = $_Email;
		$this->URL = $_URL;
		$this->Telefono = $_Telefono;
		$this->Contacto = $_Contacto;
		$this->ImgAgenda = $_ImgAgenda;
		$this->DocAgenda = $_DocAgenda;
		$this->Fecha = $_Fecha;
	}
}