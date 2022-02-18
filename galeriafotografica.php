<?php
namespace citcervera;

include("includes/Conn.php");
include("includes/funciones.php");

const __FILESPATH__ = 'files/';
$_ROOTPATH = $_SERVER['DOCUMENT_ROOT'] . '/' .  __FILESPATH__;

use citcervera\Model\Managers\Manager;
use citcervera\Model\Connections\DB;
use citcervera\Model\Entities\Imagenes;
// datos de la entrada del directorio

$db = new DB();
$imageEntity = new Imagenes();
$imageManager = new Manager($imageEntity);


$MetaTitulo = '';
$idServicio = $_GET["idServicio"] ?? '';
$idSubServicio = $_GET["idSubServicio"] ?? '';
$Origen = $_GET["Origen"] ?? '';
$Campo = $_GET["Campo"] ?? '';
$Ambito = $_GET["Ambito"] ?? ''; 
$idAmbito = $_GET["idAmbito"] ?? ''; 
$Pagina = $_GET["Pagina"] ?? '';
if (!is_numeric($Pagina))$Pagina = 1;
$Mostrar = $_GET["Mostrar"] ?? '';
if (!is_numeric($Mostrar))$Mostrar = 3;


if(($Ambito != "Inicio") and ($Ambito != "Localizacion") and ($Ambito != "ComoLlegar") and ($Ambito != "Caza") and ($Ambito != "Pesca")){
	$sql = "Select * from $Ambito where $Campo = $idAmbito ";
}else{
	$sql = "Select * from $Ambito ";
}
$link = ConnBDCervera();
mysqli_query($link,'SET NAMES utf8');
   		$result = mysqli_query($link,$sql);
			if (!$result){
				$message = "Invalid query".mysqli_error($link)."\n";
				$message .= "whole query: " .$sql;	
				die($message);
				exit;
			}
			$max = mysqli_num_rows($result);	
	
			if($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
			switch($Ambito){
				
				case "Inicio":
				$MetaTitulo = "Galería fotográfica: Inicio";
				break;
				case "Localizacion":
				$MetaTitulo = "Galería fotográfica: Localizaci�n de Cervera de Pisuergqa";
				break;
				case "Monumentos":
				$MetaTitulo = "Galería fotográfica: ".	$row["Monumento"];
				break;
				case "Museos":
				$MetaTitulo = "Galería fotográfica: ".	$row["Museo"];
				break;
				case "ComoLlegar":
				$MetaTitulo = "Galería fotográfica: Como llegar a Cervera de Pisuerga";
				break;
				case "Rutas":
				$MetaTitulo = "Galería fotográfica: Ruta ".	$row["Ruta"];
				break;
				case "Flora":
				$MetaTitulo = "Galería fotográfica: ".	$row["NombreComun"];
				break;
				case "Setas":
				$MetaTitulo = "Galería fotográfica: ".	$row["NombreComun"];
				break;
				case "Fauna":
				$MetaTitulo = "Galería fotográfica: ".	$row["NombreComun"];
				break;
				case "Caza":
				$MetaTitulo = "Galería fotográfica: Caza en la Montaña palentina";
				break;
				case "Pesca":
				$MetaTitulo = "Galería fotográfica: Pesca en la Montaña Palentina";
				break;
				case "Agenda":
				$MetaTitulo = "Galería fotográfica: Agenda en la Montaña Palentina";
				break;
				case "NucleosUrbanos":
				$MetaTitulo = "Galería fotográfica: ".	$row["NombreNucleoUrbano"];
				break;
				case "Noticias":
				$Noticia = $row["Noticia"] ?? '';
				$MetaTitulo = "Galería fotográfica: ".	$Noticia;
				break;
				case "Directorio":
				$MetaTitulo = "Galería fotográfica: ".	$row["NombreComercial"];
				break;
			
			}
}

