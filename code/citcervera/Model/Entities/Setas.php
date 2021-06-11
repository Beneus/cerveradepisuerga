<?php
namespace citcervera\Model\Entities;

include_once('Models/Entities/EntityBase.php');

use citcervera\Model\Interfaces\IEntityBase;

class Setas extends EntityBase implements IEntityBase
{
	var $idSetas;
	var $NombreComun;
	var $NombreCientifico;
	var $Autor;
	var $Clasificacion;
	var $Clase;
	var $idSetasSubOrden;
	var $Sombrero;
	var $Pie;
	var $Cuerpo;
	var $Laminas;
	var $Himenio;
	var $Exporada;
	var $Carne;
	var $EpocaHabitat;
	var $Comestibilidad;
	var $Comentarios;
	var $ImgSetas;
	var $Fecha;

	function Setas(
$_idSetas,$_NombreComun,$_NombreCientifico,$_Autor,$_Clasificacion,$_Clase,$_idSetasSubOrden,$_Sombrero,$_Pie,$_Cuerpo,$_Laminas,$_Himenio,$_Exporada,$_Carne,$_EpocaHabitat,$_Comestibilidad,$_Comentarios,$_ImgSetas,$_Fecha){
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
}