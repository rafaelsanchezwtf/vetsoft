<?php
	
	class tratamiento extends object_standard
	{
		protected $codigo;
		protected $titulo;
		protected $fecha;
		protected $hora;
		protected $duracion;
		protected $lugar;
		protected $descripcion;
		protected $estado;
		protected $resultado;
		protected $animal;
		protected $veterinario;
		
		var $components = array();
		
		var $auxiliars = array();
		
		public function metadata(){
			return array("codigo" => array(), "titulo" => array(), "fecha" => array(), "hora" => array(), "duracion" => array(), "lugar" => array(), "descripcion" => array(), "estado" => array(), "resultado" => array(),
				"animal" => array("foreign_name" => "t_a", "foreign" => "animal", "foreign_attribute" =>"id"),
				"veterinario" => array("foreign_name" => "t_v", "foreign" => "veterinario", "foreign_attribute" =>"identificacion")); 
		}

		public function primary_key(){
			return array("codigo");
		}

		public function relational_keys($class, $rel_name){
			switch($class){
				case "animal":
					switch ($rel_name) {
							case "t_a":
								return array("animal");
								break;
					}
				break;

				case "veterinario":
					switch ($rel_name) {
							case "t_v":
								return array("veterinario");
								break;
					}
				break;
					
			    default:
				break;
			}
		}
	}
?>