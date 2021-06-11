<?php

namespace citcervera\Model\Entities;

include_once('Models/Entities/EntityBase.php');

use citcervera\Model\Interfaces\IEntityBase;

class Deportes extends EntityBase implements IEntityBase
{
	private $_tableName = 'Deportes';
	var $idDeporte;
	var $idNucleoUrbano;
	var $ActoDeportivo;
	var $FechaInicio;
	var $FechaFinal;
	var $Hora;
	var $Lugar;
	var $Contacto;
	var $Telefono;
	var $Email;
	var $Url;
	var $Descripcion;
	var $Precio;
	var $ImgDescripcion;
	var $DocDeporte;
	var $Fecha;

	function Deportes(
		$_idDeporte,
		$_idNucleoUrbano,
		$_ActoDeportivo,
		$_FechaInicio,
		$_FechaFinal,
		$_Hora,
		$_Lugar,
		$_Contacto,
		$_Telefono,
		$_Email,
		$_Url,
		$_Descripcion,
		$_Precio,
		$_ImgDescripcion,
		$_DocDeporte,
		$_Fecha
	) {
		$this->idDeporte = $_idDeporte;
		$this->idNucleoUrbano = $_idNucleoUrbano;
		$this->ActoDeportivo = $_ActoDeportivo;
		$this->FechaInicio = $_FechaInicio;
		$this->FechaFinal = $_FechaFinal;
		$this->Hora = $_Hora;
		$this->Lugar = $_Lugar;
		$this->Contacto = $_Contacto;
		$this->Telefono = $_Telefono;
		$this->Email = $_Email;
		$this->Url = $_Url;
		$this->Descripcion = $_Descripcion;
		$this->Precio = $_Precio;
		$this->ImgDescripcion = $_ImgDescripcion;
		$this->DocDeporte = $_DocDeporte;
		$this->Fecha = $_Fecha;
	}

	function GetTable()
	{
		return $this->_tableName;
	}
}
