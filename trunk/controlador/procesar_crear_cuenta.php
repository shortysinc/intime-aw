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
		$error = $BDD->insertarUsuarioRegistro($correo, $nombre, $apellidos, $direccion, $pass);
		/*if($error === 0 ){
			//insertar usuario en la sesion
			$_SESSION["login"] = true;
			$_SESSION["mensaje"] = "Te has registrado con éxito";
			header("Location: ../vista/perfil_usuario.php");

		}else if($error == Mysql::ERR_DUP_KEY){//numero de error en caso de querer insertar una clave que ya exisite en la BDD
			$_SESSION["login"] = false;
			$_SESSION["error"] = "El correo que has introducido ya existe";
			header('Location: ../vista/crear_cuenta.php');
			
		}else {
			$_SESSION["login"] = false;
			$_SESSION["error"] = "Ha habido un error durante el proceso de crear la cuenta.";
			header('Location: ../vista/crear_cuenta.php');
			
		}*/
	}

