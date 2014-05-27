<?php
class MysqlAdmin extends Mysql{
	
	public function loginAdmin($correo, $pass){
		$this->conectar();
		$args = array($correo, $pass);
		//Escapamos los datos obtenidos del formulario
		$this->escapaBd($args);
		$pst = $this->conexion->prepare("select * from admin where correo = ?");
		$pst->bind_param("s", $args[0]);
		$pst->execute();
		$resultado =  $pst->get_result();
		
		$pst->close();
		$this->cerrar();
		
		$row = $resultado->fetch_assoc();
		
		$pass = hash('sha512', $args[1].$row['salt']);
		$password = $row['pass'];
		
		if ($password === $pass){
			return $row;
			
		}else {
			return NULL;
		}
	}
}
