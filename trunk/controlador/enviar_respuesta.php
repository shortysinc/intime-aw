<?php
require_once '../modelo/usuario.php';
require_once 'op_base_datos_respuesta.php';
require_once 'op_base_datos_usuario.php';

session_start();

require_once "comprobar_login.php";

if (isset($_POST['respuesta'], $_GET['id_solicitud'])) {
	$BDD = new MysqlRespuesta();
	$BDDUsuario = new MysqlUsuario();
	$usuario = $_SESSION['usuario'];
	$respuesta = $_POST['respuesta'];

	$solicitud = $BDDUsuario -> conseguirSolicitudPorId($_GET['id_solicitud']);
	//Si es una solicitude que está pendiente
	if ($solicitud -> getEstado() == 0) {
		//La inserto
		$error = $BDD -> insertarRespuesta($usuario -> getId(), $_GET['id_solicitud'], $_POST['respuesta']);

		if ($error > 0) {
			$_SESSION['error'] = "Ha ocurrido un error al enviar la respuesta";
		} else {
			$_SESSION['mensaje'] = "Su respuesta ha sido enviada con éxito";
		}
	}else{
		$_SESSION['error'] = "Ya no se puede enviar la respuesta";
	}

} else {
	$_SESSION['error'] = "Ha ocurrido un error al enviar la respuesta";
}

header('Location: ../vista/solicitudes.php');
