<?php
require_once 'op_base_datos_servicio.php';
require_once '../modelo/usuario.php';
require_once '../modelo/servicio.php';
session_start();

require_once '../controlador/comprobar_login.php';

if(isset($_GET['id_servicio'])){
	$id_servicio = $_GET['id_servicio'];
	$BDD = new MysqlServicio();
	$favoritos = $BDD->conseguirServiciosFavoritos($_SESSION['usuario']->getId());
	$servicio = $BDD->conseguirServicio($_GET['id_servicio']);
	//Si el servicio está en favoritos y si el usuario que lo quiere quitar es distinto del usuario del servicio
	if(Servicio::estaDentro($servicio->getIdServicio(), $favoritos) && $servicio->getIdUsuario() != $_SESSION['usuario']->getId()){
		$BDD->eliminarServicioFavorito($id_servicio);
	}
	header('Location: ../vista/favoritos.php');
}
?>