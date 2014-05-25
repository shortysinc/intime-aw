<?php
	session_start();
	require_once '../controlador/opbasededatos.php';
	require_once '../modelo/usuario.php';
	require_once '../modelo/admin.php';
	
	$correo = $_POST["correo"];
	$pass = $_POST["pass"];
	$BDD = new Mysql();
	$resultadoAdmin = $BDD->loginuser($correo,$pass);
	
	if(isset($resultadoAdmin)){
		$_SESSION['login_usuario'] = true;
		
		$usuario = new Usuario($resultadoAdmin['id_usuario'] ,$resultadoAdmin['correo'], $resultadoAdmin['nombre'], $resultadoAdmin['apellidos'],
				$resultadoAdmin['direccion'], $resultadoAdmin['horas_usuario'], $resultadoAdmin['foto'], $resultadoAdmin['pass'], $resultadoAdmin['salt']);
		$_SESSION['usuario'] = $usuario;
		
		//echo $_SESSION['usuario']->getNombre();
		header('Location: ../vista/perfil_usuario.php');
		
 	}else{
 		$resultadoAdmin = $BDD->loginAdmin($correo, $pass);
		if(isset($resultadoAdmin)){
			$_SESSION['login_admin'] = true;
			$admin = new Admin($resultadoAdmin['id'], $resultadoAdmin['correo'], $resultadoAdmin['pass'], $resultadoAdmin['salt']);
			$_SESSION['admin'] = $admin;
			header('Location: ../vista/perfil_admin.php');
		}else {
			$_SESSION['error'] = "Usuario o contraseña incorrectos";
 			header('Location: ../index.php');
		}
	}
?>