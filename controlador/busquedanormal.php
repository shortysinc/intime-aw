<?php
	if ((isset($_POST["nombrebusq"]) && $_POST["nombrebusq"]!="") || (isset($_POST["consulta"]))){
		if (isset($_POST["nombrebusq"])){
			$nbusq = $_POST["nombrebusq"];
			$servicios=array();
			$BDDserv = new MysqlServicio();
			$servicios=$BDDserv->busqueda($nbusq); 
		}
		if (isset($_POST["consulta"])){
			$login=$_SESSION['usuario'];
			$consulta = $_POST["consulta"];
			$corte = $_POST["valbusq"];
			$servicios=array();
			$BDDserv = new MysqlServicio();
			$servicios=$BDDserv->busquedaavanzada($corte,$login->getId());
			if ($_POST["consulta"]=="red"){
				if (null!=$servicios[0]->getIdUsuario()){
					$iteracionarray=array();
					$sumaarray=array();
					$sumaarray=$BDDserv->busquedaavanzada($corte,$servicios[0]->getIdUsuario());
					for ($i=1;$i<count($servicios);$i=$i+1){
						$iteracionarray=$BDDserv->busquedaavanzada($corte,$servicios[$i]->getIdUsuario()); 
						$sumaarray=array_merge((array)$sumaarray,(array)$iteracionarray);
					}
					$servicios=array();
					$servicios=$sumaarray;
				}
			}
		}
		$lenght=count($servicios);
		for ($i=0;$i<$lenght;$i=$i+1){
			$BDDuser=new MysqlUsuario();
			$user=$BDDuser->conseguirUsuarioById($servicios[$i]->getIdUsuario());
		?>
				<div class ="busq-ej">
					<?php
						echo'<a href=trabajo.php?id='.$servicios[$i]->getIdServicio().'><h3>'.$servicios[$i]->getNombre().'</h3></a>';
						echo'<a href=perfil.php?id_usuario='.$user->getId().'><h4>'.$user->getNombre()." ".$user->getApellidos().'</h4></a>';
					?>
					<div class="busq-foto">
						<?php
							if (!empty($user->getFoto())){
								echo '<img src="images/usuario/'.$user->getFoto().'"></a>';
							}else
								echo '<img src="images/usuario/user_defect.png">';
						?>
					</div>
					<div class="busq-nota">
						<?php
							if ((isset($_POST["consulta"]))&&(!$_POST["consulta"]=="red")){
								$nota=$BDDserv->conseguirNota($servicios[$i]->getIdServicio(),$login->getId());
								echo"<p>".$nota."</p>";
							}else
							{
								$nota=$BDDserv->notamedia($servicios[$i]->getIdServicio());
								echo"<p>".$nota."</p>";
							} 
						?>
					</div>
					<div class="busq-desc">
						<?php
						echo"<p>".$servicios[$i]->getDescripcion()."</p>";
						?>
					</div>
				</div>
		<?php
		}
	}