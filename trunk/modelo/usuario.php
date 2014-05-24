<?php
	/**
	 * Clase que sirve de entidad para un usuario
	 */
	class Usuario {
		private $id;
		private $correo;
		private $nombre;
		private $apellidos;
		private $direccion;
		private $horas;
		private $foto;
		private $pass;
		private $salt;
		
		function __construct($id, $correo, $nombre, $apellidos, $direccion, $horas, $foto, $pass, $salt) {
			$this->id = $id;
			$this->correo = $correo;
			$this->nombre = $nombre;
			$this->apellidos = $apellidos;
			$this->direccion = $direccion;
			$this->horas = $horas;
			$this->foto = $foto;
			$this->pass = $pass;
			$this->salt = $salt;
		}
		
		public function getId(){
			
			return $this->id;
		}
		
		public function getCorreo(){
			
			return $this->correo;
		}
		
		public function getNombre(){
			
			return $this->nombre;
		}
		
	}