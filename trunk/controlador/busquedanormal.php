<?php
	require_once '../controlador/opbasededatos.php';
	require_once '../modelo/usuario.php';
	if ((isset($_POST["nombrebusq"]) && $_POST["nombrebusq"]!="") || (isset($_POST["consulta"]))){
		if (isset($_POST["nombrebusq"])){
			$nbusq = $_POST["nombrebusq"];
			$ret=array();
			$BDD = new Mysql();
			$ret=$BDD->busqueda($nbusq);
		}
		if (isset($_POST["consulta"])){
			session_start();
			$usuario=$_SESSION['usuario'];
			$consulta = $_POST["consulta"];
			$corte = $_POST["valbusq"];
			$ret=array();
			$BDD = new Mysql();
			$ret=$BDD->busquedaavanzada($corte,$usuario->getId());
			if ($_POST["consulta"]=="red"){
				if (isset($ret[0][5])){
					$iteracionarray=array();
					$sumaarray=array();
					$sumaarray=$BDD->busquedaavanzada($corte,$ret[0][5]);
					for ($i=1;$i<count($ret);$i=$i+1){
						$iteracionarray=$BDD->busquedaavanzada($corte,$ret[$i][5]);
						$sumaarray=array_merge((array)$sumaarray,(array)$iteracionarray);
					}
					$ret=array();
					$ret=$sumaarray;
				}
			}
		}
		$lenght=count($ret);
		for ($i=0;$i<$lenght;$i=$i+1){?>
				<div class ="busq-ej">
					<?php
						echo'<a href=trabajo.php?id='.$ret[$i][6].'><h3>'.$ret[$i][3].'</h3></a>';
						echo'<a href=perfil.php?id='.$ret[$i][5].'><h4>'.$ret[$i][0]." ".$ret[$i][1].'</h4></a>';
					?>
					<div class="busq-foto">
						<?php
							if (!empty($ret[$i][2])){
								echo '<img src="data:image/png;base64,' . base64_encode($ret[$i][2]) . '"/>';
							}else
								echo '<img src="images/user.png">';
						?>
					</div>
					<div class="busq-nota">
						<?php
							if (isset($_POST["nombrebusq"])){
								$nota=$BDD->notamedia($ret[$i][6]);
								echo"<p>".$nota."</p>";
							}else{
								echo"<p>Nota: ".$ret[$i][7]."</p>";
							}
						?>
					</div>
					<div class="busq-desc">
						<?php
						echo"<p>".$ret[$i][4]."</p>";
						?>
					</div>
				</div>
		<?php
		}
	}