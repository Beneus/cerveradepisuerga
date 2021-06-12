<?php
namespace Citcervera\Models\Entities;

include_once('Models/Entities/EntityBase.php');

use Citcervera\Models\Interfaces\IEntityBase;

class TipoEvento extends EntityBase implements IEntityBase
{

	private $_tableName = 'TipoEvento';
	var $idTipoEvento;
	var $TipoEvento;
	var $Orden;

	/*
	public function __construct(
		Array $properties=array()
		)
	{
		foreach($properties as $key => $value)
		{
		  	$this->{$key} = $value;
		}
	}
*/

	public function Init(Array $properties=array()){
		foreach($properties as $key => $value)
		{
		  	$this->{$key} = $value;
		}
	}
	
	function GetTable(){
		return $this->_tableName;
	}

	function TipoEvento(
		$_idTipoEvento,
		$_TipoEvento,
		$_Orden
		)
	{
		$this->idTipoEvento = $_idTipoEvento;
		$this->TipoEvento = $_TipoEvento;
		$this->Orden = $_Orden;
	}
}