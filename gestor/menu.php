<?php

use citcervera\Model\Connections\DB;
$db = new DB();


if(($_SESSION["TipoUsuario"]== "ADMIN") or ($_SESSION["TipoUsuario"]== "USERCIT")){
	$sql = " SELECT * FROM Menu ";
	$list = $db->query($sql,'fetch_object');
	if ($list)
	{
		?>
		<ul>
		<?php
		foreach($list as $item)
		{
		?>	
			<li><a href="<?= $item->pagina; ?>"><?= $item->Menu; ?></a></li>	
		<?php 
		} 
		?>
	</ul>
	<?php
	}
}
else
{	
	$sql = " select UA.Ambito, UA.Campo, UA.idAmbito, M.pagina, M.Menu from `UsuariosAcceso` as UA inner join `Menu` as M
on UA.idMenu = M.idMenu where idusuario = " . $_SESSION['idUsuario'];	
	$list = $db->query($sql,'fetch_object');
	
	if ($list)
	{
		?>
		<ul>
		<?php
		foreach($list as $item)
		{
			?>
			<li><a href="<?= $item->pagina; ?>"><?= $list->Menu; ?></a></li>
			<?php
		}?>
            </ul>
            <?php
	}
	else
	{
		// no hay acceso a ningun parte
		$_SESSION['Conexion'] = false;
		$_SESSION['idUsuario'] = 0; 
		$_SESSION['Usuario'] = ''; 
		$_SESSION['TipoUsuario'] = '';
	}
}
?>