<?php
require_once '../modelo/usuario.php';
require_once 'op_base_datos_respuesta.php';
session_start();

require_once "comprobar_login.php";

if(isset($_POST['respuesta'], $_SESSION['id_solicitud'])){
	$BDD = new MysqlRespuesta();
	$usuario = $_SESSION['usuario'];
	$respuesta = $_POST['respuesta'];
	
	$error = $BDD->insertarRespuesta($usuario->getId(), $_SESSION['id_solicitud'], $_POST['respuesta']);
	if($error > 0){
		$_SESSION['error'] = "Ha ocurrido un error al enviar la respuesta";
	}else {
		$_SESSION['mensaje'] = "Su respuesta ha sido enviada con éxito";
	}
	
	unset($_SESSION['id_solicitud']);
	
}else {
	$_SESSION['error'] = "Ha ocurrido un error al enviar la respuesta";
}

header('Location: ../vista/solicitudes.php');
