<?php
namespace citcervera\Model\Entities;

use citcervera\Model\Interfaces\IEntityBase;

class TipoEvento extends EntityBase implements IEntityBase
{

	private $_tableName = 'TipoEvento';
	private $_id = 'idTipoEvento';
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

	function GetId(){
		return $this->_id;
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