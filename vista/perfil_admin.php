<?php 
	require_once '../controlador/op_base_datos_admin.php';
	require_once '../modelo/admin.php';
	session_start();
?>
<!DOCTYPE html>
<html lang="es">
	<?php include "head.php"?>
	<?php
		if(!isset($_SESSION['login_admin']) || !$_SESSION['login_admin']){
			$_SESSION["mensaje"] = "No tienes suficientes permisos";
			header('Location: ../index.php');
		}
	?>
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
										<button type="submit" name="submit">
											Enviar
										</button>
										<a href="busqueda.php">Búsqueda avanzada</a>
									</form>
								</div>
							</div>
						</div>
						<h1>Bienvenido Admin</h2>
					</div>
					<div class="cuerpo">
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