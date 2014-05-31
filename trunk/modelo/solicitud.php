<?php
class Solicitud {
	public $id_solicitud,
		   $id_usuario,
		   $id_servicio,
		   $estado,
		   $fecha,
		   $comentario;
	
	public function __construct($id_solicitud, $id_usuario, $id_servicio, $estado, $fecha, $comentario){
		$this->id_solicitud = $id_solicitud;
		$this->id_usuario = $id_usuario;
	    $this->id_servicio = $id_servicio;
   	    $this->estado = $estado;
		$this->fecha = $fecha;
		$this->comentario = $comentario;
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
		
		$date = new DateTime($this->fecha);
		return $date->format('d/m/Y H:i');
	}
	
	public function getComentario(){
		return $this->comentario;
	}
}
