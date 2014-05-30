<!DOCTYPE html>
<html lang="es">
	<?php
		require_once '../controlador/op_base_datos_servicio.php';
		require_once '../modelo/usuario.php';
		require_once '../controlador/op_base_datos_usuario.php';
		require_once '../modelo/servicio.php';
		session_start();
	?>
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
										<form action="" method="get" accept-charset="utf-8">
											<label>Buscar</label>
											<input type="text" name="nombrebusq" size="50">
											<button type="submit" name="submit" value="Enviar">
												Enviar
											</button>
										</form>
										<?php if (isset($_SESSION['login_usuario'])){ ?>
											<div class="avanzada">
												<form method="post" action="busqueda.php" accept-charset="utf-8">
													<label>Busqueda por confianza: </label>
													<input type="radio" name="consulta" value="propia" checked="checked" />
													Busca por confianza propia.
													<input type="radio" name="consulta" value="red" />
													Busca por red de confianza
													<select name="valbusq">
														<option value="5" selected>5</option>
														<option value="6">6</option>
														<option value="7">7</option>
														<option value="8">8</option>
														<option value="9">9</option>
														<option value="10">10</option>
													</select>
													<button type="submit" value="Entrar">
														Entrar
													</button>
												</form>
											</div>
										<?php } ?>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="lista">
					<?php include "../controlador/busquedanormal.php"?>
				</div>
			</div>
			<!-- /.templatemo -->
			<?php include 'footer.php'
			?>
		</div>
		<!-- /#main-content -->
	</body>
</html>