<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
</head>

<body>
<?php
function selfURL() { $s = empty($_SERVER["HTTPS"]) ? '' : ($_SERVER["HTTPS"] == "on") ? "s" : ""; $protocol = strleft(strtolower($_SERVER["SERVER_PROTOCOL"]), "/").$s; $port = ($_SERVER["SERVER_PORT"] == "80") ? "" : (":".$_SERVER["SERVER_PORT"]); return $protocol."://".$_SERVER['SERVER_NAME'].$port.$_SERVER['REQUEST_URI']; } function strleft($s1, $s2) { return substr($s1, 0, strpos($s1, $s2)); }


print(selfURL()); 

$sql = " SELECT BNS.*,GBN.* FROM Banners as BNS inner join BannersGestion as GBN on BNS.idBanner = GBN.idBanner where 1 = 1 "
. " and Publicar = 1 "
. " and Pagina = '" .selfURL() . "' "
. " and FechaInicio < '".Date("Y-m-d")."' "
. " and FechaFin > '".Date("Y-m-d")."' "
. " order by GBN.Orden ";

echo $sql;
?>
</body>
</html>