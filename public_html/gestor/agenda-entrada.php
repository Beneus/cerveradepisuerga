<?php
include("includes/Conn.php");
include("includes/variables.php");
include("includes/funciones.php");

use citcervera\Model\Entities\Agenda;
use citcervera\Model\Entities\NucleosUrbanos;
use citcervera\Model\Entities\TipoEvento;
use citcervera\Model\Managers\DataCarrier;
use citcervera\Model\Managers\Manager;

$dc = new DataCarrier();
$Agenda = new Agenda();
$NucleosUrbanos = new NucleosUrbanos();
$agendaManager = new Manager($Agenda);
$nucleosUrbanosManager = new Manager($NucleosUrbanos);
$TipoEvento = new TipoEvento();
$tipoEventoManager = new Manager($TipoEvento);
$dc->Set($nucleosUrbanosManager->GetAll(), 'NucleosUrbanos');
$dc->Set($tipoEventoManager->GetAll(), 'TipoEvento');


$ErrorMsg = '';
$Evento = '';
$Lugar = '';
$idNucleoUrbano = '';
$Telefono = '';
$Email = '';
$URL = '';
$Contacto = '';
$Precio = '';
$idTipoEvento = '';
$ErrorMsn = '';
$HoraEvento = '';
$FechaEvento = '';

if ($_SERVER['REQUEST_METHOD']== "POST"){
	
	$Agenda->_POST();
	$Adjuntar = $_POST["ADJUNTAR"];
	

	if ($Agenda->Evento == ""){
		$ErrorMsg = "<span class=\"errortexto\">Evento.</a><br/>";
	}
	if ($Agenda->idTipoEvento != "17"){// fiestas oficiales
		if ($Agenda->Lugar == ""){
			$ErrorMsg .= "<span class=\"errortexto\">Lugar.</a><br/>";
		}
	}
	if (is_null($Agenda->FechaEvento)) {
      $ErrorMsg .= "<span class=\"errortexto\">Fecha del evento.</a><br/>";
   }
	if(isset($Agenda->FechaEvento)){
		if (($Agenda->FechaEvento != "") && ((!isValidaFechaCorta($Agenda->FechaEvento )) or ( strlen($Agenda->FechaEvento ) != 10))){
			$ErrorMsg .= "<span class=\"errortexto\">Fecha del evento.</a><br/>";
		}else{
			$Agenda->FechaEvento = FechaReves($Agenda->FechaEvento);
		}
	}
	if(isset($Agenda->HoraEvento)){
		if (($Agenda->HoraEvento != "") && ((!isValidaHoraCorta($Agenda->HoraEvento)) or ( strlen($Agenda->HoraEvento) != 5))){
			$ErrorMsg .= "<span class=\"errortexto\">Hora del evento.</a><br/>";
		}
	}

	if ($ErrorMsg == "" ){	


		$agendaManager->Save($Agenda);
		$lastInsertedId = $agendaManager->GetLastInsertedId();
		$idAgenda->idAgenda = $lastInsertedId;
		$dc->Set($agendaManager->Get($lastInsertedId), 'Agenda');

	if ($Adjuntar){
		header("Location:agenda-editar.php?idAgenda=$idAgenda");
		}else{
		header("Location:agenda-entrada.php");
		}
	exit;
	
	}//if ($ErrorMsg == "" ){
	else{
		// devolvemos el error
		 $ErrorMsn = "Los siguientes campos est&aacute;n vacios o no contienen valores permitidos:<br/>";
		 $ErrorMsn .= "<blockquote>";
		 $ErrorMsn .= $ErrorMsg;
		 $ErrorMsn .= "</blockquote>";
	}

}

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8" />
<meta http-equiv="CACHE-CONTROL" content="NO-CACHE" />
<title>Gestor de contenidos: Agenda entrada</title>
<link href="css/menu.css" rel="stylesheet" type="text/css" />
<link href="css/gestor.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="scripts/tiny_mce.js" language="javascript" ></script>
<script type="text/javascript" src="js/funciones.js" language="javascript"></script>
<script language="javascript" type="text/javascript">
tinyMCE.init({
	mode : "textareas",
	theme : "advanced",
	theme_advanced_buttons1 : "newdocument,bold,italic,underline,separator,strikethrough,justifyleft,justifycenter,justifyright, justifyfull,bullist,numlist,undo,redo,link,unlink",
	theme_advanced_buttons1_add : "outdent,indent",
	theme_advanced_buttons2 : "",
	theme_advanced_buttons3 : "",
	theme_advanced_toolbar_location : "top",
	theme_advanced_toolbar_align : "left",
	theme_advanced_path_location : "bottom",
	extended_valid_elements : "a[name|href|target|title|onclick],img[class|src|border=0|alt|title|hspace|vspace|width|height|align|onmouseover|onmouseout|name],hr[class|width|size|noshade],font[face|size|color|style],span[class|align|style]"
});
</script>
</head>

<body>
<div id="espere" style="display:none" >
  <div align="center"><img src="images/cargando.gif" alt="Enviando datos" width="32" height="32" /></div>
</div>
<?php if ($ErrorMsn != ""){ ?>
<script type="text/javascript">
disDiv("contenido",true); 
</script>
<div id="error">
  <div id="errorcab" align="right"><a href="#" onclick="document.getElementById('error').style.display='none';disDiv('contenido',false);">Cerrar&nbsp;[x]</a>&nbsp;</div>
  <div id="errormsn" ><?php echo $ErrorMsn; ?>
  </div>
</div>
<?php } ?>
<div id="cab">
  <div><img src="images/cab.gif" width="1024" height="100" border="0" usemap="#Map" />
  <map name="Map" id="Map">
        <area shape="rect" coords="857,40,1011,73" href="#" onclick="location.href='desconexion.php';" alt="Desconectar del gestor" />
      </map></div>
