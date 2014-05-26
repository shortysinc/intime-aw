<!DOCTYPE html>
<html lang="es">
	<head>
		<title>inTime - Servicios</title>
		<meta name="keywords" content="sonic, responsive, free template, fluid layout, bootstrap, templatemo" />
		<meta name="description" content="Sonic is one-page responsive free template using Bootstrap. This layout is suitable for creative portfolio showcase." />
		<meta charset="utf-8">
		<meta name="viewport" content="initial-scale=1">

		<link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>

		<link rel="stylesheet" href="css/font-awesome.min.css">
		<link rel="stylesheet" href="css/templatemo_misc.css">
		<link rel="stylesheet" href="css/bootstrap.min.css">
		<link rel="stylesheet" href="css/templatemo_style.css">
		<link rel="stylesheet" href="css/menu.css">
		<link rel="stylesheet" href="css/rating.css">

	</head>
	<body>
		<?php include "sidebar.php"
		?>
		<div id="main-content">
			<div id="templatemo">
				<div id="services" class="section-content">
					<div class="row">
						<div class="col-md-12">
							<div class="section-title">

								<h2>Servicios</h2>
								<div class="buscador">
									<form method="post" action="busqueda.php" accept-charset="utf-8">
										<label>Buscar</label>
										<input type="text" size="50">
										<button type="submit" name="submit" value="Enviar">
											Enviar
										</button>
										<a href="">Búsqueda avanzada</a>
									</form>
								</div>

							</div>

							<!--NUEVO!! -->

							<div class="cuerpo">

								<table id="tabla_general">
									<tr>
										<td class="columna-servicios" valign="top">
										<div class="lista-servicios">
											<table id="tabla_categorias">
												<div class="lista-categorias">
													<p>
														<a href="categoria1.php">Categoría 1</a>
													</p>
													<p>
														<span id="azul-oscuro"><a href="categoria2.php">Categoría 2</a></span>
													</p>
													<p>
														<a href="categoria3.php">Categoría 3</a>
													</p>
												</div>
											</table>
										</div>
							</div>
						</div>
						<div class="cuerpo"></div>

					</div>
					<!-- /#services -->

					<td valign="top">
					<div class="descripcion-servicios">
						<p>
							<strong>Lista de servicios para la categoría 2:</strong>
						</p>
						<?php include "tablaservicios.php"
						?>
						<?php include "tablaservicios.php"
						?>
						<?php include "tablaservicios.php"
						?>
					</div><!--descripcion-servicios --></td>
					</tr>
					</table>
				</div>
				<!-- /#templatemo"-->
				<?php include 'footer.php'
				?>
			</div>
			<!-- /#main-content-->
	</body>
