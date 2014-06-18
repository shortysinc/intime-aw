<!DOCTYPE html>
<html lang="es">
	<?php
		require_once '../controlador/op_base_datos_servicio.php';
		require_once '../controlador/op_base_datos_usuario.php';
		require_once '../modelo/usuario.php';
		require_once '../modelo/servicio.php';
		session_start();
		
		if (isset($_SESSION['usuario'])){
			$usuario_logueado = $_SESSION['usuario'];
		}
		
		if(isset($_GET['id_usuario'])){
			$id = $_GET['id_usuario'];
			$BDD = new MysqlUsuario();
			$usuario = $BDD->conseguirUsuarioById($id);
			$BDD = new MysqlServicio();
			$servicios = $BDD->conseguirServiciosByUserId($id);
		}
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
										<label>Buscar</label>
										<input type="text" name="nombrebusq" size="50">
										<button type="submit" name="submit" value="Enviar">
											Enviar
										</button>
										<a href="busqueda.php">Búsqueda avanzada</a>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-------------------------------------------PERFIL----------------------------------------->
				<div class="perfil">
					<?php
						if(isset($usuario)) {
						echo'<h1>'.$usuario->getNombre()." ".$usuario->getApellidos().'</h1>';
						if ($usuario->getFoto() != NULL){
					?>
								<a href='perfil_usuario.php'><img src='<?php echo "images/usuario/".$usuario->getFoto() ?>'></a>
					<?php
							}else
								echo '<img src="images/usuario/user_defect.png">';
					?>
					<div class="infouser">
						<?php
							echo"<p>".$usuario->getCorreo()."</p>";
							//Si el servicio pertenece al usuario logueado o si es administrador
							if ((isset($usuario_logueado) && $usuario->getId()==$usuario_logueado->getId())
								||((isset($_SESSION['login_admin']))&& ($_SESSION['login_admin']))){
								echo'<a href="editarperfil.php?id_usuario='.$usuario->getId().'"><h5>Editar Perfil</h5></a>';
							}
						?>
					</div>
					<h3><?php echo "Dirección: ".$usuario->getDireccion() ?></h3>
					<div class="lista-serv">
						<h3>Lista de servicios del usuario:</h3>
						<?php
							if(isset($servicios)){
								foreach($servicios as $servicio){?>
									<div class="servicio-ej">
										<?php 
											echo '<a href="servicio.php?id_servicio='.$servicio->getIdServicio().'"><h4>'.$servicio->getNombre().'</h4></a>';
										?>
										<div class="serv-nota">
										<?php
											$nota=$BDD->notamedia($servicio->getIdServicio());
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
					<?php } else{
						echo "<h1>Usuario inexistente</h1>";
					}?>
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