<?php
	
	class administrador extends object_standard{

		protected $identificacion;
		protected $nombre;
		protected $telefono;
		protected $email;
		protected $user;
		protected $pass;

		var $components = array();

		var $auxiliars = array();

		public function metadata(){
			return array("identificacion" => array(), "nombre" => array(), "telefono" => array(), "email" => array(), "user" => array(), "pass" => array()); 
		}

		public function primary_key(){
			return array("identificacion");
		}

		public function relational_keys($class, $rel_name){
			switch ($class) {
				
				default:
				break;
			}
		}
	}
?>