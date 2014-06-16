<?php
require_once '../modelo/servicio.php';
require_once '../modelo/usuario.php';
require_once 'op_base_datos_servicio.php';
session_start();
	
require_once '../controlador/comprobar_login_usuario_admin.php';
	
if (isset($_GET['id_servicio'])) {
	$BDDservice = new MysqlServicio();
	$id_servicio = $_GET['id_servicio'];
	$servicio = $BDDservice -> conseguirServicio($id_servicio);

	if (((isset($_SESSION['login_admin'])) && ($_SESSION['login_admin'] == true)) || (isset($servicio) && $servicio->getIdUsuario() == $_SESSION['usuario']->getId())) {
			
			if (isset($_REQUEST['nombreserv'])){
				$nombreserv=$_REQUEST['nombreserv'];	
			}else{
				$nombreserv=null;
			}
			if (isset($_REQUEST['descrpserv'])){
				$descrpserv=$_REQUEST['descrpserv'];	
			}else{
				$descrpserv=null;
			}
			if(isset($_FILES['foto'])){
				move_uploaded_file($_FILES['foto']['tmp_name'],"../vista/images/servicio/".$id_servicio.".png");
				$foto=$id_servicio.".png";
			}
			else{
				$foto=null;
			}
			$BDDservice->editarServicio($id_servicio,$nombreserv,$descrpserv,$foto);
			
			if ((isset($_SESSION['login_admin'])) && ($_SESSION['login_admin'] == true)) {
				header('location:../vista/serviciosadmin.php');
			} else {
				header("Location: ../vista/servicio.php?id_servicio=".$id_servicio);
			}
	}
}	