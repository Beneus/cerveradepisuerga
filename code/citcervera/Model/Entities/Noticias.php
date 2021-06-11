<?php
namespace citcervera\Model\Entities;

include_once('Models/Entities/EntityBase.php');

use citcervera\Model\Interfaces\IEntityBase;

class Noticias extends EntityBase implements IEntityBase
{
	var $idNoticia;
	var $Titulo;
	var $Entradilla;
	var $Cuerpo;
	var $Fuente;
	var $ImgNoticia;
	var $DocNoticia;
	var $FechaNoticia;
	var $Fecha;

	function Noticias(
$_idNoticia,$_Titulo,$_Entradilla,$_Cuerpo,$_Fuente,$_ImgNoticia,$_DocNoticia,$_FechaNoticia,$_Fecha){
		$this->idNoticia = $_idNoticia;
		$this->Titulo = $_Titulo;
		$this->Entradilla = $_Entradilla;
		$this->Cuerpo = $_Cuerpo;
		$this->Fuente = $_Fuente;
		$this->ImgNoticia = $_ImgNoticia;
		$this->DocNoticia = $_DocNoticia;
		$this->FechaNoticia = $_FechaNoticia;
		$this->Fecha = $_Fecha;
	}
}