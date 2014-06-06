<!DOCTYPE html>
<html lang="es">
	<head>
		<title>inTime</title>
		<meta charset="utf-8">
	</head>
	<script src="jquery/jquery-2.1.0.min.js" type="text/javascript"></script>
	<body>
		<div id="dialogo">
			<a id="mostrar-ocultar" href="#" onclick="mostrarDialogo()">Mostrar diálogo</a>
			<ul id="lista-comentarios">
				
			</ul>
		</div>
		<script>
			var mostrar = true;
			function mostrarDialogo() {
				if(mostrar){
					$("#lista-comentarios").load("comentarios.php");
					$("#mostrar-ocultar").text("Ocultar diálogo");
					mostrar = false;
				}else {
					$("#lista-comentarios").html("<ul id='lista-comentarios'></ul>");
					$("#mostrar-ocultar").text("Mostrar diálogo");
					mostrar = true;
				}
			}
		</script>
	</body>
</html>