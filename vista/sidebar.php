<?php
$dir = $_SERVER["REQUEST_URI"];
$array = explode("/", $dir);
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
				<a href='vista/mostrar_servicios.php'>servicios</a>
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
			require_once '../controlador/op_base_datos_usuario.php';
			require_once '../controlador/op_base_datos_servicio_realizado.php';
			require_once '../controlador/op_base_datos_servicio.php';
			require_once '../modelo/servicio.php';
			require_once '../modelo/servicio_realizado.php'; 
			
			if(isset($_SESSION['login_usuario']) && $_SESSION['login_usuario']){
				//USUARIO REGISTRADO
				$usuario = $_SESSION['usuario'];
				$BDD = new MysqlUsuario();
				$BDDServicio = new MysqlServicio();
				$_SESSION['usuario'] = $usuario;
				
				//INSERTAR LOS SERVICIOS QUE LE HAN REALIZADO AL USUARIO (SI LOS HAY)
				//Obtenemos las solicitudes realizadas que no esten en servicio realizado
				$solicitudesRealizadas = $BDD->conseguirSolRealizadasNoEnServicioRealizado($usuario->getId());
				$BDDs_r = new MysqlServicioRealizado();
				if(isset($solicitudesRealizadas)){
					$horas = 0;
					foreach ($solicitudesRealizadas as $solicitud) {
						//Insertamos la solicitud como servicio realizado
						$BDDs_r->insertarServicioRealizado($solicitud->getIdSolicitud());
						//Obtenemos el servicio a partir de la solicitud
						$servicio = $BDDServicio->conseguirServicio($solicitud->getIdServicio());
						//RESTARLE LAS HORAS CORRESPONDIENTES AL USUARIO POR EL SERVICIO QUE HA CONTRATADO
						$horas += $servicio->getHoras();
					}
					$BDD->actualizarHorasUsuario($usuario->getId(), $usuario->getHoras() - $horas);
				}
				
				//SUMARLE LAS HORAS AL USUARIO POR LOS SERVICIOS QUE HA REALIZADO Y QUE NO HA COBRADO SI LOS HAY
				$serviciosNoCobrados = $BDDs_r->conseguirSerRealizadosNoCobrados($usuario->getId());
				if(isset($serviciosNoCobrados)){
					$horas = 0;
					foreach($serviciosNoCobrados as $row){
						$servicio = $row['servicio'];
						$servicio_realizado = $row['servicio_realizado'];
						$horas += $servicio->getHoras();
						$BDDs_r->cobrarServicio($servicio_realizado->getIdSerRealizado());
					}
					$horas += $usuario->getHoras();
					$BDD->actualizarHorasUsuario($usuario->getId(), $horas);
				}
				
				$usuario = $BDD->conseguirUsuarioById($usuario->getId());
				$_SESSION['usuario'] = $usuario;
	
		?>
				<div class="logo">
					<a href="perfil_usuario.php">
						<img src="images/logo.png"/>
					</a>
				</div>
				<div class="navigation-log-in">
					<ul class="main-menu">
						<div class="circle-text">
							<div class="contador">
									<?php echo $usuario->getHoras() ?>
							</div>
							<p>Horas</p>
						</div>
						<?php 
							if($usuario->getFoto() == NULL){
								echo "<a href='perfil_usuario.php'><img src='images/usuario/user_defect.png'></a>";
							}else{
						?>
								<a href='perfil_usuario.php'><img src='<?php echo "images/usuario/".$usuario->getFoto() ?>'></a>
						<?php
							}
						?>
						<p>
							<?php echo $usuario->getNombre();?>
						</p>
						<li class="requests">
							<a href="solicitudes.php">Solicitudes</a>
						</li>
						<li class="services">
							<a href="mostrar_servicios.php">servicios</a>
						</li>
						<li class="profile">
							<a href="perfil.php?id_usuario=<?php echo $usuario->getId() ?>">Mi Perfil</a>
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
						<p> Administrador </p>
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
						<a href='mostrar_servicios.php'>servicios</a>
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