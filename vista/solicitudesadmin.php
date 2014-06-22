<!DOCTYPE html>
<?php
	require_once '../controlador/op_base_datos_usuario.php';
	require_once '../modelo/usuario.php';
	require_once '../modelo/admin.php';
	session_start();
?>
<html lang="es">
	<?php include "head.php";?>
	<body>
		<?php include "sidebar.php";
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
							<!-- /#sTop -->
						</div>
					</div>
					<div class="panel-admin">
						<div class="lista-admin">
							<?php
							$BDD = new MysqlUsuario();
							$resultado = $BDD->mostrar_todas_solicitudes();
							echo "<h1>LISTA DE SOLICITUDES</h1>";
							echo "<table border='1' cellpadding='2' cellspacing='2'>";
							echo "<tr><td>ID solicitud</td><td>ID Usuario</td><td>ID Servicio</td><td>Estado</td><td>Fecha de Envio</td><td>Fecha de Inicio</td><td>Fecha de Fin</td><td>Comentario</td>";
							while ($row = mysqli_fetch_array($resultado)) {
							$id_servicio = $row['id_servicio'];
							$id_usuario = $row['id_usuario'];
							        echo "<tr>";
							        echo "<td>".$row["id_solicitud"]."</td>";
							        echo "<td><a href='../vista/perfil.php?id_usuario=$id_usuario'>".$row["id_usuario"]."</a></td>";
							        echo "<td><a href='../vista/servicio.php?id_servicio=$id_servicio'>".$row["id_servicio"]."</a></td>";
							        if($row["estado"] == 0){
							        echo "<td>Pendiente</td>";}
							        else if($row["estado"] == 1){
							        echo "<td>Aceptada</td>";}
							        else if ($row["estado"] == 2){
							        echo "<td>Rechazada</td>";}
							        else{
							        echo "<td>Caducada</td>";}
							        echo "<td>".$row["fecha"]."</td>";
									echo "<td>".$row["inicio"]."</td>";
									echo "<td>".$row["fin"]."</td>";
									echo "<td>".$row["comentario"]."</td>";
							        echo "</tr>";
							}
							$resultado->free();
							?>
							</table>
					</div>
				</div>
			</div>
			<?php include 'footer.php'
			?>
		</div>
		<!-- /#main-content -->
	</body>
</html>