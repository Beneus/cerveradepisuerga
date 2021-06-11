<?php
namespace citcervera\Model\Entities;

use citcervera\Model\Interfaces\IEntityBase;

class SubMenu extends EntityBase implements IEntityBase
{
	private $_tableName = 'SubMenu';
	private $_id = 'idSubMenu';
	var $idSubMenu;
	var $idMenu;
	var $SubMenu;
	var $pagina;

	function GetTable()
	{
		return $this->_tableName;
	}

	function GetId(){
		return $this->_id;
	}

	function SubMenu($_idSubMenu,$_idMenu,$_SubMenu,$_pagina)
	{
		$this->idSubMenu = $_idSubMenu;
		$this->idMenu = $_idMenu;
		$this->SubMenu = $_SubMenu;
		$this->pagina = $_pagina;
	}

	function _POST()
	{
		$this->idSubMenu 		= parent::TakePOST('IDSUBMENU');
		$this->idMenu 			= parent::TakePOST('IDMENU');
		$this->Menu 			= parent::TakePOST('MENU',255);
		$this->pagina 			= parent::TakePOST('PAGINA', 255);
	}

	function _GET()
	{
		$this->idSubMenu 		= parent::TakeGET('IDSUBMENU');
		$this->idMenu 			= parent::TakeGET('IDMENU');
		$this->Menu 			= parent::TakeGET('MENU',255);
		$this->pagina 			= parent::TakeGET('PAGINA', 255);
	}
}