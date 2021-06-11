<?php
namespace citcervera\Model\Entities;

include_once('Models/Entities/EntityBase.php');

use citcervera\Model\Interfaces\IEntityBase;

class Rutas extends EntityBase implements IEntityBase
{
	var $idRuta;
	var $Ruta;
	var $Inicio;
	var $Llegada;
	var $Distancia;
	var $Tiempo;
	var $Desnivel;
	var $Piso;
	var $Dificultad;
	var $Epoca;
	var $Descripcion;
	var $Flora;
	var $Fauna;
	var $ImgDescripcion;
	var $ImgFlora;
	var $ImgFauna;
	var $URL;
	var $Fecha;

	function Rutas(
$_idRuta,$_Ruta,$_Inicio,$_Llegada,$_Distancia,$_Tiempo,$_Desnivel,$_Piso,$_Dificultad,$_Epoca,$_Descripcion,$_Flora,$_Fauna,$_ImgDescripcion,$_ImgFlora,$_ImgFauna,$_URL,$_Fecha){
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
}