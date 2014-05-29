<?php 
	session_start();
	require_once '../controlador/op_base_datos_usuario.php';
	require_once '../modelo/usuario.php';
	
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
		$BDD = new MysqlUsuario();
		$error = $BDD->insertarUsuarioRegistro($correo, $nombre, $apellidos, $direccion, $pass);
		if($error === 0 ){ //Si no ha habido ningún error
			//insertar usuario en la sesion
			if(isset($_SESSION)){
				session_destroy();
				session_start();
			}
			$_SESSION["login_usuario"] = true;
			$resultado = $BDD->loginuser($correo, $pass);
			$usuario = new Usuario($resultado['id_usuario'] ,$resultado['correo'], $resultado['nombre'], $resultado['apellidos'],
				$resultado['direccion'], $resultado['horas_usuario'], $resultado['foto'], $resultado['pass'], $resultado['salt']);
				
			$_SESSION['usuario'] = $usuario;
			
			header("Location: ../vista/perfil_usuario.php");

		}else if($error == Mysql::ERR_DUP_KEY){//numero de error en caso de querer insertar una clave que ya exisite en la BDD
			$_SESSION["login_usuario"] = false;
			$_SESSION["error"] = "El correo que has introducido ya existe";
			header('Location: ../vista/crear_cuenta.php');
			
		}else {
			$_SESSION["login_usuario"] = false;
			$_SESSION["error"] = "Ha habido un error durante el proceso de crear la cuenta.";
			header('Location: ../vista/crear_cuenta.php');
			
		}
	}

