<?php
if(!isset($_SESSION["login_usuario"]) || $_SESSION["login_usuario"] == false){
		$_SESSION["mensaje"] = "Tienes que iniciar sesión";
		header('Location: ../index.php');
	}