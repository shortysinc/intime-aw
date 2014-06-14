<!DOCTYPE html>
<html lang="es">
<?php
	require_once '../modelo/usuario.php';
	require_once '../controlador/op_base_datos_usuario.php';
	session_start();
	
	require_once '../controlador/comprobar_login_usuario_admin.php';
	
	if(isset($_GET['id_usuario'])){
		$BDDuser=new MysqlUsuario();
		$id_usuario = $_GET['id_usuario'];
		$usuario = $BDDuser->conseguirUsuarioById($id_usuario);
		
		//Si el campo id_usuario del servicio es el mismo que el id del usuario que esta logueado entonces puede editar
		if(((isset($_SESSION['login_admin']))&& ($_SESSION['login_admin']==true)) || (isset($usuario) && $usuario->getId() == $id_usuario)){
			
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
								<h1>Edita tu perfil</h2>
							</div>
							<!-- section-title -->
						</div>
						<!-- col-md-12 -->
						<div class="cuerpo">
							<div class="contact-form" id="form">
								<form action="../controlador/edituser.php?id_usuario=<?php echo $id_usuario ?>" method="post" enctype="multipart/form-data" accept-charset="utf-8">
									
									<!-- /.col-md-4 -->
									<div class="col-md-8">
										<label for="email" >Nuevo correo electrónico:</label>
										<input name="email" type="text" id="email" maxlength="40"/>
									</div>
									<div class="col-md-8">
										<label for="foto" >Nueva imagen de perfil:</label>
										<input name="foto" type="file" id="foto" maxlength="40"/>
									</div>
									<div class="col-md-8">
										<label for="nombre" >Nuevo nombre:</label>
										<input name="nombre" type="text" id="nombre" maxlength="40"/>
									</div>
									<div class="col-md-8">
										<label for="apellidos" >Nuevo apellidos:</label>
										<input name="apellidos" type="text" id="apellidos" maxlength="125"/>
									</div>
									<div class="col-md-8">
										<label for="direccion" >Nueva direccion:</label>
										<input name="direccion" type="text" id="direccion" maxlength="40"/>
									</div>
									<div class="col-md-8">
										<label for="pass" >Nuevo contraseña:</label>
										<input name="pass" type="text" id="pass" maxlength="40"/>
									</div>
									<!-- /.col-md-12 -->
									<div class="col-md-12">
											<!--<a ="#" class="largeButton contactBgColor">Send Message</a>-->
											<button class="largeButton submitBgColor" type="submit" value="Enviar">
												Enviar
											</button>
									</div>
								</form>
								<!-- /.contatc-form -->
							</div>
							<!-- /#cuerpo -->
						</div>
					<!-- /#row -->
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
	<?php
		}
	}
?>
</html>