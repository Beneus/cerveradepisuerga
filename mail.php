<?PHP
include("includes/Conn.php");
include("includes/funciones.php");

$Nombre = "";
$Email = "";
$Subject = "";
$Body = "";
$ErrorMsg = '';
$Ambito = $_GET["Ambito"] ?? '';
$idAmbito = $_GET["idAmbito"] ?? '';
$Campo = $_GET["Campo"] ?? '';
$Att = $_GET["Att"] ?? '';


if ($_SERVER['REQUEST_METHOD']== "POST"){

$idAmbito = $_POST["IDAMBITO"] ?? '';
$Ambito = $_POST["AMBITO"] ?? '';
$Campo = $_POST["CAMPO"] ?? '';
$Nombre = $_POST["NOMBRE"] ?? '';
$Email = $_POST["EMAIL"] ?? '';
$Subject = $_POST["SUBJECT"] ?? '';
$Body = $_POST["BODY"] ?? '';


if ($Nombre == "" ){
	$ErrorMsg = "<span class=\"errortexto\">Nombre.</a><br/>";
	
}
if (!isEmail($Email)){
	$ErrorMsg .= "<span class=\"errortexto\">Email.</a><br/>";

}
if ($Subject == "" ){
	$ErrorMsg .= "<span class=\"errortexto\">Asunto.</a><br/>";

}
if ($Body == "" ){
	$ErrorMsg .= "<span class=\"errortexto\">Cuerpo.</a><br/>";

}


if ($ErrorMsg == "" ){	
	
$Correo = '<html><head><meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" /><style type="text/css"><!--body {margin: 0px;padding: 0px;font-family: Arial, Helvetica, sans-serif;font-size: 90%;background-color: #448040;background-image: url(../fondos/calendario.jpg);background-attachment:fixed;background-repeat: no-repeat;	background-position: left top;}.texto {border: 1px solid #999999;padding: 10px;margin-top: 10px;margin-right: 10px;margin-left: 10px;text-align: justify;height: auto;float: left;	width: 680px;background-color: #FFFFE1;}--></style></head><body><div class="cab"><img src="http://www.cerveradepisuerga.eu/images/cab2.gif" width="624" height="103" /><img src="http://www.cerveradepisuerga.eu/images/logo.gif" width="98" height="103" /></div><div class="texto"><ul><li>Correo enviado por:<p>'.$Nombre.'</p></li><li>Correo Electronico:<p>'.$Email.'</p></li><li>Asunto: <p>'.$Subject.'</p></li><li>Cuerpo: <p>'.$Body.'</p></li></ul></div><div id="MP"><img src="images/montanapalentinalateral.png" title="Cervera de Pisuerga: El coraz�n de la Monta�a Palentina" alt="Cervera de Pisuerga: El coraz�n de la Monta�a Palentina" width="160" height="627" /></div>
</body></html>';
			if ($Ambito != ""){
			$sql = "select Email from $Ambito where $Campo = $idAmbito Limit 1";
			$link = ConnBDCervera();
   		$result = mysqli_query($link,$sql);
			if (!$result){
				$to = "info@cerveradepisuerga.eu";
			}else{
				$max = mysqli_num_rows($result);
				$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
				if(($max > 0) and (isEmail($row["Email"]))){
					$to = $row["Email"];
				}else{
					$to = "info@cerveradepisuerga.eu";
				}
			}
			mysqli_free_result($result);
			mysqli_close($link);	
			}else{
				$to = "info@cerveradepisuerga.eu";
			}
		//$from_header = "CIT Cervera de Pisuerga <info@cerveradepisuerga.eu>";
		//$Body = wordwrap($Body, 70);
		$from_header = 'From: CIT Cervera de Pisuerga <info@cerveradepisuerga.eu>';
		$from_header .= 'MIME-Version: 1.0' . "\r\n";
		$from_header .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	 //send mail - $subject & $contents come from surfer input
	 

   mail($to, $Subject, $Correo, $from_header);
   // redirect back to url visitor came from
   header("Location: mail-enviado.php");
	
}else{
		// devolvemos el error
		 $ErrorMsn = "Los siguientes campos están vacios o no contienen valores permitidos:<br/>";
		 $ErrorMsn .= "<blockquote>";
		 $ErrorMsn .= $ErrorMsg;
		 $ErrorMsn .= "</blockquote>";
	}
}

