<?php
include("includes/Conn.php");
include("includes/variables.php");
include("includes/funciones.php");


$idBanner = $_GET["idBanner"];

if($ErrorMsn != ""){
	header("Content-Type: text/html;iso-8859-1");
	echo "Los siguientes campos est&aacute;n vacios o no contienen valores permitidos:<br/>";
	echo "<blockquote>";
	echo $ErrorMsn;
	echo "</blockquote>";
	exit;
}

if ($ErrorMsn == "" ){		
	
$link = ConnBDCervera();

$sql = " Select Banner from Banners where idBanner = $idBanner ";
$result = mysqli_query($link,$sql);

if (!$result)
	{
	$message = "Invalid query".mysqli_error($link)."\n";
	$message .= "whole query: " .$sql;	
	die($message);
	exit;
	}
$max = mysqli_num_rows($result);	
if($max > 0){
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
$Archivo = $row["Archivo"];
}
mysqli_free_result($result);
$sqlDel = " Delete From BannersGestion where idBanner = $idBanner ";
$result = mysqli_query($link,$sqlDel);
$sqlDel = " Delete From Banners where idBanner = $idBanner ";
$result = mysqli_query($link,$sqlDel);
mysqli_close($link);		
advancedRmdir("../Banners/$idBanner");

}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8" />
<title>Untitled Document</title>
</head>
<body>
	Eliminado Imagen...
	<script type="text/javascript">

		window.parent.opener.location.reload();self.close();

	</script>
</body>
</html>