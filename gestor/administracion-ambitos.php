<?php
		include("includes/Conn.php");	
		$Ambito = $_REQUEST["Ambito"] ?? '';
		$idAmbito = $_REQUEST["idAmbito"] ?? '';
		$idnucleourbano = $_REQUEST["IDNUCLEOURBANO"] ?? '';
		$respuesta = '';		
		$Ambitos = array('Directorio', 'Monumentos', 'Museos', 'Noticias', 'NucleosUrbanos', 'Rutas');

		if (in_array($Ambito, $Ambitos)){
			$link = ConnBDCervera();
			switch ($Ambito){
				case "Directorio":
							$sql = "select idDirectorio, NombreComercial from Directorio";
							break;
				case "Monumentos":
							$sql = "select idMonumento, Monumento from Monumentos";
							break;
				case "Museos":
							$sql = "select idMuseo, Museo from Museos";
							break;
				case "Noticias":
							$sql = "select idNoticia, Titulo from Noticias";
							break;
				case "NucleosUrbanos":
							$sql = "select idNucleoUrbano, NombreNucleoUrbano from NucleosUrbanos";
							break;
				case "Rutas":
							$sql = "select idRuta, Ruta from Rutas";
							break;
			}
			if ($idnucleourbano != ''){
				$sql .= " where idNucleoUrbano = " . $idnucleourbano;
			}

			$result = mysqli_query($link,$sql);
			$max = mysqli_num_rows($result);
			$respuesta = "";
			if (!$result)
				{
				$message = "Invalid query" . mysqli_error($link)."\n";
				$message .= "whole query: " . $sql;	
				die($sql . ' ' . $message);
				}
				if ($max > 0){
					$respuesta = "<select name=\"IDAMBITO\" size=\"8\" >";
					while ($row = mysqli_fetch_row($result))
						{
						if ($idAmbito == $row[0]){
							$respuesta = $respuesta . "<option value=\"$row[0]\" selected=\"true\">$row[1]</option>";
						}else{
							$respuesta = $respuesta . "<option value=\"$row[0]\" >$row[1]</option>";
						}
						}
					$respuesta = $respuesta . "</select>";
				}
			mysqli_free_result($result);
			mysqli_close($link);	
		}
//header('Content-Type: text/html; charset=UTF-8');
echo $respuesta;
?>