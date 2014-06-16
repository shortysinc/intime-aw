<?php
 session_start();

require_once '../controlador/comprobar_login_usuario_admin.php';

 if ((isset($_SESSION['login_admin'])) && ($_SESSION['login_admin'] == true)){
	$id = $_GET['id'];
	
	$enlace = mysqli_connect('localhost', 'root', '', 'intime');
	
	$query = "DELETE FROM servicio WHERE id_servicio = '$id'";
	mysqli_query($enlace, $query);
	header('location:../vista/serviciosadmin.php');
}
 ?>
 