<?php
require_once '../controlador/formato_fecha.php';

class Respuesta {
	public $id_respuesta, 
		   $id_usuario, 
		   $id_solicitud, 
		   $comentario, 
		   $fecha;
	
		   
	public function __construct($id_respuesta, $id_usuario, $id_solicitud, $comentario, $fecha) {
		$this->id_respuesta = $id_respuesta;
		$this->id_usuario = $id_usuario;
		$this->id_solicitud = $id_solicitud;
		$this->comentario = $comentario;
		$this->fecha =	$fecha;
	}
	
	public function getIdUsuario(){
		return $this->id_usuario;
	}
	
	public function getComentario() {
		return $this->comentario;
	}
	
	public function getFecha() {
		return $this->fecha;
	}
	
	public function getFechaFormateada(){
		$date = new DateTime($this->fecha);
		return $date->format(FormatoFecha::dateFormat);
	}
}
