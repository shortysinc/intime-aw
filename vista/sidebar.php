<?php
$dir = $_SERVER["REQUEST_URI"];
$array = split("/", $dir);
$n = count($array);
?>
<div id="main-sidebar" >
	<asside class="navigation">
		<!-- /.logo -->
		<?php
		//SIDEBAR PARA EL INDEX
		if($array[$n-1] == "index.php" || $array[$n-1] == ""){
		?>
		<div class="logo">
			<a href="index.php"><img src="vista/images/logo.png"/></a>
		</div> 
		<ul class="main-menu">
			<li class="services">
				<a href='vista/categoria1.php'>servicios</a>
			</li>
			<li class="about">
				<a href="vista/sobrenosotros.php">sobre nosotros</a>
			</li>
			<li class="contact">
				<a href="vista/contacto.php">contacto</a>
			</li>
		</ul>
		<?php
		//SIDEBAR PARA EL RESTO DE VISTAS
		}else {
		?>
			<div class="logo">
				<a href="index.php"><img src="images/logo.png"/></a>
			</div> 
		<?php
			if(isset($_SESSION['login_usuario']) && $_SESSION['login_usuario']){
				//USUARIO REGISTRADO
		?>
				<ul class="main-menu">
					<div class="circle-text">
						<div class="contador">8</div>
						<p>Horas</p>
					</div>
				<img src="images/team1.jpg" >
				<p><?php echo $_SESSION['usuario']->getNombre() ?></p>
					<li class="requests">
						<a href="solicitudes.php">Solicitudes</a>
					</li>
					<li class="services">
						<a href="categoria1.php">servicios</a>
					</li>
					<li class="profile">
						<a href="perfil.php">Mi Perfil</a>
					</li>
					<li class="new-job">
						<a href="crearservicio.php">Crear Servicio</a>
					</li>
					<li class="log-out">
						<a href="../controlador/logout.php">Salir</a>
					</li>
				</ul>
		<?php
			}else if(isset($_SESSION['login_admin']) && $_SESSION['login_admin']) {
				//ADMIN
		?>
				<ul class="main-menu">
					<div class="circle-text">
						<div class="contador">-</div>
						<p>Horas</p>
					</div>
					<img src="images/admin.jpg" >
					<li class="user-list">
						<a href="usuariosadmin.php">Lista Usuarios</a>
					</li>
					<li class="service-list">
						<a href="serviciosadmin.php">Lista Servicios</a>
					</li>
					<li class="log-out">
						<a href="../controlador/logout.php">Salir</a>
					</li>
				</ul>
		
		<?php
			}else {
				//USUARIO NO REGISTRADO
		?>
				<ul class="main-menu">
					<li class="services">
						<a href='categoria1.php'>servicios</a>
					</li>
					<li class="about">
						<a href="sobrenosotros.php">sobre nosotros</a>
					</li>
					<li class="contact">
						<a href="contacto.php">contacto</a>
					</li>
				</ul>
		<?php
			}
		?>
		
		<?php
		}
		?>
	</asside>
</div>
<!-- /.navigation -->