<?php   	
session_start();
include("includes/funciones.php");
include("includes/Conn.php");


//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
// Subservicios ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	
  $sqlSS = "SELECT DISTINCT SE. idServicio ,SE. NombreServicio , SB.idSubServicio, Sb.NombreSubServicio, SB.icono FROM SubServicios AS SB \n"
    . "INNER JOIN Servicios AS SE ON Sb.idServicio = SE. idServicio \n"
    . "ORDER BY SE.idServicio, NombreSubServicio\n";
echo $sqlSS;
	$link = ConnBDCervera();

						$resultSS = mysqli_query($link,$sqlSS);
			if (!$resultSS)
				{
				$message = "Invalid query".mysqli_error($link)."\n";
				$message .= "whole query: " .$sqlSS;	
				die($message);
				exit;
				}
			$max = mysqli_num_rows($resultSS);	
			if($max > 0){  
			echo "<div class=\"texto\">";
			$clasefila = "filagris";
				$ServicioAux = $rowSS["idServicio"];
				while ($rowSS = mysqli_fetch_array($resultSS, MYSQLI_ASSOC)) {
					
					if(($rowSS["idServicio"] != $ServicioAux) ){
						$ServicioAux = $rowSS["idServicio"];
						echo "<br/>";
						echo "<div>".$rowSS["idServicio"]. " " .$rowSS["NombreServicio"]."</div>";
						echo "<br/>";
					}
					
					
					echo $rowSS["idSubServicio"]. " " .$rowSS["NombreSubServicio"] ."<img src='../iconos/".$rowSS["icono"]."' border='0' alt='".$rowSS["NombreSubServicio"] ."'>";
				
				}
			echo "</div>";
			}
			mysqli_free_result($resultSS);
			mysqli_close($link);	
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
// Subservicios ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++	

?>