mysqli_free_result($result);
$MetaDescripcion = $MetaTitulo;
$MetaKeywords =  GenKeyWords($MetaDescripcion,3);

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
				<div class="MigasdePan">
					<?php 
					if ($Origen == "directorio-detalle.php"){
					?>
					<a href="<?php echo $Origen; ?>?<?php echo $Campo; ?>=<?php echo $idAmbito; ?>&amp;idServicio=<?php echo $idServicio; ?>&amp;idSubServicio=<?php echo $idSubServicio; ?>" title="<?php echo $Ambito; ?>"><?php echo $Ambito; ?></a>
					<?php
					}else{
					?>
						<a href="<?php echo $Origen; ?>?<?php echo $Campo; ?>=<?php echo $idAmbito; ?>" title="<?php echo $Ambito; ?>"><?php echo $Ambito; ?></a>
					<?php
					}
					?>
					&nbsp;>&nbsp;
					<a href="galeriafotografica.php?Ambito=<?php echo $Ambito; ?>&amp;idAmbito=<?php echo $idAmbito; ?>&amp;Origen=<?php echo $Origen; ?>&amp;Campo=<?php echo $Campo; ?>"  title="Galería fotográfica">Galería fotográfica</a>
				</div>			
			</div>
					
			<div class="fotogaleria">
			
				<?php
					$sql = "select * from Imagenes where Ambito = '$Ambito' and idAmbito = $idAmbito and Publicar = 1 ";
					$sql .= " order by Orden, idImagen ";	

					$list = $imageManager->Query($sql,'fetch_object', new Imagenes());
					foreach ($list as $imagen) {
						$fotolocation = $_ROOTPATH . $imagen->Path . "/" . $imagen->Archivo;
						if (file_exists($fotolocation)) {
						?>
						<div class="foto">
							<div class="fotopie"><span><?= $imagen->Pie ?></span></div>
							<div class="fototitulo"><span><?= $imagen->Titulo ?></span></div>
							<img src="../files/<?=$imagen->Path?>/<?=$imagen->Archivo?>"/>
						</div>
					<?php
						}
						
					}
				?>
			</div>
		<?php
		include("./sponsors.php");
		?>   
		</div>	          
		<?php
		include("./footer.php");
		?>     
	</div>



<script type="text/javascript">
var totalPages = <?=$numPags?>;
var p = <?=$Pagina?>;
var ps = <?=$Mostrar?>;
var idServicio = "<?=$idServicio?>";
var idSubServicio = "<?=$idSubServicio?>";
var Origen = "<?=$Origen?>";
var Campo = "<?=$Campo?>";
var Ambito = "<?=$Ambito?>";
var idAmbito = "<?=$idAmbito?>";

var bScrollAvailable = true;
$(function(){
    if( p == 1){
        getData(p);
        p++;
    }else{

    }
    function getData(p) {
        $.ajax({
            url: "api/getfotos.php?p=" + p + "&ps=" + ps + "&numPags=" + totalPages + "&idServicio=" + idServicio + "&idSubServicio=" + idSubServicio + "&Origen=" + Origen + "&Campo=" + Campo  + "&Ambito=" + Ambito  + "&idAmbito=" + idAmbito ,
            async: true,
            dataType: 'json',
            beforeSend:function () {
            }
        })
        .done(function (data) {
			jQuery.each(data, function(index, item) {
				var itemfoto = JSON.parse(item);
				
				var f = jQuery('<div/>', {
				class: 'foto',
				});
				if(itemfoto.Pie){
					jQuery('<div class="fotopie"><span>'+itemfoto.Pie+'</span></div>').appendTo(f);
				}
				if(itemfoto.Titulo){
					jQuery('<div class="fototitulo"><span>'+itemfoto.Titulo+'</span></div>').appendTo(f);
				}
				
				jQuery('<a href="'+itemfoto.Path + '/' + itemfoto.Archivo+'" target="_blank"><img src="../'+itemfoto.Path + '/' + itemfoto.Archivo+'"/></a>').appendTo(f);
				f.appendTo('.fotogaleria');	
				
		});
		
        }).complete(function() {
		   //$('.sponsor').scrollView();
		    bScrollAvailable = true; 
		    });
    }
    $(window).scroll(function() {

	    var limitDown = $('.sponsor').position();
	    $('#testsize').html(
		$(window).scrollTop() + ' | ' + 
		$(window).height() + ' | ' +
		$(document).height() + ' | ' +
		limitDown.top

	    );
        if(p <= totalPages){
            //if($(window).scrollTop() + $(window).height() + 100 >= $(document).height() ) {
			if($(window).scrollTop() + $(window).height() >= limitDown.top ){
              if(bScrollAvailable){
                bScrollAvailable = false;
                getData(p);
                p++;
               
              }
            }
        }
    });
});
$.fn.scrollView = function () {
  return this.each(function () {
    $('html, body').animate({
      scrollTop: $(this).offset().top
    }, 1000);
  });
}
</script>                
</body>
</html>