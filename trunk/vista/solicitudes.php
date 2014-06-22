<!DOCTYPE html>
<html lang="es">
<?php
require_once '../controlador/op_base_datos_usuario.php';
require_once '../modelo/usuario.php';
session_start();

require_once '../controlador/comprobar_login.php';

?>
	<?php include "head.php"?>
	<script src="jquery/jquery-2.1.0.min.js" type="text/javascript"></script>
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
										<button type="submit"  name="submit">
											Enviar
										</button>
										<a href="busqueda.php">Búsqueda avanzada</a>
									</form>
								</div>
							</div>
						</div>
						<h1>Solicitudes</h1>
					</div>
					<div class="cuerpo">
						<div class="sol-rec">
							<a href="#" onclick="mostrarSolicitudes(0)">Recibidas</a>
							<a>|</a>
							<a href="#" onclick="mostrarSolicitudes(1)"> Enviadas</a>
							<script>
								function mostrarSolicitudes(tipo, estado){
									if(!estado){
										$("#solicitudes").load("mostrar_solicitudes.php?tipo="+tipo);
									}else {
										$("#solicitudes").load("mostrar_solicitudes.php?tipo="+tipo+"&estado="+estado);
									}
								}
							</script>
							<div id="solicitudes">
							</div>
							<script>
								<?php 
								if(isset($_GET['tipo'])){
									if(isset($_GET['estado'])){
								?>
										mostrarSolicitudes(<?php echo $_GET['tipo'] ?>, <?php echo $_GET['estado'] ?>);
								<?php	
									}else{
								?>
										mostrarSolicitudes(<?php echo $_GET['tipo'] ?>);
								<?php
									}
								}
								?>	
							</script>
						</div>
					</div>
				</div>
				<!-- /#services -->
			</div>
			<!-- /#templatemo"-->
			<?php
				include 'footer.php';
			?>
		</div>
		<!-- /#main-content-->
	</body>
</html>
<script>
<?php
	if(isset($_SESSION['error'])){
		
?>
		alert("<?php echo $_SESSION['error'] ?>");
<?php
		unset($_SESSION['error']);
	}
	if(isset($_SESSION['mensaje'])){
?>
		alert("<?php echo $_SESSION['mensaje'] ?>");

<?php
		unset($_SESSION['mensaje']);
	}
?>
</script>