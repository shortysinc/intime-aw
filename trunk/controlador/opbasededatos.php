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

	
	public function mostrar_todos_usuarios(){
		$this->conectar();
		// Check connection
		if (mysqli_connect_errno()) {
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
		}
		$result = mysqli_query($con,"SELECT * FROM usuario");
		//PRUEBA
		while($row = mysqli_fetch_array($result)) {
		  echo $row['id_usuario'] . " " . $row['nombre'];
		  echo "<br>";
		}
		
		mysqli_close($con);
	} 
	
	public function mostrar_todos_servicios(){
		$this->conectar();
		// Check connection
		if (mysqli_connect_errno()) {
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
		}
		$result = mysqli_query($con,"SELECT * FROM servicio");
		//PRUEBA
		while($row = mysqli_fetch_array($result)) {
		  echo $row['id_servicio'] . " " . $row['id_usuario'] . " " . $row['nombre_servicio'];
		  echo "<br>";
		}
		
		mysqli_close($con);
	} 
}
