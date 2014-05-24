<?php
class Mysql{
	private $host="localhost";
	private $user="root";
    private $clave="";
    private $bd="intime";
    private $conexion;  
    private $sql;
	const ERR_DUP_KEY = 1062;
	
	public function conectar(){
        $this->conexion=mysqli_connect($this->host,$this->user,$this->clave);
        mysqli_select_db($this->conexion, $this->bd);
		$this->conexion->set_charset("utf8");
    }
	
	 public function cerrar () {
        @mysql_close($this->conexion);
    }
	
	/**
	 * @param $args: array con todos los elementos que se quieren escapar pasado por referencia.
	 */
	private function escapaBd(&$args) {
		$numElems = count($args);
	
		for($i=0; $i < $numElems; $i++){
			$args[$i] = mysqli_real_escape_string($this->conexion, $args[$i]);
		}
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
	public function loginuser($correo,$pass){
		$this->conectar();
		$args = array($correo, $pass);
		//Escapamos los datos obtenidos del formulario
		$this->escapaBd($args);
		$pst =  $this->conexion->prepare("select * from usuario where correo = ?");
		$pst->bind_param("s", $correo);
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
	 * Obtiene todas las categorías de la bdd.
	 * @return todas las categorías de la bdd.
	 */
	public function conseguirTodasLasCategorias() {
		$this->conectar();
		$pst = $this->conexion->prepare("select * from categoria order by categoria");
		$pst->execute();
		$resultado = $pst->get_result();
		$pst->close();
		$this->cerrar();
		
		return $resultado;
	}
	
	/**
	 * Obtiene un servicio con el  id.
	 * @return el servicio dela base de datos.
	 */ 
	 public function conseguirServicio($id) {

		$this->conectar();
		$pst = $this->conexion->prepare("select * from servicio where id_servicio = ?");
		$pst->bind_param("i", $id);
		$pst->execute();
		$resultado = $pst->get_result();
	
		$pst->close();
		$this->cerrar();
	
		return $resultado;

	}
	/**
	 * Obtiene el usuario que ofrece el servicio
	 * @return el usuario de la base de datos.
	 */ public function conseguirUsuarioServicio($id_usuario) {

		$this->conectar();
		$pst= $this->conexion->prepare("SELECT DISTINCT nombre FROM usuario WHERE id_usuario = ?");
		$pst->bind_param("i", $id_usuario);
		$pst->execute();
		$resultado = $pst->get_result();
	
		$pst->close();
		$this->cerrar();
	
		return $resultado;

	}
	
	/**
	 * Obtiene todos los servicios de la categoría pasada por parámentro
	 * @param $categoria
	 * @return todos los servicios de una categoría
	 */
	public function conseguirServiciosCategoria($categoria) {
		$this->conectar();
		$pst = $this->conexion->prepare("SELECT * FROM servicio natural join categoria WHERE categoria = ?");
		$pst->bind_param("s", $categoria);
		$pst->execute();
		$resultado =  $pst->get_result();
		
		$pst->close();
		$this->cerrar();
		
		return $resultado;
	}
	public function mostrar_todos_usuarios(){
		$enlace = $this->conectar();
		$consulta = "SELECT id_usuario, nombre, correo, direccion, horas_usuario  FROM usuario";
		$resultado = mysqli_query($enlace, $consulta);
		mysqli_close($enlace);
		return $resultado;
	} 
	
	public function mostrar_todos_servicios(){
		$enlace = $this->conectar();
		$consulta = "SELECT id_servicio, nombre_servicio FROM servicio";
		$resultado = mysqli_query($enlace, $consulta);		
		mysqli_close($enlace);
		return $resultado;
	} 
	public function notamedia($idservicio){
		$this->conectar();
		$pst=$this->conexion->prepare("SELECT avg(nota) from valoracion_servicio,servicio where servicio.id_servicio=? and servicio.id_servicio=valoracion_servicio.id_servicio");
		$pst->bind_param("s",$idservicio);
		$pst->execute();
		$pst->bind_result($nota);
		$pst->fetch();
		$pst->close();
		return $nota;
	}
	
	/**
	 * Obtiene todas las solicitudes que le han hecho al usuario pasado por parámetro
	 * @param $id_usuario 
	 * @return las solicitudes obtenidas
	 */
	public function conseguirSolicitudes($id_usuario){
		$this->conectar();
		$pst = $this->conexion->prepare("SELECT * FROM usuario_solicita_servicio join servicio where servicio.id_usuario = ? 
		and usuario_solicita_servicio.id_servicio = servicio.id_servicio");
		$pst->bind_param("i", $id_usuario);
		$pst->execute();
		$resultado =  $pst->get_result();
		
		$pst->close();
		$this->cerrar();
		
		return $resultado;
		
	}
	
	public function busqueda($nombre){
		$this->conectar();
		$args = array($nombre);
		$ret = array();
		$i=0;
		//Escapamos los datos obtenidos del formulario
		$this->escapaBd($args);
		$args[0]="%".$args[0]."%";
		$pst =  $this->conexion->prepare("select nombre,apellidos,usuario.foto,nombre_servicio,descripcion,usuario.id_usuario,servicio.id_servicio from usuario,servicio where nombre_servicio like ? and usuario.id_usuario=servicio.id_usuario ");
		$pst->bind_param("s", $args[0]);
		$pst->execute();
		$pst->bind_result($nombre,$apellidos,$foto,$nomservicio,$decripcion,$idusuario,$idservicio);
		while($pst->fetch()){
			$info = array($nombre,$apellidos,$foto,$nomservicio,$decripcion,$idusuario,$idservicio);
			$ret[$i]=$info;
			$i=$i+1;
		}
		$pst->close();
		return $ret;
	}
	
		public function busquedaavanzada($corte,$id){
		$this->conectar();
		$ret = array();
		$i=0;
		
		//Escapamos los datos obtenidos del formulario
		$pst =  $this->conexion->prepare("select distinct nombre,apellidos,usuario.foto,nombre_servicio,descripcion,usuario.id_usuario,servicio.id_servicio,nota from usuario,servicio,valoracion_servicio where usuario.id_usuario=servicio.id_usuario and valoracion_servicio.id_servicio=servicio.id_servicio and servicio.id_usuario<>? and valoracion_servicio.id_usuario=? and nota>=? ");
		$pst->bind_param("sss",$id,$id,$corte);
		$pst->execute();
		$pst->bind_result($nombre,$apellidos,$foto,$nomservicio,$decripcion,$idusuario,$idservicio,$nota);
		echo"<p>".$nomservicio."</p>";
		while($pst->fetch()){
			$info = array($nombre,$apellidos,$foto,$nomservicio,$decripcion,$idusuario,$idservicio,$nota);
			$ret[$i]=$info;
			$i=$i+1;
		}
		$pst->close();
		return $ret;
	
	}
}