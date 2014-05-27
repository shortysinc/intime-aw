<?php
 
$id = $_GET['id'];
 
$enlace = mysqli_connect('localhost', 'root', '', 'intime');

$query = "DELETE FROM usuario WHERE id_usuario = '$id'";
mysqli_query($enlace, $query);
header('location:../vista/usuariosadmin.php'); 

?>