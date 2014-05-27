<?php
/**
 * Para hacer las consultas relativas a la tabla de usuario
 */
class MysqlUsuario extends Mysql {
	
	public function conseguirUsuarioById($id){
		$this->conectar();
		$pst = $this->conexion->prepare("select id_usuario,correo,nombre,apellidos,foto from usuario where id_usuario=? ");
		$pst->bind_param("s", $id);
		$pst->execute();
		$pst->bind_result($id_usuario,$correo,$nombre,$apellidos,$foto);
		$pst->fetch();
		$result=array($id_usuario,$correo,$nombre,$apellidos,$foto);
		$pst->close();
		return $result;
	}
	
	/**
	 * Inserta un usuario en la bdd. 
	 * @return El número de error al intentar introducir el usuario. 0 si no hay error.
	 */
	public function insertarUsuarioRegistro($correo, $nombre, $apellidos, $direccion, $pass) {
		$this->conectar();
		$args = array($correo, $nombre, $apellidos, $direccion, $pass);
		//Escapamos los datos obtenidos del formulario
		$this->escapaBd($args);
		
		//Crea una salt al azar
		$salt = hash('sha512', uniqid(mt_rand(1, mt_getrandmax()), true));
		$pass = $args[4]; // Para hacer el hash con la pass escapada
		//Crea una contraseña a partir del hash con salt
		$pass = hash('sha512', $pass.$salt);
		
		$pst =  $this->conexion->prepare("insert into usuario (correo, nombre, apellidos, direccion, pass, salt) values 
		(?, ?, ?, ?, ?, ?)");
		
		//Los dos ultimos parámetros generados a partir de $pass inicial una vez escapada
		$pst->bind_param("ssssss", $args[0], $args[1], $args[2], $args[3], $pass, $salt);
		$pst->execute();
		$error = $pst->errno;
		//printf("Num error: %d. Error message: %s\n", $error, mysqli_error($this->conexion));
		
		$pst->close();
		$this->cerrar();
		
		return $error;
	}
	
	/**
	 * Obtiene el usuario especificado por su correo y por su contraseña de la bdd
	 * @return el usuario
	 */
	public function loginuser($correo,$pass){
		$this->conectar();
		$args = array($correo, $pass);
		//Escapamos los datos obtenidos del formulario
		$this->escapaBd($args);
		$pst =  $this->conexion->prepare("select * from usuario where correo = ?");
		$pst->bind_param("s", $args[0]);
		$pst->execute();
		$resultado = $pst->get_result();
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
	
	/**
	 * Obtiene el usuario que ofrece el servicio
	 * @return el usuario de la base de datos.
	 */ public function conseguirUsuarioServicio($id_usuario) {

		$this->conectar();
		$pst= $this->conexion->prepare("SELECT DISTINCT nombre FROM usuario,servicio WHERE usuario.id_usuario = servicio.id_usuario and usuario.id_usuario=? ");
		$pst->bind_param("i", $id_usuario);
		$pst->execute();
		$resultado = $pst->get_result();
	
		$pst->close();
		$this->cerrar();
	
		return $resultado;
	}
	 
	 public function mostrar_todos_usuarios(){
		$this->conectar();
		$pst = $this->conexion->prepare("select * from usuario");
		$pst->execute();
		$resultado = $pst->get_result();
		$pst->close();
		$this->cerrar();
		
		return $resultado;
	} 
}
