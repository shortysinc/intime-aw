<!DOCTYPE html>
<?php
	require_once '../controlador/op_base_datos_usuario.php';
	require_once '../modelo/usuario.php';
?>
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
		<script type="text/javascript">
 	     function ConfirmDelete(ID)
  		    {
        	    if (confirm("¿Seguro que desea borrar el Usuario " + ID +" ?"))
       	          location.href='../controlador/deleteuser.php?id=' + ID;
  		    }
		  </script>
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
							<table>
							<?php
							$BDD = new MysqlUsuario();
							$resultado = $BDD->mostrar_todos_usuarios();
							echo "LISTA DE USUARIOS";
							echo "<table border='1' cellpadding='2' cellspacing='2'";
							echo "<tr><td>ID</td><td>Nombre</td><td>Correo</td><td>Direccion</td><td>Horas</td>";
							while ($row = mysqli_fetch_array($resultado)) {
							$id = $row['id_usuario'];
							        echo "<tr>";
							        echo "<td>".$row["id_usuario"]."</td>";
							        echo "<td>".$row["nombre"]."</td>";
							        echo "<td>".$row["correo"]."</td>";
							        echo "<td>".$row["direccion"]."</td>";
							        echo "<td>".$row["horas_usuario"]."</td>";
									echo "<td><a href = '#' onClick='javascript:ConfirmDelete($id)'‌​>Borrar User</a></td>";
									echo "<td><a href='../vista/editarperfil.php?id=$id';>Editar User</a></td>";
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