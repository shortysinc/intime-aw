<!DOCTYPE html>
<html lang="es">
<?php

	require_once '../modelo/usuario.php';
	require_once '../controlador/op_base_datos_usuario.php';
	require_once '../modelo/servicio.php';
	require_once '../controlador/op_base_datos_servicio.php';
	session_start();
	
	require_once '../controlador/comprobar_login_usuario_admin.php';
	
	if(isset($_GET['id_servicio'])){
		$BDDservice=new MysqlServicio();
		$id_servicio = $_GET['id_servicio'];
		$servicio = $BDDservice->conseguirServicio($id_servicio);
		
		//Si el campo id_usuario del servicio es el mismo que el id del usuario que esta logueado entonces puede editar
		if(((isset($_SESSION['login_admin']))&& ($_SESSION['login_admin']==true)) || (isset($servicio) && $servicio->getIdUsuario() == $_SESSION['usuario']->getId())){
		
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
								<h1>Editar servicio</h2>
							</div>
							<!-- section-title -->
						</div>
						<!-- col-md-12 -->
					</div>
					<!-- /#row -->
					<div class="cuerpo">
						<div class="contact-form">
							<form action="../controlador/editservice.php?id_servicio=<?php echo $id_servicio ?>" method="post" enctype="multipart/form-data" accept-charset="utf-8">
							
								<div class="col-md-4">
									<label for="nombreserv" >Nuevo nombre del servicio:</label>
									<input name="nombreserv" type="text" id="nombreserv" maxlength="40" />
								</div>
								<div class="col-md-4">
									<label for="descrpserv">Nueva descripcion:</label>
									<textarea name="descrpserv" rows="4" cols="50" placeholder="Describe tu servicio"></textarea>
								</div>
								<!-- /.col-md-4 -->
								<div class="col-md-8">
									<label for="foto" >Nueva imagen del servicio:</label>
									<input name="foto" type="file" id="foto" maxlength="40"/>
								</div>
								<!-- /.col-md-4 -->
								<div class="col-md-12">
										<!--<a ="#" class="largeButton contactBgColor">Send Message</a>-->
										<button class="largeButton submitBgColor" type="submit" value="Enviar">
											Enviar
										</button>
								</div>
								<!-- /.col-md-12 -->
							</form>
						</div>
					<!-- /.contatc-form -->
					</div>
				</div>
				<!-- /#section-content -->
			</div>
			<!-- /#templatemo"-->
			<?php include 'footer.php'
			?>
		</div>
		<!-- /#main-content-->
	</body>
</html>
<?php
		}
	}
?>