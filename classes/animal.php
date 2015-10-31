<?php
	
	class animal extends object_standard{

		protected $id;
		protected $nombre;
		protected $foto;
		protected $fecha_de_nacimiento;
		protected $peso;
		protected $talla;
		protected $genero;
		protected $especie;
		protected $dueno;

		var $components = array();

		var $auxiliars = array();

		public function metadata(){
			return array("id" => array(), "nombre" => array(), "foto" => array(), "fecha_de_nacimiento" => array(), "peso" => array(), "talla" => array(), "genero" => array(), "especie" => array(), "dueno" => array("foreign_name" => "a_d","foreign" => "dueno", "foreign_attribute" =>"cedula")); 
		}

		public function primary_key(){
			return array("id");
		}

		public function relational_keys($class, $rel_name){
			switch($class){
				case "dueno":
					switch ($rel_name) {
							case "a_d":
								return array("dueno");
								break;
					}
				break;
					
			    default:
				break;
			}
		}

	}

?>