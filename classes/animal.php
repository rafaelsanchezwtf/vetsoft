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

		public static function validar_completitud($animal){
			$flag = FALSE;
			if (is_empty($animal->get('nombre'))){
            	$flag = TRUE;
        	}
        	if (is_empty($animal->get('fecha_de_nacimiento'))){
            	$flag = TRUE;
	        }
	        if (is_empty($animal->get('peso'))){
	            $flag = TRUE;
	        }
	        if (is_empty($animal->get('talla'))){
	            $flag = TRUE;
	        }
	        if (is_empty($animal->get('genero'))){
	            $flag = TRUE;
	        }
	        if (is_empty($animal->get('especie'))){
	            $flag = TRUE;
	        }
        	RETURN $flag;
		}

		public static function validateDate($date, $format = 'Y-m-d'){
	        $d = DateTime::createFromFormat($format, $date);
	        return $d && $d->format($format) == $date;
    	}

    	public static function validar_correctitud($animal){
    		$flag = FALSE;
    		if(!(self::validateDate($animal->get('fecha_de_nacimiento')))){
    			$flag = TRUE;	
    		}
    		if ((!is_numeric($animal->get('peso'))) or ($animal->get('peso') <= 0)){
	            $flag = TRUE;     
	        }

	        if ((!is_numeric($animal->get('talla'))) or ($animal->get('talla') <= 0)){
	            $flag = TRUE;      
	        }
	        RETURN $flag;
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