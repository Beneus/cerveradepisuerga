<?php
if(! $_SESSION["Conexion"]){
		header("Location:login.php?$origen?$query");
		exit;	
}

else if(($_SESSION["TipoUsuario"]!= "ADMIN") AND ($_SESSION["TipoUsuario"]!= "USERCIT")){
	
$sql = " select UA.Ambito, UA.Campo, UA.idAmbito, M.pagina,M.idMenu, M.Menu from `UsuariosAcceso` as UA inner join `Menu` as M
on UA.idMenu = M.idMenu where idusuario = ' ".$_SESSION["idUsuario"] ."' ";
		$link = ConnBDCervera();
			$result = mysqli_query($link,$sql);
			$max = mysqli_num_rows($result);
			$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
			if ($max){
				?>
               
				<ul>
                <?php
				while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
					
					?>
					<li><a href="<?php echo $row["NombreComercial"]; ?>"><?php echo $row["Menu"]; ?></a></li>
                    <?php
				}
				?>
                </ul>
				
                <?php	
			}else{
				header("Location:login.php");
						exit;	
			}
}
?>

		