<?php

namespace citcervera\Model\Entities;

use citcervera\Model\Interfaces\IEntityBase;

class Menu extends EntityBase implements IEntityBase
{
	private $_tableName = 'Menu';
	private $_id = 'idMenu';
	var $idMenu;
	var $Menu;
	var $pagina;

	public function __construct()
	{
		//parent::__construct();
	}

	public function Init(Array $properties=array())
	{
		foreach($properties as $key => $value)
		{
		  	$this->{$key} = $value;
		}
	}
	
	function GetTable()
	{
		return $this->_tableName;
	}

	function GetId(){
		return $this->_id;
	}

	function Menu($_idMenu,$_Menu,$_pagina)
	{
		$this->idMenu = $_idMenu;
		$this->Menu = $_Menu;
		$this->pagina = $_pagina;
	}

	function _POST()
	{
		$this->idMenu 			= parent::TakePOST('IDMENU');
		$this->Menu 			= parent::TakePOST('MENU',255);
		$this->pagina 			= parent::TakePOST('PAGINA', 255);
	}

	function _GET()
	{
		$this->idMenu 			= parent::TakeGET('IDMENU');
		$this->Menu 			= parent::TakeGET('MENU',255);
		$this->pagina 			= parent::TakeGET('PAGINA', 255);
	}
}