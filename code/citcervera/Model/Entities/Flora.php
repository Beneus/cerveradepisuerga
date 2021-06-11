<?php
namespace citcervera\Model\Entities;

use citcervera\Model\Interfaces\IEntityBase;



class Flora extends EntityBase implements IEntityBase
{
	var $idFlora;
	var $NombreComun;
	var $NombreCientifico;
	var $Familia;
	var $Descripcion;
	var $Habitat;
	var $Usos;
	var $ImgDescripcion;
	var $ImgHabitat;
	var $ImgUsos;
	var $Fecha;


	function Flora(
$_idFlora,$_NombreComun,$_NombreCientifico,$_Familia,$_Descripcion,$_Habitat,$_Usos,$_ImgDescripcion,$_ImgHabitat,$_ImgUsos,$_Fecha){
		$this->idFlora = $_idFlora;
		$this->NombreComun = $_NombreComun;
		$this->NombreCientifico = $_NombreCientifico;
		$this->Familia = $_Familia;
		$this->Descripcion = $_Descripcion;
		$this->Habitat = $_Habitat;
		$this->Usos = $_Usos;
		$this->ImgDescripcion = $_ImgDescripcion;
		$this->ImgHabitat = $_ImgHabitat;
		$this->ImgUsos = $_ImgUsos;
		$this->Fecha = $_Fecha;
	}

	function GetTable()
	{
		
	}

	
}