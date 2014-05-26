<?php
 
$id = $_GET['id'];
 
$enlace = mysqli_connect('localhost', 'root', '', 'intime');

$query = "DELETE FROM servicio WHERE id_servicio = '$id'";
mysqli_query($enlace, $query);
header('location:../vista/serviciosadmin.php');
 ?>
 