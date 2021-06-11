<?php
include("includes/Conn.php");
include("includes/variables.php");
include("includes/funciones.php");


$idAgenda = $_GET["idAgenda"];
$Mostrar = $_GET["Mostrar"];
$Pagina = $_GET["Pagina"];
$Buscar = $_GET["Buscar"];
$idNucleoUrbano = $_GET["idNucleoUrbano"];


if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $Evento = $_POST["EVENTO"];
    $Lugar = $_POST["LUGAR"];
    $idNucleoUrbano = $_POST["IDNUCLEOURBANO"];
    if ($idNucleoUrbano == "")
        $idNucleoUrbano = 0;
    $Telefono = $_POST["TELEFONO"];
    $Email = $_POST["EMAIL"];
    $URL = $_POST["URL"];
    $Contacto = $_POST["CONTACTO"];
    $Descripcion = htmlentities($_POST["DESCRIPCION"], ENT_QUOTES);
    $HoraEvento = $_POST["HORAEVENTO"];
    $FechaEvento = $_POST["FECHAEVENTO"];

    if ($Evento == "") {
        $ErrorMsg = "<span class=\"errortexto\">Evento.</a><br/>";
    }
    if ($Lugar == "") {
        $ErrorMsg .= "<span class=\"errortexto\">Lugar.</a><br/>";
    }
    if ($FechaEvento == "") {
        $ErrorMsg .= "<span class=\"errortexto\">Fecha del evento.</a><br/>";
    }
    if (($FechaEvento != "") && ((!isValidaFechaCorta($FechaEvento)) or (strlen($FechaEvento) !=
        10))) {
        $ErrorMsg .= "<span class=\"errortexto\">Fecha del evento.</a><br/>";
    }
    if (($HoraEvento != "") && ((!isValidaHoraCorta($HoraEvento)) or (strlen($HoraEvento) !=
        5))) {
        $ErrorMsg .= "<span class=\"errortexto\">Hora del evento.</a><br/>";
    }

    if ($ErrorMsg == "") {
        $link = ConnBDCervera();
        $sqlUp = " UPDATE Agenda set " . "idNucleoUrbano = " . $idNucleoUrbano . ", " .
            "Evento = '" . Limpiar($Evento, 255) . "', " . "Lugar = '" . Limpiar($Lugar, 255) .
            "', " . "Descripcion = '" . $Descripcion . "', " . "FechaEvento = '" .
            FechaReves($FechaEvento) . "', " . "HoraEvento = '" . $HoraEvento . "', " .
            "Email = '" . Limpiar($Email, 100) . "', " . "URL = '" . Limpiar($URL, 255) .
            "', " . "Telefono = '" . Limpiar($Telefono, 16) . "', " . "Contacto = '" .
            Limpiar($Contacto, 50) . "', " . "Fecha = Now() " . " where idAgenda = " . $idAgenda;
        $result = mysqli_query($link,$sqlUp);

        // obtengo el idDirectorio del ultimo registro introducido

        $sql = " Select idAgenda from Agenda order by idAgenda desc limit 1";
        $result = mysqli_query($link,$sql);
        if (!$result) {
            $message = "Invalid query" . mysqli_error($link) . "\n";
            $message .= "whole query: " . $sql;
            die($message);
            exit;
        }
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        $idAgenda = $row["idAgenda"];
        mysqli_free_result($result);


        mysqli_close($link);
        // introducido los datos del evento pasamos a editar la entrada para dar opcion a la inserci�n de archivos adjuntos
        header("Location:agenda-listado.php?Mostrar=$Mostrar&Pagina=$Pagina&Buscar=$Buscar&idNucleoUrbano=" .
            $_GET["$idNucleoUrbano"]);
        exit;
        
    } //if ($ErrorMsg == "" ){
    else {
        // devolvemos el error
        $ErrorMsn = "Los siguientes campos est&aacute;n vacios o no contienen valores permitidos:<br/>";
        $ErrorMsn .= "<blockquote>";
        $ErrorMsn .= $ErrorMsg;
        $ErrorMsn .= "</blockquote>";
    }


} //($_SERVER['REQUEST_METHOD']== "POST")
else {

    $sql = " Select AG.*, IM.Path as ImgPath, IM.Archivo as ImgArchivo, IM.AnchoThumb, IM.AltoThumb, DOC.Path as DocPath, DOC.Archivo as DocArchivo From Agenda as AG " .
        " left join imagenes as IM on AG.ImgAgenda = IM.idImagen " .
        " left join documentos as DOC ON AG.docAgenda = DOC.idDoc where idAgenda = $idAgenda";
    $link = ConnBDCervera();
    $result = mysqli_query($link,$sql);
    if (!$result) {
        $message = "Invalid query" . mysqli_error($link) . "\n";
        $message .= "whole query: " . $sql;
        die($message);
        exit;
    }
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $idAgenda = $row["idAgenda"];
    $Evento = $row["Evento"];
    $Lugar = $row["Lugar"];
    $idNucleoUrbano = $row["idNucleoUrbano"];
    $Telefono = $row["Telefono"];
    $Email = $row["Email"];
    $URL = $row["URL"];
    $Contacto = $row["Contacto"];
    $Descripcion = $row["Descripcion"];
    $Precio = $row["Precio"];
    $idTipoEvento = $row["idTipoEvento"];
    $HoraEvento = date("H:i", strtotime($row["HoraEvento"]));
    $FechaEvento = FechaDerecho($row["FechaEvento"]);
    $ImgAgenda = $row["ImgAgenda"];
    $DocAgenda = $row["DocAgenda"];
    $ImgArchivo = $row["ImgArchivo"];
    $ImgPath = $row["ImgPath"];
    $AnchoThumb = $row["AnchoThumb"];
    $AltoThumb = $row["AltoThumb"];
    $DocArchivo = $row["DocArchivo"];
    $DocPath = $row["DocPath"];
    mysqli_free_result($result);
    mysqli_close($link);

}


