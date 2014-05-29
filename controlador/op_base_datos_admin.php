<?php
require_once '../controlador/op_base_datos.php';
require_once '../modelo/admin.php';
class MysqlAdmin extends Mysql{
	
	public function loginAdmin($correo, $pass){
		$this->conectar();
		$args = array($correo, $pass);
		//Escapamos los datos obtenidos del formulario
		$this->escapaBd($args);
		$pst = $this->conexion->prepare("select * from admin where correo = ?");
		$pst->bind_param("s", $args[0]);
		$pst->execute();
		$pst->bind_result($id, $correo, $pass, $salt);
		$pst->fetch();
		$admin = new Admin($id, $correo, $pass, $salt);
		$pst->close();
		$this->cerrar();
		
		$pass = hash('sha512', $args[1].$admin->getSalt());
		$password = $admin->getPass();
		if ($password === $pass){
			return $admin;
			
		}else {
			return NULL;
		}
	}
}
