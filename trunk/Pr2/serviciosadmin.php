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
	<body>
		<?php include "sidebaradmin.php"
		?>
		<div id="main-content">
			<div id="templatemo">
				<div class="section-content">
					<div class="row">
						<div class="col-md-12">
							<div class="section-title">
								<div class="buscador">
									<form class="buscador-form" method="get" action="busqueda.php" accept-charset="utf-8">
										<label>Buscar</label>
										<input type="text" size="50">
										<button type="submit" name="submit">
											Enviar
										</button>
										<a href="">Búsqueda avanzada</a>
									</form>
								</div>
							</div>
							<!-- /#sTop -->
						</div>
					</div>
					<div class="panel-admin">
						<div class="lista-admin">
							<table>
								<caption>
									<h1>Lista de servicios</h1>
								</caption>
								<thead>
									<th>Id</th>
									<th>Fecha de creacion</th>
									<th>Titulo</th>
									<th>Nota media</th>
								</thead>
									<tr>
										<th><a href="trabajo.php">1</a></th>
										<td>18-3-2014</td>
										<td>Personal trainer</td>
										<td>9,8</td>
										<td><button type="submit" name="submit" value="Editar Servicio">
										Editar Servicio
										</button></td>
										<td><button type="submit" name="submit" value="Eliminar Servicio">
										Eliminar Servicio
										</button></td>	
									</tr>
									<tr>
										<th><a href="trabajo.php">2</a></th>
										<td>18-3-2014</td>
										<td>Personal Assistant</td>
										<td>7,7</td>
										<td><button type="submit" name="submit" value="Editar Servicio">
										Editar Servicio
										</button></td>
										<td><button type="submit" name="submit" value="Eliminar Servicio">
										Eliminar Servicio
										</button></td>	
									</tr>
									<tr>
										<th><a href="trabajo.php">3</a></th>
										<td>18-3-2014</td>
										<td>Coach</td>
										<td>5</td>
										<td><button type="submit" name="submit" value="Editar Servicio">
										Editar Servicio
										</button></td>
										<td><button type="submit" name="submit" value="Eliminar Servicio">
										Eliminar Servicio
										</button></td>	
									</tr>
							</table>
					</div>
				</div>
			</div>
			<?php include 'footer.php'
			?>
		</div>
		<!-- /#main-content -->
	</body>