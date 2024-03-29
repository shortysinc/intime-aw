<?php
require_once 'formato_fecha.php';

/**
 * clase que sirve de etidad para una solicitud
 */
class Solicitud {
	public $id_solicitud,
		   $id_usuario,
		   $id_servicio,
		   $estado,
		   $fecha,
		   $inicio,
		   $fin,
		   $comentario;
	
	public function __construct($id_solicitud, $id_usuario, $id_servicio, $estado, $fecha, $inicio, $fin, $comentario){
		$this->id_solicitud = $id_solicitud;
		$this->id_usuario = $id_usuario;
	    $this->id_servicio = $id_servicio;
   	    $this->estado = $estado;
		$this->fecha = $fecha;
		$this->inicio = $inicio;
		$this->fin = $fin;
		$this->comentario = $comentario;
	}
	
	/**
	 * Convierte el entero que representa el estado de una solicitud a cadena.
	 * @param $estado
	 * @return el estado parseado a cadena si el número está definido como estado. Null en caso contrario.
	 */
	public static function parsearEstado($estado){
		$cadena = NULL;
		if($estado == 0){
			$cadena = "Pendiente";
		}else if($estado == 1){
			$cadena = "Aceptada";
		}else if($estado == 2){
			$cadena = "Rechazada";
		}
		
		return $cadena;
	}
	
	/**
	 * Comprueba si la solicitud representada por su id está dentro del array de solicitudes.
	 * @param $id: id de la solicitud
	 * @param $solicitudes: array de solicitudes en el que se quiere buscar la solicitud representada por el parámetro $id
	 */
	public static function estaDentro($id, $solicitudes){
		$len = count($solicitudes);
		$encontrada = false;
		$i = 0;
		while (!$encontrada && $i < $len) {
			$solicitud = $solicitudes[$i];
			if($solicitud->getIdSolicitud() == $id){
				$encontrada = true;
			}
			$i++;
		}
		
		return $encontrada;
	}
	
	
	public function getIdSolicitud(){
		return $this->id_solicitud;
	}
	
	public function getIdUsuario(){
		return $this->id_usuario;
	}
	
	public function getIdServicio(){
		return $this->id_servicio;
	}
	
	public function getEstado(){
		return $this->estado;
	}
	
	public function getFecha(){
		return $this->fecha;
	}
	
	public function getInicio(){
		return $this->inicio;
	}
	
	public function getFin(){
		return $this->fin;
	}
	
	public function getFechaFormateada(){
		$date = new DateTime($this->fecha);
		return $date->format(FormatoFecha::dateFormat);
	}
	
	public function getInicioFormateada(){
		$date = new DateTime($this->inicio);
		return $date->format(FormatoFecha::dateFormat);
	}
	
	public function getFinFormateada(){
		$date = new DateTime($this->fin);
		return $date->format(FormatoFecha::dateFormat);
	}
	
	public function getComentario(){
		return $this->comentario;
	}
}
