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

		public static function validar_completitud($producto){
			$flag = FALSE;
			if (is_empty($producto->get('nombre'))){
            	$flag = TRUE;
        	}
        	if (is_empty($producto->get('cantidad'))){
            	$flag = TRUE;
	        }
	        if (is_empty($producto->get('marca'))){
	            $flag = TRUE;
	        }
	        if ($producto->get('tipo') == "seleccion"){
	            $flag = TRUE;
	        }
        	RETURN $flag;
		}

		public static function validar_correctitud($producto){
    		$flag = FALSE;
    		if ((!is_numeric($producto->get('cantidad'))) OR ($producto->get('cantidad') <= 0)){
	            $flag = TRUE;     
	        }

	        if (($producto->get('tipo') != "medicamento") AND ($producto->get('tipo') != "implemento")){
	            $flag = TRUE;   
        	}
	        RETURN $flag;
    	}

		public function relational_keys($class, $rel_name){
			switch ($class) {
				
				default:
				break;
			}
		}
	}
?>