<?php
namespace citcervera\Model\Entities;

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
			
    function GetTable(){
		//return $this->_tableName;
	}

    function _POST()
	{
		$this->idImagen 		= parent::TakePOST('IDDOC');
		$this->Ambito 		    = parent::TakePOST('AMBITO');
		$this->idAmbito 	    = parent::TakePOST('IDAMBITO');
		$this->Archivo 		    = parent::TakePOST('ARCHIVO',100);
		$this->Path 		    = parent::TakePOST('PATH',100);
		$this->Tipo 		    = parent::TakePOST('TIPO',50);
        $this->Tamano 		    = parent::TakePOST('TAMANO');
        $this->Ancho            = parent::TakePOST('ANCHO');
        $this->Alto             = parent::TakePOST('ALTO');
        $this->AnchoThumb       = parent::TakePOST('ANCHOTHUMB');
		$this->AltoThumb        = parent::TakePOST('ALTOTHMB');
		$this->Titulo 		    = parent::TakePOST('TITULO',100);
		$this->Pie 			    = parent::TakePOST('PIE',250);
		$this->Publicar 	    = parent::TakePOST('PUBLICAR');
		$this->Orden 		    = parent::TakePOST('ORDEN');
		$this->Fecha 		    = parent::TakePOST('FECHA');
	}

	function _GET()
	{
		$this->idImagen 		= parent::TakeGET('IDDOC');
		$this->Ambito 		    = parent::TakeGET('AMBITO');
		$this->idAmbito 	    = parent::TakeGET('IDAMBITO');
		$this->Archivo 		    = parent::TakeGET('ARCHIVO',100);
		$this->Path 		    = parent::TakeGET('PATH',100);
		$this->Tipo 		    = parent::TakeGET('TIPO',50);
        $this->Tamano 		    = parent::TakeGET('TAMANO');
        $this->Ancho            = parent::TakeGET('ANCHO');
        $this->Alto             = parent::TakeGET('ALTO');
        $this->AnchoThumb       = parent::TakeGET('ANCHOTHUMB');
		$this->AltoThumb        = parent::TakeGET('ALTOTHMB');
		$this->Titulo 		    = parent::TakeGET('TITULO',100);
		$this->Pie 			    = parent::TakeGET('PIE',250);
		$this->Publicar 	    = parent::TakeGET('PUBLICAR');
		$this->Orden 		    = parent::TakeGET('ORDEN');
		$this->Fecha 		    = parent::TakeGET('FECHA');
    }
    
	
}