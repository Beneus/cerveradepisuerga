<?php
namespace citcervera\Model\Entities;

include_once('Models/Entities/EntityBase.php');

use citcervera\Model\Interfaces\IEntityBase;

class SetasSubOrden extends EntityBase implements IEntityBase
{
	var $idSetasSubOrden;
	var $Clase;
	var $SubOrden;

	function SetasSubOrden(
$_idSetasSubOrden,$_Clase,$_SubOrden){
		$this->idSetasSubOrden = $_idSetasSubOrden;
		$this->Clase = $_Clase;
		$this->SubOrden = $_SubOrden;
	}
}