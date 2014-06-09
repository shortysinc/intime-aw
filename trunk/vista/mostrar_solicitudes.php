<?php
	require_once '../controlador/op_base_datos_servicio.php';
	require_once '../controlador/op_base_datos_usuario.php';
	require_once '../modelo/usuario.php';
	require_once '../modelo/servicio.php';
	require_once '../modelo/solicitud.php';
	session_start();
	//Comprobamos si el usuario ha hecho login
	require_once '../controlador/comprobar_login.php';
	
	$BDDUsuario = new MysqlUsuario();
	$BDDServicio = new MysqlServicio();
	$usuario = $_SESSION['usuario'];
?>
	<script>
		function cambiarOpcion(tipo,estado){
			var selectBox = document.getElementById("estado");
		    var selectedValue = selectBox.options[selectBox.selectedIndex].value;
		    if(!estado){
		    	 $("#tipo-solicitudes").load("solicitudes_por_estado.php?tipo="+tipo+"&estado="+selectedValue);
		    	 console.log("!estado")
		    }else {
		    	 $("#tipo-solicitudes").load("solicitudes_por_estado.php?tipo="+tipo+"&estado="+estado);
		    	 console.log("estado");
		    }
		   
		}
	</script>
<?php
	//solicitudes recibidas
	if(isset($_GET['tipo']) && $_GET['tipo'] == 0){
		$BDDUsuario->actualizarVioSolicitudRecibida($usuario->getId());
?>
		<span class="h2-solicitud"><h2>Recibidas</h2></span>
<?php
	//solicitudes enviadas
	}else if(isset($_GET['tipo']) && $_GET['tipo'] == 1){
		$BDDUsuario->actualizarVioSolicitudEnviada($usuario->getId());
?>
		<span class="h2-solicitud"><h2>Enviadas</h2></span>
<?php
	}
?>
	<span id="combobox-estado">
		<select id="estado" onchange="cambiarOpcion(<?php echo $_GET['tipo'] ?>)">
		  <option value="0">Pendientes</option>
		  <option value="1">Aceptadas</option>
		  <option value="2">Rechazadas</option>
		  <option value="3">Todas</option>
		</select>
	</span>
	<div id="tipo-solicitudes">
	</div>
	<script>
<?php
		if(isset($_GET['estado'])){
?>
			cambiarOpcion(<?php echo $_GET['tipo'] ?>, <?php echo $_GET['estado'] ?>);
<?php
		}else {
?>
			cambiarOpcion(<?php echo $_GET['tipo'] ?>);
<?php
		}
?>
	</script>