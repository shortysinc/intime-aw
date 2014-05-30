<!DOCTYPE html>
<html lang="es">
	<?php
		require_once '../controlador/op_base_datos_servicio.php';
		require_once '../controlador/op_base_datos_usuario.php';
		require_once '../modelo/usuario.php';
		session_start();
		
		$user;
		if (isset($_SESSION['usuario'])){
			$login=$_SESSION['usuario'];
			$id = $login->getId();
			
			$BDD = new MysqlUsuario();
			$user=$BDD->conseguirUsuarioById($id);
			$BDD = new MysqlServicio();              			 //[0]$id_usuario,[1]$correo,[2]$nombre,[3]$apellidos,[4]$foto
			$services=$BDD->conseguirServiciosByUserId($id);
		}
			  //[0]$id,[1]$nombre,[2]$descripcion
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
						echo'<h1>'.$user->getNombre()." ".$user->getApellidos().'</h1>';
						if (!empty($user->getFoto())){
								echo '<img src="data:image/png;base64,' . base64_encode($user->getFoto()) . '"/>';
							}else
								echo '<img src="images/user.png">';
					?>
					<div class="infouser">
						<?php
							echo"<p>".$user->getCorreo()."</p>";
							if (($user->getId()==$login->getId())||((isset($_SESSION['login_admin']))&& ($_SESSION['login_admin']==true)))
								echo'<a href="editarperfil.php?id='.$user->getId().'"><h5>Editar perfil</h5></a>';
						?>
					</div>
					<div class="lista-serv">
						<h3>Lista de servicios del usuario:</h3>
						<?php
							$lenght=count($services);
							for ($i=0;$i<$lenght;$i=$i+1){?>
								<div class="servicio-ej">
									<?php 
										echo '<a href="trabajo.php?id='.$services[$i][0].'"><h4>'.$services[$i][1].'</h4></a>';
									?>
									<div class="serv-nota">
									<?php
										$nota=$BDD->notamedia($services[$i][0]);
										if (!empty($nota))
											echo"<p>Nota: ".$nota."</p>";
										else
											echo"<p>No valorado</p>";
									?>
									</div>
									<div class="serv-desc">
									<?php
										echo"<p>".$services[$i][2]."</p>";
									?>
									</div>
								</div>
						<?php } ?>
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