?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8" />
<meta http-equiv="CACHE-CONTROL" content="NO-CACHE" />
<title>Cervera de Pisuerga: El coraz&oacute;n de la Monta&ntilde;a Palentina</title>
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
function stopUpload(){
      //document.getElementById('barracargando').style.visibility = 'hidden';
      //document.getElementById('FormImage').style.visibility = 'visible';
	  	location.href="agenda-editar.php?idAgenda=<?php echo $idAgenda; ?>";
	  	return true;   
}
</script>
</head>

<body>
<div id="espere" style="display:none" >
  <div align="center"><img src="images/cargando.gif" alt="Enviando datos" width="32" height="32" /></div>
</div>
<?php if ($ErrorMsn != "") { ?>
<script type="text/javascript">
disDiv("contenido",true); 
</script>
<div id="error" style="display:" >
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
	<ul>
		<li><a href="inicio.php">Inicio</a></li>
		<li><a href="localizacion.php">Localizaci&oacute;n</a></li>
		<li><a href="que-ofrecemos.php">Qu&eacute; ofrecemos</a></li>
	  <li><a href="que-creamos.php">Qu&eacute; creamos</a></li>
		<li><a href="agenda.php" class="menuselect">Agenda</a></li>
        <li><a href="localidades.php">Localidades</a></li>
        <li><a href="noticias.php">Noticias</a></li>
        <li><a href="directorio.php">Directorio</a></li>
        <li><a href="administracion.php">Administraci&oacute;n</a></li>
	</ul>
</div>
<br clear="left" />
<div id="submenu">
</div>
<div id="opciones">
  <ul>
    <li class="liselect"><a title="A&ntilde;adir monumento" href="agenda-entrada.php">A&ntilde;adir entrada</a></li>
    <li><a title="Listado del monumentos"  href="agenda-listado.php">Listado</a></li>
  </ul>
</div>
<div class="separador">&nbsp;</div>
<div id="contenido"><div class="Fuentes"><img src="images/fuentemas.gif" onclick="AumentarFuente();" onmouseover="this.style.cursor='pointer';this.src='images/fuentemas-on.gif'" onmouseout="this.src='images/fuentemas.gif'" title="Aumentar el tama&ntilde;o de la  fuente de la pagina" alt="Aumentar el tama&ntilde;o de la  fuente de la pagina" width="32" height="32" longdesc="Aumentar el tama&ntilde;o de la  fuente de la pagina" /><img src="images/fuentemenos.gif" onclick="DisminuirFuente();" onmouseover="this.style.cursor='pointer';this.src='images/fuentemenos-on.gif'" onmouseout="this.src='images/fuentemenos.gif'" title="Disminuir el tama&ntilde;o de la  fuente de la pagina" alt="Disminuir el tama&ntilde;o de la  fuente de la pagina" width="32" height="32" longdesc="Disminuir el tama&ntilde;o de la  fuente de la pagina" /></div><form id="formEntrada" method="post" name="formEntrada" action="agenda-editar.php?idAgenda=<?php echo
$idAgenda; ?>&Mostrar=<?php echo
$Mostrar; ?>&Pagina=<?php echo
$Pagina; ?>&Buscar=<?php echo
$Buscar; ?>&idNucleoUrbano=<?php echo
$idNucleoUrbano; ?>" onsubmit="EnviarEntradaAgenda(this,'editar');return false;">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <caption align="top" class="labelinput">
    Editar Evento
    </caption>
    
    <tr>
      <td width="50" class="lateralizq">&nbsp;</td>
      <td width="131" class="labelinput">Evento</td>
      <td width="300"><input name="EVENTO" type="text" id="EVENTO" value="<?php echo
str_replace("\"", "&quot;", $Evento); ?>" size="50" maxlength="100" /></td>
      <td width="162" class="lateralizq">&nbsp;</td>
      <td class="labelinput">Dercripci&oacute;n detallada</td>
      <td width="50" class="lateralizq">&nbsp;</td>
    </tr>
    <tr>
      <td class="lateralizq">&nbsp;</td>
      <td class="labelinput">Lugar</td>
      <td><input name="LUGAR" type="text" id="LUGAR" value="<?php echo $Lugar; ?>" size="50" maxlength="50" /></td>
      <td class="lateralizq">&nbsp;</td>
      <td rowspan="12"><textarea name="DESCRIPCION" cols="50" rows="10" id="DESCRIPCION"><?php echo
$Descripcion; ?></textarea></td>
      <td class="lateralizq">&nbsp;</td>
    </tr>
    <tr>
      <td class="lateralizq">&nbsp;</td>
      <td class="labelinput">Poblaci&oacute;n</td>
      <td><?php
$link = ConnBDCervera();
$sql = "SELECT distinct idNucleoUrbano, NombreNucleoUrbano FROM NucleosUrbanos order by NombreNucleoUrbano";
echo CrearSelect("IDNUCLEOURBANO", "idNucleoUrbano", "NombreNucleoUrbano", $sql,
    $link, "", "", "", "", $idNucleoUrbano);
?> </td>
      <td class="lateralizq">&nbsp;</td>
      <td class="lateralizq">&nbsp;</td>
    </tr>
    
    <tr>
      <td class="lateralizq">&nbsp;</td>
      <td class="labelinput">Hora evento</td>
      <td><label>
        <input name="HORAEVENTO" type="text" id="HORAEVENTO" value="<?php echo $HoraEvento; ?>" size="5" maxlength="5" />
      (hh:mm)</label></td>
      <td class="lateralizq">&nbsp;</td>
      <td class="lateralizq">&nbsp;</td>
    </tr>
    <tr>
      <td class="lateralizq">&nbsp;</td>
      <td class="labelinput">Fecha evento</td>
      <td><input name="FECHAEVENTO" type="text" id="FECHAEVENTO" value="<?php echo
$FechaEvento; ?>" size="10" maxlength="10" />
        (dd/mm/aaaa)</td>
      <td class="lateralizq">&nbsp;</td>
      <td class="lateralizq">&nbsp;</td>
    </tr>
    <tr>
      <td class="lateralizq">&nbsp;</td>
      <td class="labelinput">Precio</td>
      <td><input name="PRECIO" type="text" id="PRECIO" value="<?php echo $Precio; ?>" maxlength="50" /></td>
      <td class="lateralizq">&nbsp;</td>
      <td class="lateralizq">&nbsp;</td>
    </tr>
    <tr>
      <td class="lateralizq">&nbsp;</td>
      <td class="labelinput">Tipo evento</td>
      <td><?php
$link = ConnBDCervera();
$sql = "SELECT distinct idTipoEvento, TipoEvento FROM TipoEvento order by Orden, TipoEvento ";
echo CrearSelect("IDTIPOEVENTO", "idTipoEvento", "TipoEvento", $sql, $link, "",
    "", "", "", $idTipoEvento);
?> </td>
      <td class="lateralizq">&nbsp;</td>
      <td class="lateralizq">&nbsp;</td>
    </tr>
    <tr>
      <td class="lateralizq">&nbsp;</td>
      <td class="labelinput">Telefono</td>
      <td><input name="TELEFONO" type="text" id="TELEFONO" value="<?php echo $Telefono; ?>" size="16" maxlength="16" /></td>
      <td class="lateralizq">&nbsp;</td>
      <td class="lateralizq">&nbsp;</td>
    </tr>
    <tr>
      <td class="lateralizq">&nbsp;</td>
      <td class="labelinput">Email</td>
      <td><input name="EMAIL" type="text" id="EMAIL" value="<?php echo $Email; ?>" size="40" maxlength="100" /></td>
      <td class="lateralizq">&nbsp;</td>
      <td class="lateralizq">&nbsp;</td>
    </tr>
    <tr>
      <td class="lateralizq">&nbsp;</td>
      <td class="labelinput">URL</td>
      <td><input name="URL" type="text" id="URL" value="<?php echo $URL; ?>" size="40" maxlength="255" /></td>
      <td class="lateralizq">&nbsp;</td>
      <td class="lateralizq">&nbsp;</td>
    </tr>
    <tr>
      <td class="lateralizq">&nbsp;</td>
      <td class="labelinput">Contacto</td>
      <td><input name="CONTACTO" type="text" id="CONTACTO" value="<?php echo $Contacto; ?>" size="50" /></td>
      <td class="lateralizq">&nbsp;</td>
      <td class="lateralizq">&nbsp;</td>
    </tr>
    <tr>
      <td class="lateralizq">&nbsp;</td>
      <td class="labelinput">&nbsp;</td>
      <td>&nbsp;</td>
      <td class="lateralizq">&nbsp;</td>
      <td class="lateralizq">&nbsp;</td>
    </tr>
    <tr>
      <td height="17" class="lateralizq">&nbsp;</td>
      <td class="labelinput">&nbsp;</td>
      <td>&nbsp;</td>
      <td class="lateralizq">&nbsp;</td>
    
      <td class="lateralizq">&nbsp;</td>
    </tr>
    
    <tr>
      <td class="lateralizq">&nbsp;</td>
      <td class="labelinput">&nbsp;</td>
      <td><label></label></td>
      <td class="lateralizq">&nbsp;</td>
  
      <td><input type="submit" name="ENVIAR" id="ENVIAR" value="Publicar evento" /><input type="button" name="VOLVER" id="VOLVER" value="Volver al listado" onclick="location.href='agenda-listado.php?Mostrar=<?php echo
$Mostrar; ?>&Pagina=<?php echo
$Pagina; ?>'"/></td>
       <td class="lateralizq">&nbsp;</td>
    </tr>
  </table>
</form>
<iframe src="" id="fileframe" name="fileframe" style="display:none"></iframe>
<form method="post" enctype="multipart/form-data" name="uploadform" target="fileframe" action="agenda-adjuntos.php">
<input type="hidden" name="IDAMBITO" value="<?php echo $idAgenda; ?>"/>
<input type="hidden" name="AMBITO" value="Agenda"/>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
 <caption align="top" class="labelinput">
 Adjuntar documentos al evento
 </caption>
 <tr>
    <td class="lateralizq">&nbsp;</td>
    <td valign="top" class="labelinput">Imagen</td>
    <td><input name="foto[]" type="file" size="80" /></td>
    <td class="lateralizq">&nbsp;</td>
  </tr>
  <tr>
    <td class="lateralizq">&nbsp;</td>
    <td valign="top" class="labelinput">&nbsp;</td>
    <td>
    <?php
if ($ImgAgenda > 0) {
    echo "<img src='../$ImgPath/$ImgArchivo' width ='$AnchoThumb' height='$AltoThumb'/>";
    echo "&nbsp;<a href='agenda-eliminar-imagen.php?idImagen=$ImgAgenda&idAgenda=$idAgenda&Archivo=$ImgArchivo' target='fileframe' class='EliminarImagen' >Eliminar imagen</a>";
}
?>   
    </td>
    <td class="lateralizq">&nbsp;</td>
  </tr>
  <tr>
    <td class="lateralizq">&nbsp;</td>
    <td valign="top" class="labelinput">Documento adjunto</td>
    <td><input name="documento[]" type="file" size="80" /></td>
    <td class="lateralizq">&nbsp;</td>
  </tr>
  <tr>
    <td class="lateralizq">&nbsp;</td>
    <td valign="top" class="labelinput">&nbsp;</td>
    <td>
	<?php
if ($DocAgenda > 0) {
    echo "Ver <a href='../$DocPath/$DocArchivo' target='_Blank' class='VerDoc' >$DocArchivo</a>";
    echo "&nbsp;<a href='agenda-eliminar-documento.php?idDocumento=$DocNoticia&idAgenda=$idAgenda&Archivo=$DocArchivo' target='fileframe' class='EliminarImagen' >Eliminar Archivo adjunto</a>";
}
?>
	<br />
	<br />   
    </td>
    <td class="lateralizq">&nbsp;</td>
  </tr>
  <tr>
    <td class="lateralizq">&nbsp;</td>
    <td valign="top" class="labelinput">&nbsp;</td>
    <td>&nbsp;</td>
    <td class="lateralizq">&nbsp;</td>
  </tr>
  <tr>
    <td class="lateralizq">&nbsp;</td>
    <td valign="top" class="labelinput">&nbsp;</td>
    <td><label>
      <input type="submit" name="BOTONDOCS" id="BOTONDOCS" value="Adjuntar documentos" />
      <input type="button" name="VOLVER2" id="VOLVER2" value="Volver al listado" onclick="location.href='noticias-listado.php?Mostrar=<?php echo
$Mostrar; ?>&amp;Pagina=<?php echo
$Pagina; ?>'"/>
      <input type="reset" name="BOTONRES" id="BOTONRES" value="Restablecer" />
    </label></td>
    <td class="lateralizq">&nbsp;</td>
  </tr>
</table>


</form>
</div>
<br clear="left" />
</body>
<?php if ($ErrorMsn != "") { ?>
<script type="text/javascript">
disDiv("contenido",true); 
</script>
<?php } ?>
</html>
