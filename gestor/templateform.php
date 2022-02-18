
<?php
include("includes/Conn.php");
include("includes/variables.php");
include("includes/funciones.php");

use citcervera\Model\Managers\DataCarrier;
use citcervera\Model\Managers\Manager;


$dc = new DataCarrier();
//$nucleosUrbanosManager = new Manager();


$ErrorMsg = '';
$Evento = '';
$Lugar = '';
$idNucleoUrbano = '';
$Telefono = '';
$Email = '';
$URL = '';
$Contacto = '';
$Precio = '';
$idTipoEvento = '';
$ErrorMsn = '';
$HoraEvento = '';
$FechaEvento = '';
$mostrar = $_GET["mostrar"] ?? '';
$pagina = $_GET["pagina"] ?? '';

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    /*
	$Agenda->_POST();
	if ($Agenda->Evento == "") {
		$ErrorMsg = "<span class=\"errortexto\">Evento.</span><br/>";
	}
	if ($Agenda->idTipoEvento != "17") { // fiestas oficiales
		if ($Agenda->Lugar == "") {
			$ErrorMsg .= "<span class=\"errortexto\">Lugar.</span><br/>";
		}
	}
	if (is_null($Agenda->FechaEvento)) {
		$ErrorMsg .= "<span class=\"errortexto\">Fecha del evento.</a><br/>";
	}

	if ($ErrorMsg == "") {
		$Agenda->Fecha = date("Y-m-d H:m:s");
		$agendaManager->Save($Agenda);
		$lastInsertedId = $agendaManager->GetLastInsertedId();

		if ($lastInsertedId) {
			$idAgenda->idAgenda = $lastInsertedId;
			$dc->Set($agendaManager->Get($lastInsertedId), 'Agenda');
		}
	} else {
		$ErrorMsn = "Los siguientes campos est&aacute;n vacios o no contienen valores permitidos:<br/>";
		$ErrorMsn .= "<blockquote>";
		$ErrorMsn .= $ErrorMsg;
		$ErrorMsn .= "</blockquote>";
	}
    */
}

if ($_SERVER['REQUEST_METHOD'] == "GET") {
    /*
	if (isset($_GET['idAgenda'])) {
		$agendaManager->Get($_GET['idAgenda']);
	}
    */
}


?>
