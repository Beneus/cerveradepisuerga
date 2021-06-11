<?php
namespace citcervera\Model\Entities;

include_once('Models/Entities/EntityBase.php');

use citcervera\Model\Interfaces\IEntityBase;

class NucleosUrbanosImagenes extends EntityBase implements IEntityBase
{
	private $_tableName = 'NucleosUrbanosImagenes';
	var $idNucleosUrbanosImagen;
	var $idNucleoUrbano;
	var $Archivo;
	var $Tipo;
	var $Tamano;
	var $Ancho;
	var $Alto;
	var $AnchoThumb;
	var $AltoThumb;
	var $Titulo;
	var $Pie;
	var $Fecha;

	function GetTable(){
		return $this->_tableName;
	}

	function NucleosUrbanosImagenes(
$_idNucleosUrbanosImagen,$_idNucleoUrbano,$_Archivo,$_Tipo,$_Tamano,$_Ancho,$_Alto,$_AnchoThumb,$_AltoThumb,$_Titulo,$_Pie,$_Fecha){
		$this->idNucleosUrbanosImagen = $_idNucleosUrbanosImagen;
		$this->idNucleoUrbano = $_idNucleoUrbano;
		$this->Archivo = $_Archivo;
		$this->Tipo = $_Tipo;
		$this->Tamano = $_Tamano;
		$this->Ancho = $_Ancho;
		$this->Alto = $_Alto;
		$this->AnchoThumb = $_AnchoThumb;
		$this->AltoThumb = $_AltoThumb;
		$this->Titulo = $_Titulo;
		$this->Pie = $_Pie;
		$this->Fecha = $_Fecha;
	}
}