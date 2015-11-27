<?php

require('configs/include.php');

class c_editar_tratamiento extends super_controller {
    
    public function asignar_datos_tratamiento($codigo,$titulo,$descripcion, $fecha,$hora, $lugar, $animal,$veterinario){
        $this->engine->assign('codigo',$codigo);
        $this->engine->assign('titulo',$titulo);
        $this->engine->assign('descripcion',$descripcion);
        $this->engine->assign('titulo',$titulo);
        $this->engine->assign('fecha',$fecha);
        
        if(strlen($hora)==8){
            $hora = substr($hora,0,-3);
        }
        
        $this->engine->assign('hora',$hora);
        $this->engine->assign('lugar',$lugar); 
        $this->engine->assign('animal',$animal); 
         $this->engine->assign('veterinario',$veterinario);
    }
    public function asignar_vacios_tratamiento($titulo,$descripcion, $fecha,$hora, $lugar){
        $vs = false;
        if (is_empty($titulo)){
            $this->engine->assign("titulo_vacio",0); $vs=true;
        }
        if (is_empty($descripcion)){
            $this->engine->assign("descripcion_vacio",0); $vs=true;
        }
        if (is_empty($fecha)){
            $this->engine->assign("fecha_vacio",0); $vs=true;
        }
        if (is_empty($hora)){
            $this->engine->assign("hora_vacio",0); $vs=true;
        }
        if (is_empty($lugar)){
            $this->engine->assign("lugar_vacio",0); $vs=true;
        }
    return $vs;
 
    }
      
    public function asignar_invalidos_tratamiento($tratamiento){
        $cont = 0;
        $v=false;
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
        if ($hoy['seconds']<10){
            $segundos = "0" . $hoy['seconds'];
        }else{
            $segundos = $hoy['seconds'];
        }
        $hora_actual = $hora . ":" . $minutos . ":" . $segundos;

        
        if((!(tratamiento::validateDate($tratamiento->get('fecha')))) or ($tratamiento->get('fecha') < $fecha_actual)){
            $this->engine->assign("fecha_invalido",0);
            $v=true;
        }
        // Validacion del formato de entrada HH:mm
        if((!($tratamiento->validateTime($tratamiento->get('hora')))) OR (($tratamiento->get('fecha') == $fecha_actual) AND ($tratamiento->get('hora') <= $hora_actual))){
            
            $this->engine->assign('hora_t_invalido',0);
            $v=true;
        }
       
        
  
        return $v;
    }
   
    
    public function actualizar(){
        
        
        
        $vaciostratamiento = self::asignar_vacios_tratamiento($this->post->titulo,$this->post->descripcion,$this->post->fecha,$this->post->hora,$this->post->lugar);  
        
        
        $tratamiento = new tratamiento($this->post);
        
        //print_r2($tratamiento);
        $incorrectostratamiento = self::asignar_invalidos_tratamiento($tratamiento);
        
        
        
        
        if($vaciostratamiento){
            $this->mensaje("warning","Error","","Hay campos vacíos");
            throw_exception("");
        }
        if($incorrectostratamiento){
            $this->mensaje("warning","Error","","Hay datos invalidos");
            throw_exception("");
        }
        
        
        $hora_comp = $tratamiento->get('hora') . ":00";

        $option['cita']['lvl2']="all";
        $this->orm->connect();
        $this->orm->read_data(array("cita"), $option);
        $citas = $this->orm->get_objects("cita");
        
        if (!(is_empty($citas))){
            foreach($citas as $cita){
                if (($cita->get('fecha') == $tratamiento->get('fecha')) AND ($cita->get('hora') == $hora_comp) AND ($cita->get('animal') == $tratamiento->get('animal'))){
                    $this->mensaje("warning","Error","","Ya existe una cita en esa fecha y hora para este animal");
                    throw_exception(""); 
                }
            }
        }
         if (!(is_empty($citas))){
            foreach($citas as $cita_aux){
                if (($cita_aux->get('fecha') == $tratamiento->get('fecha')) AND ($cita_aux->get('hora') == $hora_comp) AND ($cita_aux->get('veterinario') == $tratamiento->get('veterinario'))){
                    $this->mensaje("warning","Error","","Ya existe una cita en esa fecha y hora para usted");
                    throw_exception(""); 
                }
            }
        }
        $option['tratamiento']['lvl2']="all_2";
        $this->orm->connect();
        $this->orm->read_data(array("tratamiento"), $option);
        $tratamientos = $this->orm->get_objects("tratamiento");

        if (!(is_empty($tratamientos))){
            foreach($tratamientos as $tr_aux){    
                if (($tr_aux->get('fecha') == $tratamiento->get('fecha')) AND ($tr_aux->get('hora') == $hora_comp) AND ($tr_aux->get('animal') == $tratamiento->get('animal'))){
                    $this->mensaje("warning","Error","","Ya existe un tratamiento en esa fecha y hora para este animal");
                    throw_exception(""); 
                }
            }
        }

        if (!(is_empty($tratamientos))){
            foreach($tratamientos as $tr_aux){    
                if (($tr_aux->get('fecha') == $tratamiento->get('fecha')) AND ($tr_aux->get('hora') == $hora_comp) AND ($tr_aux->get('veterinario') == $tratamiento->get('veterinario'))){
                    $this->mensaje("warning","Error","","Ya existe un tratamiento en esa fecha y hora para usted");
                    throw_exception("");
                }
            }
        }

        $this->orm->connect();    
        
        $this->orm->update_data("normal",$tratamiento);
        
        $this->orm->close();
        
        $dir = $gvar['l_global']."buscar_tratamiento.php";
        $this->mensaje("warning","Confirmacion",$dir,"Edicion exitosa"); 
    
    }
    public function mostrarEditables(){
        
        // Se realizan los assign para mostrarsen en el tpl, los valores son los que se tenian
        // en los inputs en el ultimo submit
        
        self::asignar_datos_tratamiento($this->post->codigo,$this->post->titulo,$this->post->descripcion,$this->post->fecha,$this->post->hora,$this->post->lugar,$this->post->animal,$this->post->veterinario);
    }

