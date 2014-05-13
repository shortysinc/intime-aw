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
		//Crea una salt al azar
		$random_salt = hash('sha512', uniqid(mt_rand(1, mt_getrandmax()), true));
		//Crea una contraseña en salt
		$password = hash('sha512', $pass.$random_salt);
		
		$row = $BDD->insertarUsuarioRegistro($correo, $nombre, $apellidos, $direccion, $pass, $random_salt);
		
		if($row){
			//insertar usuario en la sesion
			$_SESSION["login"] = true;
			header("Location: ../index.php");
		}else {
			$_SESSION["error"] = "El correo introducido ya existe.";
			$_SESSION["login"] = false;
			header('Location: ../vista/crear_cuenta.php');
		}
	}
?>

