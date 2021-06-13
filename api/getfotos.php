<?php
include("../includes/Conn.php");
include("../includes/funciones.php");


$link = ConnBDCervera();

$idServicio = $_GET["idServicio"] ?? '';
$idSubServicio = $_GET["idSubServicio"] ?? '';
$Origen = $_GET["Origen"] ?? '';
$Campo = $_GET["Campo"] ?? '';
$Ambito = $_GET["Ambito"] ?? ''; 
$idAmbito = $_GET["idAmbito"] ?? ''; 
$Pagina = intval($_GET["p"] ?? '');
if (!is_numeric($Pagina))$Pagina = 1;
$Mostrar = intval($_GET["ps"] ?? '');
if (!is_numeric($Mostrar))$Mostrar = 10;

$sql = "select * from Imagenes where Ambito = '$Ambito' and idAmbito = $idAmbito and Publicar = 1 ";
$sql .= " order by Orden, idImagen ";
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
     $NumTotalRegistros = mysqli_num_rows($result);
     //calculo el total de páginas
     $numPags=ceil($NumTotalRegistros/$Mostrar);
     $sigMostrar = $Mostrar;
     $sql = $sql . " LIMIT ". ((($Pagina * $Mostrar) - $Mostrar) ) .",". (( $Mostrar) );
     $result = mysqli_query($link,$sql);
     $max = mysqli_num_rows($result);
     $ret = [];	
     if($max > 0){

          while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
               { 
                    if($row)
                    {
                         $filename = '../'.$row['Path'] . '/'. $row['Archivo'];
                         if(file_exists($filename))
                         {
                              $ret[] = json_encode($row);
                         }
                              
                    }
               }
     }
mysqli_free_result($result);
mysqli_close($link);	

echo(json_encode($ret));

?>