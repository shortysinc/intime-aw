<?php
	session_start();
	require_once '../controlador/opbasededatos.php';
	$correo = $_POST["correo"];
	$pass = $_POST["pass"];
	$BDD = new Mysql();
	$BDD->loginuser($correo,$pass);
	if(isset($_SESSION["login"]) && $_SESSION["login"] == true){
		header('Location: ../vista/perfil_usuario.php');
	}else {
		header('Location: ../index.php');
	}
?>