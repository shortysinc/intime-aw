<?php 
	require_once 'op_base_datos_usuario.php';
	require_once '../modelo/usuario.php';
	require_once '../modelo/servicio.php';
	require_once '../controlador/op_base_datos_servicio.php';
	session_start();
	$id_servicio = $_GET['id_servicio'];
	$login = $_SESSION['usuario'];
	$peticion = $_POST['solicitud'];
	$BDD = new MysqlUsuario();
	$BDD->crearsolicitud($login->getId(),$id_servicio,$peticion);
	header ("location: ../vista/solicitudes.php");
