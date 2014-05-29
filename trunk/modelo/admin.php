<?php
class Admin {
	private $id;
	private $correo;
	private $pass;
	private $salt;
	
	public function __construct($id, $correo, $pass, $salt){
		$this->id = $id;
		$this->correo = $correo;
		$this->pass = $pass;
		$this->salt = $salt;
	}
	
	public function getCorreo(){
		return $this->correo;
	}
	
	public function getPass(){
		return $this->pass;
	}
	
	public function getSalt(){
		return $this->salt;
	}
}
