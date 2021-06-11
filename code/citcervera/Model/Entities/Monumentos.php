<?php
namespace citcervera\Model\Entities;

include_once('Models/Entities/EntityBase.php');

use citcervera\Model\Interfaces\IEntityBase;

class Monumentos extends EntityBase implements IEntityBase
{
	var $idMonumento;
	var $idNucleoUrbano;
	var $idArea;
	var $Monumento;
	var $Direccion;
	var $Latitud;
	var $Longitud;
	var $Telefono;
	var $Responsable;
	var $URL;
	var $Email;
	var $Descripcion;
	var $FechaInauguracion;
	var $FechaClausura;
	var $Tipo;
	var $Horario;
	var $ImgDescripcion;
	var $Fecha;

	function Monumentos(
$_idMonumento,$_idNucleoUrbano,$_idArea,$_Monumento,$_Direccion,$_Latitud,$_Longitud,$_Telefono,$_Responsable,$_URL,$_Email,$_Descripcion,$_FechaInauguracion,$_FechaClausura,$_Tipo,$_Horario,$_ImgDescripcion,$_Fecha){
		$this->idMonumento = $_idMonumento;
		$this->idNucleoUrbano = $_idNucleoUrbano;
		$this->idArea = $_idArea;
		$this->Monumento = $_Monumento;
		$this->Direccion = $_Direccion;
		$this->Latitud = $_Latitud;
		$this->Longitud = $_Longitud;
		$this->Telefono = $_Telefono;
		$this->Responsable = $_Responsable;
		$this->URL = $_URL;
		$this->Email = $_Email;
		$this->Descripcion = $_Descripcion;
		$this->FechaInauguracion = $_FechaInauguracion;
		$this->FechaClausura = $_FechaClausura;
		$this->Tipo = $_Tipo;
		$this->Horario = $_Horario;
		$this->ImgDescripcion = $_ImgDescripcion;
		$this->Fecha = $_Fecha;
	}
}