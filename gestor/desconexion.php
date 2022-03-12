<?php 
session_start(); 
$_SESSION = array(); 
session_destroy(); 
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8" />
<meta http-equiv="CACHE-CONTROL" content="NO-CACHE" />
<title>Desconexión
</title>
<link rel="stylesheet" href="css/ppal.css" />
</head>
<script type="text/javascript">
window.onload = function(){location.href="index.php";}
</script>
<body>
</body>
</html>
