<?php 
	require_once '../controlador/op_base_datos_usuario.php';
	require_once '../controlador/op_base_datos_servicio.php';
	require_once '../modelo/usuario.php';
	require_once '../modelo/servicio.php';
	require_once '../modelo/solicitud.php';
	session_start();
	
	require_once '../controlador/comprobar_login.php';
?>

<!DOCTYPE html>
<html lang="es">
	<head>
		<title>inTime</title>
		<meta name="keywords" content="sonic, responsive, free template, fluid layout, bootstrap, templatemo" />
		<meta name="description" content="Sonic is one-page responsive free template using Bootstrap. This layout is suitable for creative portfolio showcase." />
		<meta charset="utf-8">
		<meta name="viewport" content="initial-scale=1">

		<link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" href="css/bootstrap.min.css">
		<link rel="stylesheet" href="css/font-awesome.min.css">
		<link rel="stylesheet" href="css/templatemo_misc.css">
		<link rel="stylesheet" href="css/templatemo_style.css">
	</head>
<?php
	$usuario = $_SESSION['usuario'];
	$BDD = new MysqlUsuario();
	$resultadoSolicitudes = $BDD->conseguirSolicitudesRecibidasNoVistas($_SESSION["usuario"]->getId());
	$num_solicitudes = count($resultadoSolicitudes);
	$BDD = new MysqlServicio();
	$servicios = $BDD->conseguirServiciosByUserId($usuario->getId());
?>
	<body>
		<?php include "sidebar.php"
		?>
		<div id="main-content">
			<div id="templatemo">
				<div class="section-content">
					<div class="row">
						<div class="col-md-12">
							<div class="section-title">
								<div class="buscador">
									<form method="post" action="busqueda.php" accept-charset="utf-8">
										<label>Buscar</label>
										<input type="text" name="nombrebusq" size="50">
										<button type="submit" name="submit">
											Enviar
										</button>
										<a href="busqueda.php">Búsqueda avanzada</a>
									</form>
								</div>
							</div>
						</div>
						<h1><?php echo $usuario->getNombre()." ".$usuario->getApellidos(); ?></h1>
					</div>
					<div class="cuerpo">
						<h3 id="solicitud">
						<?php
							if($num_solicitudes == 0){
						?>
								<?php echo "No tienes ninguna solicitud pendiente"?>
								
						<?php
							}else if($num_solicitudes == 1){
						?>
								<a href="solicitudes.php"><?php echo "Tienes ".$num_solicitudes." solicitud pendiente"?></a>
						<?php
							}else {
						?>
								<a href="solicitudes.php"><?php echo "Tienes ".$num_solicitudes." solicitudes pendientes"?></a>
						<?php	
							}
						?>
						</h3>
						
						<!--<h3>Tienes 4 solicitudes pendientes de usuarios requiriendo tus servicios</h3>-->
						<h3><a>2 usuarios han respondido a tu peticion de servicio</a></h3>
						<div class="lista-serv">
							<h3>Lista de servicios del usuario:</h3>
							<?php
								if(isset($servicios)){
									foreach($servicios as $servicio){
							?>
										<div class="servicio-ej">
											<?php 
												echo '<a href="servicio.php?id_servicio='.$servicio->getIdServicio().'"><h4>'.$servicio->getNombre().'</h4></a>';
											?>
											<div class="serv-nota">
											<?php
												$nota = $BDD->notamedia($servicio->getIdServicio());
												if (!empty($nota))
													echo"<p>Nota: ".$nota."</p>";
												else
													echo"<p>No valorado</p>";
											?>
											</div>
											<div class="serv-desc">
											<?php
												echo"<p>".$servicio->getDescripcion()."</p>";
											?>
											</div>
										</div>
							<?php 
									} 
								}
							?>
						</div>
					</div>
				</div>
				<!-- /#services -->
			</div>
			<!-- /#templatemo"-->
			<?php include 'footer.php'
			?>
		</div>
		<!-- /#main-content-->
	</body>
</html>