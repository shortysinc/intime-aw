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
	
	public function insertarUsuarioRegistro($correo, $nombre, $apellidos, $direccion, $pass) {
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
		
		$pst = "insert into usuario (correo, nombre, apellidos, direccion, pass, salt) values 
		(?, '?', '?', '?', '?', '?')";
		$pst->bind_result($correo);
		$pst->bind_result($nombre);
		$pst->bind_result($apellidos);
		$pst->bind_result($direccion);
		$pst->bind_result($pass);
		$pst->bind_result($salt);
		$pst->fetch();
		$pst->close();
		//$resultado = mysqli_query($this->conexion,$consulta);
		$this->cerrar();
		unset($consulta);
		
		return $resultado;
	}
	
	public function mostrar_usuarios(){
		$this->conectar();
		// Check connection
		if (mysqli_connect_errno()) {
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
		}
		$result = mysqli_query($con,"SELECT * FROM usuario");
		
		while($row = mysqli_fetch_array($result)) {
		  echo $row['id_usuario'] . " " . $row['nombre'];
		  echo "<br>";
		}
		
		mysqli_close($con);
	} 
	
}

?>