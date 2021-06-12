<?php
namespace citcervera\Model\Entities;

use citcervera\Model\Interfaces\IEntityBase;

abstract class entityBase implements IEntityBase
{
    //private $_tableName;

    public function __construct()
    {
        // Constructor's functionality here, if you have any.
        //$this->_tableName = '';
        
    }

    public function TakePOST($property, $length = 0)
	{
		if($length > 0)
		{
			return $this->Limpiar($_POST[$property] ?? '',$length);
		}
		else
		{
			return $_POST[$property] ?? '';
		}
	}

	public function TakeGET($property, $length = 0)
	{
		if($length > 0)
		{
			return $this->Limpiar($_GET[$property] ?? '',$length);
		}
		else
		{
			return $_POST[$property] ?? '';
		}
	}

	public function TakePUT($property, $length = 0)
	{
		if($length > 0)
		{
			return $this->Limpiar($_PUT[$property] ?? '',$length);
		}
		else
		{
			return $_PUT[$property] ?? '';
		}
	}

	private function Limpiar($cad,$longitud)
	{
		$cad = str_replace("'","",$cad);
		if ($longitud > 0)
		{
			$cad = substr($cad,0,$longitud);
		}
		$cad = trim($cad," \'\t\n");
		return $cad;
	}

	function GetId(){
		return $this->_id;
	}
}