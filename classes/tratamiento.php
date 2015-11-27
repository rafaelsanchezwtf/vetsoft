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

		public static function validar_completitud($tratamiento){
			$flag = FALSE;
			if (is_empty($tratamiento->get('titulo'))){
            	$flag = TRUE;
		    }
		    if (is_empty($tratamiento->get('descripcion'))){
		        $flag = TRUE;
		    }
		    if (is_empty($tratamiento->get('fecha'))){
		        $flag = TRUE;
		    }
		    if (is_empty($tratamiento->get('hora'))){
		        $flag = TRUE;
		    }
		    if (is_empty($tratamiento->get('lugar'))){
		        $flag = TRUE;
		    }
		    RETURN $flag;
		}

		public static function validar_correctitud($tratamiento){
			$flag = FALSE;
			$cont = 0;
			$hoy = getdate();
			$año = $hoy['year'];
		    if ($hoy['mon']<10){
		        $mes = "0" . $hoy['mon'];
		    }else{
		    	$mes = $hoy['mon'];
		    }
		    if ($hoy['mday']<10){
		        $dia = "0" . $hoy['mday'];
		    }else{
		    	$dia = $hoy['mday'];
		    }
        	$fecha_actual = $año . "-" . $mes . "-" . $dia;
			$hoy['hours'] = $hoy['hours']-6;
			if ($hoy['hours']<0){
           		$hora = 24  +  $hoy['hours'];
        	}elseif ($hoy['hours']>=0 AND $hoy['hours']<10){
            	$hora = "0" . $hoy['hours'];
        	}else{
            	$hora = $hoy['hours'];
        	}
        	if ($hoy['hours'] == "0"){
            	$hora = "00";
        	}
        	if ($hoy['minutes']<10){
            	$minutos = "0" . $hoy['minutes'];
        	}else{
        		$minutos = $hoy['minutes'];
        	}
        	$hora_actual = $hora . ":" . $minutos;
        	if((!(parent::validateDate($tratamiento->get('fecha')))) or ($tratamiento->get('fecha') < $fecha_actual)){
    			$flag = TRUE;	
    		}
    		if((!(parent::validateTime($tratamiento->get('hora')))) OR (($tratamiento->get('fecha') == $fecha_actual) AND ($tratamiento->get('hora') <= $hora_actual))){
    			$flag = TRUE;	
    		}
    		RETURN $flag;
		}

		public function primary_key(){
			return array("fecha","hora","animal");
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