<?php
	session_start();
	require_once '../controlador/opbasededatos.php';
	require_once '../modelo/usuario.php';
	$correo = $_POST["correo"];
	$pass = $_POST["pass"];
	$BDD = new Mysql();
	$resultado = $BDD->loginuser($correo,$pass);
	
	if(isset($resultado)){
		$_SESSION["login_usuario"] = true;
		
		$usuario = new Usuario($resultado['id_usuario'] ,$resultado['correo'], $resultado['nombre'], $resultado['apellidos'],
				$resultado['direccion'], $resultado['horas_usuario'], $resultado['foto'], $resultado['pass'], $resultado['salt']);
		$_SESSION['usuario'] = $usuario;
		
		$_SESSION['usuario']->getCorreo();
		//echo $_SESSION['usuario']->getNombre();
		header('Location: ../vista/perfil_usuario.php');
		
 	}else{
 		$_SESSION['error'] = "Usuario o contraseña incorrectos";
 		header('Location: ../index.php');
		
	}
?>