if (($Att != "") and ($Ambito != "")){
$sql = "select $Att from $Ambito where $Campo = $idAmbito Limit 1";
$link = ConnBDCervera();
$result = mysqli_query($link,$sql);
if (!$result){
	$NAtt = "CIT Cervera de Pisuerga";
}else{
	$max = mysqli_num_rows($result);
	$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
	if($max > 0) {
		$NAtt = $row[$Att];
	}else{
		$NAtt = "CIT Cervera de Pisuerga";
	}
}
mysqli_free_result($result);
mysqli_close($link);	
}else{
	$NAtt = "CIT Cervera de Pisuerga";
}


$MetaTitulo = "Cervera de Pisuerga: contacta con $NAtt";
$MetaDescripcion = GetDescription($MetaTitulo,200);
$MetaKeywords = GenKeyWords($MetaDescripcion,4);


?>

<!DOCTYPE html>
<html>
     <head>
<?php
include('./head.php');
?>        
     </head>
<body>
<div class="wrapper">
     <?php
     include('./header.php');
     include("./menu.php");
     ?>
     <div class="grid container">
          <?php
          include('./aside1.php');
          include('./aside2.php');
          ?>
               
          <div class="main">     
               <div class="content">
               <h1>Contactar con:<br/> <?php echo $NAtt;?></h1>
<div class="MigasdePan">
	<a href="index.php" title="inicio">inicio</a> &gt;
	<a title="Envío email a <?php echo $NAtt;?>" href="mail.php?idAmbito=<?php echo $idAmbito ?>&amp;Ambito=<?php echo $Ambito ?>&amp;Campo=<?php echo $Campo ?>&amp;Att=<?php echo $Att ?>">Envío de correo electrónico a <?php echo $NAtt;?></a>
	               </div>
               </div>
               <div class="content">

			   <div class="museo">
   <form id="formMail" name="formMail" method="post" action="mail.php">
   <input name="IDAMBITO" type="hidden" value="<?php echo $idAmbito; ?>" />
   <input name="AMBITO" type="hidden" value="<?php echo $Ambito; ?>" />
    <input name="CAMPO" type="hidden" value="<?php echo $Campo; ?>" />
   <label for="NOMBRE" accesskey="N">Nombre:<br />

     <input name="NOMBRE" type="text" class="MailNombre" id="NOMBRE" placeholder="Nombre" value="<?php echo $Nombre; ?>" size="50" />
     </label><br />
     <label for="EMAIL" accesskey="E">Email:<br />

     <input name="EMAIL" type="text" class="MailEmail" id="EMAIL" placeholder="tucorreo@email.com" value="<?php echo $Email; ?>" size="50" />
     </label><br />
     <label for="SUBJECT" accesskey="S">
     Asunto:
     <textarea name="SUBJECT" id="SUBJECT" cols="67" rows="3" placeholder="asunto" class="MailSubject"><?php echo $Subject; ?></textarea>
     </label>
         <br />
         <label for="BODY" accesskey="C">Cuerpo:
         <textarea name="BODY" cols="67" rows="10" placeholder="Contenido del email" class="MailBody" id="BODY"><?php echo $Body; ?></textarea>
         </label>
         <br />
         <label for="ENVIAR">
         <input type="submit" name="ENVIAR" id="ENVIAR" value="Enviar Correo" class="MailSubmit" />
         </label>
   </form>
   </div>

              </div>

          <?php
          include("./sponsors.php");
          ?>         
          </div>
          <?php
          include("./footer.php");
          ?>
     </div>
</div>    
</body>
</html>