</div>
<div id="menu">
<?php echo $strMenu; ?>
</div>
<nobr clear="left" ></nobr>
<div id="submenu">
<?php echo $strSubMenu; ?>
</div>
<div id="opciones">
  <ul>
    <li class="liselect"><a title="A&ntilde;adir monumento" href="agenda-entrada.php">A&ntilde;adir entrada</a></li>
    <li><a title="Listado del monumentos"  href="agenda-listado.php">Listado</a></li>
  </ul>
</div>
<div class="separador">&nbsp;</div>
<div id="contenido">
<form id="formEntrada" method="post" name="formEntrada" action="agenda-entrada.php" onsubmit="EnviarEntradaAgenda(this,'nuevo');return false;">

<div class="tablaizq">
<ul class="tablaformizq">
    
    <li class="campoform">
      <div class="tituloentradaform">Evento</div>
      <div class="valorentradaform">
        <input name="EVENTO" type="text" id="EVENTO" value="<?php echo $Evento; ?>" size="35" />
      </div>
     </li>
     <li class="campoform">
      <div class="tituloentradaform">Lugar</div>
      <div class="valorentradaform">
        <input name="LUGAR" type="text" id="LUGAR" value="<?php echo $Lugar; ?>" size="35" />
      </div>
     </li>
    
    <li class="campoform">
        <div class="tituloentradaform">Poblaci&oacute;n</div>
        <div class="valorentradaform">
          <?php 
		$list = GetSmallArrayFromBiggerOne($dc, 'NucleosUrbanos', array('idNucleoUrbano','NombreNucleoUrbano') );
		echo GetSelect("IDNUCLEOURBANO","idNucleoUrbano","NombreNucleoUrbano",$list,"","","","","Todos");

	  ?>
        </div>    </li>  
     <li class="campoform">
        <div class="tituloentradaform">Hora evento</div>
        <div class="valorentradaform">
          <input name="HORAEVENTO" type="text" id="HORAEVENTO" value="<?php echo $HoraEvento; ?>" size="5" />
          (hh:mm)
        </div>    </li>  
        <li class="campoform">
        <div class="tituloentradaform">Fecha evento</div>
        <div class="valorentradaform"><input name="FECHAEVENTO" type="text" id="FECHAEVENTO" value="<?php echo $FechaEvento; ?>" size="10" maxlength="10" />
          (dd/mm/aaaa)         </div>
        </li>
        
       
       
</ul>
</div>
<div class="tablader">
<ul class="tablaformder">
  <li class="campoform">
        <div class="tituloentradaform">Email</div>
        <div class="valorentradaform">
          <input name="EMAIL" type="text" id="EMAIL" value="<?php echo $Email; ?>" size="35" />
        </div>    </li>  
         <li class="campoform">
        <div class="tituloentradaform">URL</div>
        <div class="valorentradaform">
          <input name="URL" type="text" id="URL" value="<?php echo $URL; ?>" size="35" />
        </div>    </li>  
        <li class="campoform">
        <div class="tituloentradaform">Contacto</div>
        <div class="valorentradaform">
          <input name="CONTACTO" type="text" id="CONTACTO" value="<?php echo $Contacto; ?>" size="35" />
        </div>    </li>  
         <li class="campoform">
        <div class="tituloentradaform">Precio</div>
        <div class="valorentradaform">
          <input name="PRECIO" type="text" id="PRECIO" value="<?php echo $Precio; ?>" />
        </div>    
         </li>    
      <li class="campoform">
        <div class="tituloentradaform">Tel&eacute;fono</div>
        <div class="valorentradaform">
          <input name="TELEFONO" type="text" id="TELEFONO" value="<?php echo $Telefono; ?>" size="16" maxlength="16" />
        </div>    </li>  
        <li class="campoform">
        <div class="tituloentradaform">Tipo evento</div>
        <div class="valorentradaform">
		<?php 
		$list = GetSmallArrayFromBiggerOne($dc, 'TipoEvento', array('idTipoEvento','TipoEvento') );
		echo GetSelect("TIPOEVENTO","idTipoEvento","TipoEvento",$list,"","","","","Todos");

	  ?>
        </div>    </li> 
        
</ul>
</div>
<br class="limpiar" />
<div class="textolargo">
<ul class="tablaformtextolargo">
    <li class="campoform">
      <div class="tituloentradaform">Descripci&oacute;n</div>
      <div class="valorentradaform">
        <textarea name="DESCRIPCION" cols="80" rows="10" id="DESCRIPCION"></textarea>
      </div>
     </li>
   
     <li class="campoform">
        <div class="tituloentradaform">&nbsp;</div>
        <div class="valorentradaform">
          <input type="submit" name="ENVIAR" id="ENVIAR" value="Publicar evento" />
          <br />
          <input type="submit" name="ENVIAR2" id="ENVIAR2" value="Publicar evento y adjuntar Documento" onclick="document.formEntrada.ADJUNTAR.value=1;"/>
        </div>    </li>    
</ul>
</div>
<input type="hidden" name="ADJUNTAR" value="0" />
</form>
</div>


<br clear="left" />
</body>
<?php if ($ErrorMsn != ""){ ?>
<script type="text/javascript">
disDiv("contenido",true); 
</script>
<?php } ?>
</html>
