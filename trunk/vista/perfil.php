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
			$BDDuser = new MysqlUsuario();
			$user = $BDDuser->conseguirUsuarioById($id);
			$BDDserv = new MysqlServicio();
			$servicios = $BDDserv->conseguirServiciosByUserId($id);
		}
	?>
	<?php include "head.php"?>
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
						if(isset($user)) {
						echo'<h1>'.$user->getNombre()." ".$user->getApellidos().'</h1>';
						if ($user->getFoto() != NULL){
					?>
								<a href='perfil_usuario.php'><img src='<?php echo "images/usuario/".$user->getFoto() ?>'></a>
					<?php
							}else
								echo '<img src="images/usuario/user_defect.png">';
					?>
					<div class="infouser">
						<?php
							echo"<p>".$user->getCorreo()."</p>";
							//Si el servicio pertenece al usuario logueado o si es administrador
							if ((isset($usuario_logueado) && $user->getId()==$usuario_logueado->getId())
								||((isset($_SESSION['login_admin']))&& ($_SESSION['login_admin']))){
								echo'<a href="editarperfil.php?id_usuario='.$user->getId().'"><h5>Editar Perfil</h5></a>';
							}
						?>
					</div>
					<h3><?php echo "Dirección: ".$user->getDireccion() ?></h3>
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
											$nota=$BDDserv->notamedia($servicio->getIdServicio());
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