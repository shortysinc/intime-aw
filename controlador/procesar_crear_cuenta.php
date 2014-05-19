<?php 
	session_start();
	require_once '../controlador/opbasededatos.php';
	
	$nombre = $_POST["nombre"];
	$apellidos = $_POST["apellidos"];
	$direccion = $_POST["domicilio"]; 
	$correo = $_POST["email"];
	$pass = $_POST["pass"];
	$repass = $_POST["repass"];
	
	if(strcmp($pass, $repass) != 0){
		$_SESSION["error"] = "Las contraseñas no coinciden";
		header('Location: ../vista/crear_cuenta.php');
	}else {
		$BDD = new Mysql();
		$row = $BDD->insertarUsuarioRegistro($correo, $nombre, $apellidos, $direccion, $pass);
		
		if($row){
			//insertar usuario en la sesion
			$_SESSION["login"] = true;
			$_SESSION["mensaje"] = "Te has registrado con éxito";
			header("Location: ../vista/perfil_usuario.php");
		}else {
			$_SESSION["error"] = "El correo introducido ya existe.";
			$_SESSION["login"] = false;
			header('Location: ../vista/crear_cuenta.php');
		}
	}
?>

