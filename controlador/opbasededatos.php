<?php
class Mysql{
	private $host="localhost";
	private $user="root";
    private $clave="";
    private $bd="intime";
    private $conexion;  
    private $sql;
	
	public function conectar(){
        $this->conexion=mysqli_connect($this->host,$this->user,$this->clave);
        mysqli_select_db($this->conexion, $this->bd);
    }
	
	 public function cerrar () {
        @mysql_close($this->conexion);
    }
	
	public static function escapaBd() {
		$numargs = func_num_args();
		for($i=0; $i < $numargs; $i++){
			
		}
	}
	
	public function insertarUsuarioRegistro($correo, $nombre, $apellidos, $direccion, $pass) {
		//Mysql::escapaBd($correo, )	
		$this->conectar();
		$correo =  $this->conexion->real_escape_string($correo);
		$nombre =  $this->conexion->real_escape_string($nombre);
		$apellidos =  $this->conexion->real_escape_string($apellidos);
		$direccion =  $this->conexion->real_escape_string($direccion);
		$pass =  $this->conexion->real_escape_string($pass);
		
		//Crea una salt al azar
		$salt = hash('sha512', uniqid(mt_rand(1, mt_getrandmax()), true));
		//Crea una contraseña en salt
		$pass = hash('sha512', $pass.$salt);
		
		$pst =  $this->conexion->prepare("insert into usuario (correo, nombre, apellidos, direccion, pass, salt) values 
		(?, ?, ?, ?, ?, ?)");
		
		$colCorreo = "correo";
		$colNombre = "nombre";
		$colApellidos = "apellidos";
		$colDireccion = "direccion";
		$colPass = "pass";
		$colSalt = "salt";
		
		$pst->bind_param("ssssss", $correo, $nombre, $apellidos, $direccion, $pass, $salt);
		$pst->execute();
		$resultado = $pst->fetch();
		
		$pst->close();
		$this->cerrar();
		
		return $resultado;
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
