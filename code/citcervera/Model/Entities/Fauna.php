<?php
namespace citcervera\Model\Entities;

include_once('Models/Entities/EntityBase.php');

use citcervera\Model\Interfaces\IEntityBase;

class Fauna extends EntityBase implements IEntityBase
{
	var $idFauna;
	var $NombreComun;
	var $NombreCientifico;
	var $Familia;
	var $Descripcion;
	var $Habitat;
	var $ImgDescripcion;
	var $ImgHabitat;
	var $Fecha;

	function Fauna(
$_idFauna,$_NombreComun,$_NombreCientifico,$_Familia,$_Descripcion,$_Habitat,$_ImgDescripcion,$_ImgHabitat,$_Fecha){
		$this->idFauna = $_idFauna;
		$this->NombreComun = $_NombreComun;
		$this->NombreCientifico = $_NombreCientifico;
		$this->Familia = $_Familia;
		$this->Descripcion = $_Descripcion;
		$this->Habitat = $_Habitat;
		$this->ImgDescripcion = $_ImgDescripcion;
		$this->ImgHabitat = $_ImgHabitat;
		$this->Fecha = $_Fecha;
	}
}