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
		<script src="jquery/jquery-2.1.0.min.js" type="text/javascript"></script>
	</head>
	<?php
	require_once '../controlador/opbasededatos.php';

	$BDD = new Mysql();
	$resultadoCategorias = $BDD -> conseguirTodasLasCategorias();
	?>
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
									<form class="buscador-form" method="get" accept-charset="utf-8">
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
							<div class="cuerpo" id="servicios">
								<?php 
									while($row = $resultadoCategorias->fetch_assoc()){
								?>
										<span class="lista-categorias"><a href=""><?php echo $row['categoria'] ?></a></span>
								<?php	
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
		</div>
	</body>
</html>