    public function cancelar(){
        $dir = $gvar['l_global']."buscar_tratamiento.php";
        $this->mensaje("warning","Información",$dir,"Operacion cancelada por el veterinario");
    }
    
    public function display(){
        $this->engine->assign('title', "Editar Tratamiento");
        $this->engine->assign('nombre',$this->session['usuario']['nombre']);
        $this->engine->assign('tipo',$this->session['usuario']['tipo']);
        $this->engine->display('cabecera.tpl');
        if ($this->session['usuario']['tipo'] == "veterinario"){
            $this->engine->display($this->temp_aux);
            $this->engine->display('editar_tratamiento.tpl');
        }else{
            $direccion=$gvar['l_global']."index.php";
            $this->mensaje("warning","Informacion",$direccion,"Lo sentimos, usted no tiene permisos para acceder");
            $this->engine->display($this->temp_aux); 
        }
        $this->engine->display('piedepagina.tpl');
    }
    
    public function run(){
        try {
            if(isset($this->get->option)){
                if($this->get->option=="cancelar"){
                    $this->{$this->get->option}();}
                else if($this->get->option=="actualizar"){
                    $this->{$this->get->option}();
                }
                
                else{throw_exception("Opción ". $this->get->option." no disponible");}
            }
           
            else if(isset($this->post->codigo)){ 
                $this->mostrarEditables();
            }
            else{
             
            }
        } catch (Exception $e) {
            $this->error=1;
            $this->msg_warning=$e->getMessage();
            $this->temp_aux = 'message.tpl';
            $this->engine->assign('type_warning',$this->type_warning);
            $this->engine->assign('msg_warning',$this->msg_warning);
            $this->mostrarEditables();
            }
        $this->display();
    }
        
}

    $call = new c_editar_tratamiento();
    $call->run();


?>