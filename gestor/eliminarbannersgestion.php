<?php
include("includes/Conn.php");
include("includes/variables.php");
include("includes/funciones.php");


$idBannersGestion = $_GET["idBannersGestion"];

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
$sqlDel = " Delete From BannersGestion where idBannersGestion = $idBannersGestion ";
$result = mysqli_query($link,$sqlDel);
mysqli_close($link);		

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