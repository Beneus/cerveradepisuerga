<?php



use citcervera\Model\Entities\Menu;
use citcervera\Model\Entities\SubMenu;
use citcervera\Model\Managers\Manager;

$menuEntity = new Menu();
$menuManager = new Manager($menuEntity);
$subMenuEntity = new SubMenu();
$subMenuManager = new Manager($subMenuEntity);



$sql = 'select idMenu, Menu, pagina from Menu';

	$list = $menuManager->Query($sql,'fetch_object', $menuEntity);

$idMenu = '';
$strSubMenu = '';

$sql = "select idMenu from `Menu` where pagina = '" . curPageName() ."' ";
$list = $menuManager->Query($sql,'fetch_object', $menuEntity);

if($list)
{
	$idMenu = $list[0]->idMenu;
}

$strPage = explode("-", curPageName());
$sql = "select idMenu, idSubMenu from `SubMenu` where pagina like '" . $strPage[0] . "%'";
$list = $subMenuManager->Query($sql,'fetch_object', $subMenuEntity);

if ($list)
{
	$idMenu = $list[0]->idMenu;
	$idSubMenu = $list[0]->idSubMenu;
}

$origen = "http://".$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];
$query = $_SERVER["QUERY_STRING"]; 

if(! $_SESSION["Conexion"])
{
	session_unset();
	session_destroy();
	header("Location:login.php?$origen?$query");
	exit;	
}else if(time() < $_SESSION['Expire']){
	$_SESSION['Expire'] = time()  + (600);
}
else{
	session_unset();
	session_destroy();
	header("Location:login.php?$origen?$query");
	exit;
}

if(($_SESSION["TipoUsuario"]!= "ADMIN") AND ($_SESSION["TipoUsuario"]!= "USERCIT"))
{
	
	$sql = " select M.pagina, M.Menu from `UsuariosAcceso` as UA inner join `Menu` as M on UA.idMenu = M.idMenu "
." where idusuario = ' ".$_SESSION["idUsuario"] ."' group by M.pagina, M.Menu order by M.idMenu ";
	$list = $menuManager->Query($sql,'fetch_object', $menuEntity);
	if ($list)
	{
		$strMenu = "<ul>";
		foreach ($list as $item)
		{
			$strMenu .= "<li class=\"has-children\">dddd<a href=\"" . $item->pagina ."\">" .$item->Menu."</a></li>";
		}
		$strMenu .= "</ul>";   	
	}
	else
	{
		header("Location:login.php?$origen?$query");
		exit;	
	}
	if($idMenu != "")
	{
		$sql = "select SM.idSubMenu, SM.SubMenu, SM.pagina from `SubMenu` as SM "
		." inner join UsuariosAcceso as UA on SM.idSubMenu = UA.idSubMenu "
		." where SM.idMenu = ". $idMenu ." and UA.idUsuario = ' ".$_SESSION["idUsuario"] ."' order by SM.idSubMenu";
		$list = $subMenuManager->Query($sql,'fetch_object', $subMenuEntity);
		if ($list){
			$strSubMenu = "<ul>";
			foreach ($list as $item)
			{
				$strSubMenu .= "<li><a href=\"" . $item->pagina ."\">" .$item->SubMenu."</a></li>";       
			}
			$strSubMenu .= "</ul>";	
		}
	}	
}
else
{
	$sql = " select idMenu, Menu, pagina from `Menu` order by idMenu ";
	$list = $menuManager->Query($sql,'fetch_object', $menuEntity);
	if ($list){
		$strMenu = "<ul>";
		foreach ($list as $item)
		{	
			if($item->idMenu == 4)continue;
			if($idMenu == $item->idMenu)
			{
				$strMenu .= "<li class=\"has-children\"><a href=\"" . $item->pagina ."\">" .$item->Menu ."</a>";	
				$strMenu .= GetSubMenu($item->idMenu);
				$strMenu .= "</li>";     
			}
			else
			{
				$strMenu .= "<li class=\"has-children\"><a href=\"" . $item->pagina ."\">" .$item->Menu ."</a>";
				$strMenu .= GetSubMenu($item->idMenu);
				$strMenu .= "</li>";     
			}
		}
				$strMenu .= "<li><a href=\"desconexion.php\">desconexion</a></li>";     
		$strMenu .= "</ul>";	
	}
	else
	{
		session_unset();
		session_destroy();
		header("Location:login.php?$origen?$query");
		exit;	
	}	
	if($idMenu != "")
	{
		$sql = "select * from `SubMenu` where idMenu = ". $idMenu ." order by idSubMenu ";
		$list = $subMenuManager->Query($sql,'fetch_object', $subMenuEntity);
		if($list)
		{
			$strSubMenu = "<ul>";
			foreach ($list as $item)
			{
				$strSubMenu .= "<li><a href=\"" . $item->pagina . "\">" . $item->SubMenu . "</a></li>";       
			}
			$strSubMenu .= "</ul>";	
		}		
	}
}




function GetSubMenu($idMenu)
{
	$strSubMenu = '';
	$subMenuEntity = new SubMenu();
	$subMenuManager = new Manager($subMenuEntity);
	if($idMenu != "")
	{
		$sql = "select * from `SubMenu` where idMenu = ". $idMenu ." order by idSubMenu ";
		$list = $subMenuManager->Query($sql,'fetch_object', $subMenuEntity);
		if($list)
		{
			$strSubMenu = "<ul>";
			foreach ($list as $item)
			{
				$strSubMenu .= "<li><a class=\"areas\" href=\"" . $item->pagina . "\">" . $item->SubMenu . "</a></li>";       
			}
			$strSubMenu .= "</ul>";	
		}		
	}
	return $strSubMenu;
}

function curPageName() 
{
	return substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1);
}

//echo '<h1>'.  ($_SESSION['Expire'] - time()) .'</h1>';
?>