<?php
	
	class producto extends object_standard{

		protected $id;
		protected $nombre;
		protected $cantidad;
		protected $fecha_de_adqusicion;
		protected $marca;
		protected $tipo;

		var $components = array();

		var $auxiliars = array();

		public function metadata(){
			return array("id" => array(), "nombre" => array(), "cantidad" => array(), "fecha_de_adqusicion" => array(), "marca" => array(), "tipo" => array()); 
		}

		public function primary_key(){
			return array("id");
		}

		public function relational_keys($class, $rel_name){
			switch ($class) {
				
				default:
				break;
			}
		}
	}
?>