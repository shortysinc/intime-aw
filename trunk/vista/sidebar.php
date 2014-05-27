<?php
$dir = $_SERVER["REQUEST_URI"];
$array = split("/", $dir);
$n = count($array);
?>
	<div id="main-sidebar">
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
		<?php
			if(isset($_SESSION['login_usuario']) && $_SESSION['login_usuario']){
				//USUARIO REGISTRADO
		?>
				<div class="logo">
					<a href="perfil_usuario.php"><img src="images/logo.png"/></a>
				</div>
				<div class="navigation-log-in">
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
				</div>
		<?php
			}else if(isset($_SESSION['login_admin']) && $_SESSION['login_admin']) {
				//ADMIN
		?>
				<div class="logo">
					<a href="perfil_admin.php"><img src="images/logo.png"/></a>
				</div> 
				<div class="navigation-log-in">
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
				</div>
		
		<?php
			}else {
				//USUARIO NO REGISTRADO
		?>
				<div class="logo">
					<a href="../index.php"><img src="images/logo.png"/></a>
				</div> 
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
	</div> 
<!-- /.navigation -->