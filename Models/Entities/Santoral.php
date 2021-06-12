<?php
namespace Citcervera\Models\Entities;

include_once('Models/Entities/EntityBase.php');

use Citcervera\Models\Interfaces\IEntityBase;

class Santoral extends EntityBase implements IEntityBase
{
	protected $_tableName = 'Santoral';

	var $idSantoral;
	var $Mes;
	var $Dia;
	var $Santos;
	
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

	function Agenda(
		$_idSantoral,
		$_Mes,
		$_Dia,
        $_Santos
        )
	{
		$this->idSantoral = $_idSantoral;
		$this->Mes = $_Mes;
		$this->Dia = $_Dia;
		$this->Santos = $_Santos;
		
	}
}