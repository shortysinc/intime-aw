<?php
require_once '../controlador/op_base_datos_usuario.php';
require_once '../modelo/usuario.php';
require_once '../modelo/solicitud.php';
session_start();

require_once '../controlador/comprobar_login.php';

$usuario = $_SESSION['usuario'];
$BDD = new MysqlUsuario();
$resultadoSolicitudes = $BDD->conseguirSolicitudesRecibidasNoVistas($_SESSION["usuario"]->getId());

if(isset($resultadoSolicitudes)){
	foreach ($resultadoSolicitudes as $solicitud) {
		$BDD->actualizarSolicitud($solicitud->getIdSolicitud(), $solicitud->getIdUsuario(), $solicitud->getIdServicio(),
			 $solicitud->getEstado(), $solicitud->getFecha(), $solicitud->getComentario(), 1);
	}
}

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
	<script src="jquery/jquery-2.1.0.min.js" type="text/javascript"></script>
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
										<button type="submit"  name="submit">
											Enviar
										</button>
										<a href="busqueda.php">Búsqueda avanzada</a>
									</form>
								</div>
							</div>
						</div>
						<h1>Solicitudes</h2>
					</div>
					<div class="cuerpo">
						<div class="sol-rec">
							<a href="#" onclick="mostrarSolicitudesRecibidas()">Recibidas</a>
							<a>|</a>
							<a href="#" onclick="mostrarSolicitudesEnviadas()"> Enviadas</a>
							<script>
								function mostrarSolicitudesRecibidas(){
									$("#solicitudes").load("mostrar_solicitudes.php?tipo="+0);
								}
								
								function mostrarSolicitudesEnviadas(){
									$("#solicitudes").load("mostrar_solicitudes.php?tipo="+1);
								}
							</script>
							<div id="solicitudes">
							</div>
							<script>
								mostrarSolicitudesRecibidas();
							</script>
						</div>
					</div>
				</div>
				<!-- /#services -->
			</div>
			<!-- /#templatemo"-->
			<?php
				include 'footer.php';
			?>
		</div>
		<!-- /#main-content-->
	</body>
</html>