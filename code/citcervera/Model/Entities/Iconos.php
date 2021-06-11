<?php
namespace citcervera\Model\Entities;

include_once('Models/Entities/EntityBase.php');

use citcervera\Model\Interfaces\IEntityBase;

class Imagenes extends EntityBase implements IEntityBase
{
	var $idImagen;
	var $Ambito;
	var $idAmbito;
	var $Archivo;
	var $Path;
	var $Tipo;
	var $Tamano;
	var $Ancho;
	var $Alto;
	var $AnchoThumb;
	var $AltoThumb;
	var $Titulo;
	var $Pie;
	var $Publicar;
	var $Orden;
	var $Fecha;

	function Imagenes(
$_idImagen,$_Ambito,$_idAmbito,$_Archivo,$_Path,$_Tipo,$_Tamano,$_Ancho,$_Alto,$_AnchoThumb,$_AltoThumb,$_Titulo,$_Pie,$_Publicar,$_Orden,$_Fecha){
		$this->idImagen = $_idImagen;
		$this->Ambito = $_Ambito;
		$this->idAmbito = $_idAmbito;
		$this->Archivo = $_Archivo;
		$this->Path = $_Path;
		$this->Tipo = $_Tipo;
		$this->Tamano = $_Tamano;
		$this->Ancho = $_Ancho;
		$this->Alto = $_Alto;
		$this->AnchoThumb = $_AnchoThumb;
		$this->AltoThumb = $_AltoThumb;
		$this->Titulo = $_Titulo;
		$this->Pie = $_Pie;
		$this->Publicar = $_Publicar;
		$this->Orden = $_Orden;
		$this->Fecha = $_Fecha;
	}
}