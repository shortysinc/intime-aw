<?php
	require_once '../controlador/opbasededatos.php';
	if (isset($_POST["nombrebusq"]) && $_POST["nombrebusq"]!=""){
	$nbusq = $_POST["nombrebusq"];
		$ret=array();
		$BDD = new Mysql();
		$ret=$BDD->busqueda($nbusq);
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
							$nota=$BDD->notamedia($ret[$i][6]);
							echo"<p>".$nota."</p>";
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