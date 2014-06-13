<?php
require_once '../controlador/formato_fecha.php';

/**
 * Clase que sirve de entidad para una valoracion
 */
class Valoracion {
	private $id_valoracion,
			$id_servicio,
			$id_usuario,
			$nota,
			$opinion,
			$fecha;
			
	public function __construct ($id_valoracion, $id_servicio, $id_usuario, $nota, $opinion, $fecha){
		$this->id_valoracion = $id_valoracion;
		$this->id_servicio = $id_servicio;
		$this->id_usuario = $id_usuario;
		$this->nota = $nota;
		$this->opinion = $opinion;
		$this->fecha = $fecha; 
	}
	
	public function getIdValoracion(){
		return $this->id_valoracion;
	}
	
	public function getIdServicio(){
		return $this->id_servicio;
	}
	
	public function getIdUsuario(){
		return $this->id_usuario;
	}
	
	public function getNota(){
		return $this->nota;
	}
	
	public function getOpinion(){
		return $this->opinion;
	}
	
	public function getFechaFormateada(){
		
		$date = new DateTime($this->fecha);
		return $date->format(FormatoFecha::dateFormat);
	}
	
	public function getFecha(){
		return $this->fecha;
	}
}
