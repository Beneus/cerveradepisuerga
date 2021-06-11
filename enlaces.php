<?php
include("includes/Conn.php");
include("includes/funciones.php");

$MetaTitulo = "Cervera de Pisuerga en la Montaña Palentina";
$MetaDescripcion = "Cervera de Pisuerga, en El corazón de la Montaña Palentina. Cervera de Pisuerga, Palencia y de la región de Castilla y León";
$MetaKeywords =  "Cervera de Pisuerga, Montaña Palentina, Cervera de Pisuerga, Palencia, Castilla y Leónrural, turísmo, naturaleza virgen, arte, historia, turimo rural";

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
               <h1>Enlaces recomendados</h1>
   <div class="MigasdePan"><a href="index.php" title="inicio">inicio</a> &gt; 
<a href="enlaces.php" title="Accesibilidad">Enlaces </a>
	               </div>
               </div>
               <div class="content">

 				<div class="museo">
				 <?php
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
$link = ConnBDCervera();
$sql = "SELECT * From Enlaces order by TextoEnlace ";
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
?>
<ul>
<?php
while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
$UrlEnlace = $row["UrlEnlace"];
$TextoEnlace =  $row["TextoEnlace"];
$Descripcion = html_entity_decode($row["Descripcion"]);	
?>
<li><a href="<?php echo $UrlEnlace;?>" title="<?php echo $TextoEnlace;?>"><?php echo $TextoEnlace;?></a>
<?php
if ($Descripcion != ""){
	
echo "<blockquote>". $Descripcion . "</blockquote>";
	
}
?>
</li>
<?php
}
?>
</ul>
<?php
}else{
	// No hay entradas en el directorio
?>
<div class="errortexto">No hay enlaces</div>

<?php
}
mysqli_free_result($result);
mysqli_close($link);	
?>
              
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




