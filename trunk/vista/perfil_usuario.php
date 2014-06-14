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
	$solRecibidasNoVistas = $BDD->conseguirSolicitudesRecibidasNoVistas($usuario->getId());
	$solAceptadasNoVistas = $BDD->conseguirSolicitudesAceptadasNovistas($usuario->getId());
	$solRechazadasNoVistas = $BDD->conseguirSolicitudesRechazadasNovistas($usuario->getId());

	$num_sol_recibidas = count($solRecibidasNoVistas);
	$num_sol_aceptadas = count($solAceptadasNoVistas);
	$num_sol_rechazadas = count($solRechazadasNoVistas);

	$BDD = new MysqlServicio();
	$servicios_realizados = $BDD->conseguirServiciosSolicitudAceptadosRealizados($usuario->getId());
	$servicios_proximos = $BDD->conseguirServiciosSolicitudAceptadosNoRealizados($usuario->getId());
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
						<h1 id = 'nombre-principal'><?php echo $usuario->getNombre()." ".$usuario->getApellidos(); ?></h1>
						<h2>Mis servicios comprados</h2>
					</div>
					<div class="cuerpo">
						<?php
							if($num_sol_recibidas == 1){
								echo "<h3 id='solicitud'><a href='solicitudes.php?tipo=0&estado=0'>Tienes ".$num_sol_recibidas." solicitud pendiente de aceptar</a></h3>";
							}else if($num_sol_recibidas > 1){
								echo "<h3 id='solicitud'><a href='solicitudes.php?tipo=0&estado=0'>Tienes ".$num_sol_recibidas." solicitudes pendientes de aceptar</a></h3>";
							}
						
							if($num_sol_aceptadas == 1){
								echo "<h3><a class='solicitud-aceptada' href='solicitudes.php?tipo=1&estado=1'>Una solicitud enviada ha sido aceptada</a></h3>";
								
							}else if($num_sol_aceptadas > 1){
								echo "<h3><a class='solicitud-aceptada' href='solicitudes.php?tipo=1&estado=1>Varias solicitudes enviadas han sido aceptadas</a></h3>";
							}
							
							if($num_sol_rechazadas == 1){
								echo "<h3><a class='solicitud-rechazada' href='solicitudes.php?tipo=1&estado=2'>Una solicitud enviada ha sido rechazada</a></h3>";
							}else if($num_sol_rechazadas > 1){
								echo "<h3><a class='solicitud-rechazada' href='solicitudes.php?tipo=1&estado=2>Varias solicitudes enviadas han sido rechazadas</a></h3>";
							}
						?>
						<div class="lista-serv" id="proximos">
							<h3>Próximos</h3>
							<?php
								if(isset($servicios_proximos)){
									foreach($servicios_proximos as $row){
										$servicio = $row['servicio'];
										$solicitud = $row['solicitud'];
							?>			
										<div class="servicio-ej">
											<?php 
												echo '<a href="servicio.php?id_servicio='.$servicio->getIdServicio().'"><h4>'.$servicio->getNombre().'</h4></a>';
											?>
											<div class="serv-nota">
											<?php
												$nota = $BDD->notamedia($servicio->getIdServicio());
												if (!empty($nota))
													echo"<p><span class='explicacion'>Nota: ".$nota."</span></p>";
												else
													echo"<p>No valorado</p>";
											?>
											</div>
											<div class="serv-desc">
											<?php
												echo"<p><span class='explicacion'>".$servicio->getDescripcion()."</span></p>";
												echo "<p><span class='verde'>Inicio: ".$solicitud->getInicioFormateada()."</span>  - <span class='rojo'>Fin: ".$solicitud->getFinFormateada()."</span></p>";
											?>
											</div>
										</div>
							<?php 
									} 
								}
							?>
						</div>
						<div class="lista-serv" id="realizados">
							<h3>Realizados</h3>
							<?php
								if(isset($servicios_realizados)){
									foreach($servicios_realizados as $row){
										$servicio = $row['servicio'];
										$solicitud = $row['solicitud'];
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
												echo "<p>Finalizado: ".$solicitud->getFinFormateada()."</p>";
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