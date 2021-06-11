<?PHP
include("includes/Conn.php");
include("includes/funciones.php");

$MetaTitulo = "CEmail enviado. Montaña Palentina";
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
               <h3>Envío de correo electrónico</h3>

               </div>
               <div class="content">

			   <div class="museo">
               <div class="texto">
  <p>El correo electrónico ha sido enviado correctamente.</p>
  <p>Muchas gracias por usar los servicio del CIT de Cervera de Pisuerga.</p>
</div>
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




