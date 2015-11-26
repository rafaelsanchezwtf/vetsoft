<?php

require('configs/include.php');
require('modules/m_phpass/PasswordHash.php');

class c_asignar_cita extends super_controller {

    public function asignar_datos($cita){
        $this->engine->assign('motivo_c',$cita->get('motivo'));
        $this->engine->assign('fecha_c',$cita->get('fecha'));
        $this->engine->assign('hora_c',$cita->get('hora'));     
        $this->engine->assign('lugar_c',$cita->get('lugar'));
    }

    public function asignar_vacios($cita){
        if ($cita->get('veterinario') == "seleccion"){
            $this->engine->assign("vet_c_vacio",0);
        }
        if (is_empty($cita->get('motivo'))){
            $this->engine->assign("motivo_c_vacio",0);
        }
        if (is_empty($cita->get('fecha'))){
            $this->engine->assign("fecha_c_vacio",0);
        }
        if (is_empty($cita->get('hora'))){
            $this->engine->assign("hora_c_vacio",0);
        }
        if (is_empty($cita->get('lugar'))){
            $this->engine->assign("lugar_c_vacio",0);
        }
     }

     public function asignar_invalidos($cita, $variable){
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

        if((!($cita->validateDate($cita->get('fecha')))) OR ($cita->get('fecha') < $fecha_actual)){
            $this->engine->assign('fecha_c_invalido',0);   
        }
        if((!($cita->validateTime($cita->get('hora')))) OR (($cita->get('fecha') == $fecha_actual) AND ($cita->get('hora') <= $hora_actual))){
            $this->engine->assign('hora_c_invalido',0);
        }
        foreach($variable as $veterinario){
            if ($cita->get('veterinario') == $veterinario->get('identificacion')){
                $cont = 1;
                break;
            }
        }
        if ($cont==0){
            $this->engine->assign('vet_c_invalido',0);       
        }
     }

    public function asignar_por_administrador(){
        
        $option['veterinario']['lvl2']="all";
        $this->orm->connect();
        $this->orm->read_data(array("veterinario"), $option);
        $variable = $this->orm->get_objects("veterinario");

        $this->engine->assign('nombre_animal',$this->post->nombre_animal);
        $cita = new cita($this->post);
        $cita->set('estado','pendiente');
        $cita->set('animal',$this->post->id);

        self::asignar_datos($cita);
        $incompletitud_cita = cita::validar_completitud($cita);

        if ($incompletitud_cita){
            self::asignar_vacios($cita);
            $this->mensaje("warning","Error","","Hay campos vacíos");
            throw_exception("");  
        }

        $incorrectitud_cita = cita::validar_correctitud($cita, $variable);

        if ($incorrectitud_cita){
            self::asignar_invalidos($cita, $variable);
            $this->mensaje("warning","Error","","Hay datos inválidos");
            throw_exception("");  
        }

        $hora_comp = $cita->get('hora') . ":00";

        $option['cita']['lvl2']="all";
        $this->orm->connect();
        $this->orm->read_data(array("cita"), $option);
        $citas = $this->orm->get_objects("cita");
        
        if (!(is_empty($citas))){
            foreach($citas as $cita_aux){
                if (($cita_aux->get('fecha') == $cita->get('fecha')) AND ($cita_aux->get('hora') == $hora_comp) AND ($cita_aux->get('animal') == $cita->get('animal'))){
                    $this->mensaje("warning","Error","","Ya existe una cita en esa fecha y hora para este animal");
                    throw_exception(""); 
                }
            }
        }

        if (!(is_empty($citas))){
            foreach($citas as $cita_aux){
                if (($cita_aux->get('fecha') == $cita->get('fecha')) AND ($cita_aux->get('hora') == $hora_comp) AND ($cita_aux->get('veterinario') == $cita->get('veterinario'))){
                    $this->mensaje("warning","Error","","Ya existe una cita en esa fecha y hora para este veterinario");
                    throw_exception(""); 
                }
            }
        }

        $option['tratamiento']['lvl2']="all";
        $this->orm->connect();
        $this->orm->read_data(array("tratamiento"), $option);
        $tratamientos = $this->orm->get_objects("tratamiento");

        if (!(is_empty($tratamientos))){
            foreach($tratamientos as $tr_aux){    
                if (($tr_aux->get('fecha') == $cita->get('fecha')) AND ($tr_aux->get('hora') == $hora_comp) AND ($tr_aux->get('animal') == $cita->get('animal'))){
                    $this->mensaje("warning","Error","","Ya existe un tratamiento en esa fecha y hora para este animal");
                    throw_exception(""); 
                }
            }
        }

        if (!(is_empty($tratamientos))){
            foreach($tratamientos as $tr_aux){    
                if (($tr_aux->get('fecha') == $cita->get('fecha')) AND ($tr_aux->get('hora') == $hora_comp) AND ($tr_aux->get('veterinario') == $cita->get('veterinario'))){
                    $this->mensaje("warning","Error","","Ya existe un tratamiento en esa fecha y hora para este veterinario");
                    throw_exception(""); 
                }
            }
        }

        $this->orm->connect();
        $this->orm->insert_data("normal",$cita);
        $this->orm->close();

        $dir=$gvar['l_global']."buscar_animal.php";
        $this->mensaje("check-circle","Confirmación",$dir,"Cita asignada exitosamente!");

    }

    public function asignar_por_veterinario(){

        $option['veterinario']['lvl2']="all";
        $this->orm->connect();
        $this->orm->read_data(array("veterinario"), $option);
        $variable = $this->orm->get_objects("veterinario");

        $this->engine->assign('nombre_animal',$this->post->nombre_animal);
        $cita = new cita($this->post);
        $cita->set('estado','pendiente');
        $cita->set('animal',$this->post->id);
        $cita->set('veterinario',$this->session['usuario']['identificacion']);

        self::asignar_datos($cita);
        $incompletitud_cita = cita::validar_completitud($cita);

        if ($incompletitud_cita){
            self::asignar_vacios($cita);
            $this->mensaje("warning","Error","","Hay campos vacíos");
            throw_exception("");  
        }

        $incorrectitud_cita = cita::validar_correctitud($cita, $variable);

        if ($incorrectitud_cita){
            self::asignar_invalidos($cita, $variable);
            $this->mensaje("warning","Error","","Hay datos inválidos");
            throw_exception("");  
        }

        $hora_comp = $cita->get('hora') . ":00";

        $option['cita']['lvl2']="all";
        $this->orm->connect();
        $this->orm->read_data(array("cita"), $option);
        $citas = $this->orm->get_objects("cita");
        
        if (!(is_empty($citas))){
            foreach($citas as $cita_aux){
                if (($cita_aux->get('fecha') == $cita->get('fecha')) AND ($cita_aux->get('hora') == $hora_comp) AND ($cita_aux->get('animal') == $cita->get('animal'))){
                    $this->mensaje("warning","Error","","Ya existe una cita en esa fecha y hora para este animal");
                    throw_exception(""); 
                }
            }
        }

        if (!(is_empty($citas))){
            foreach($citas as $cita_aux){
                if (($cita_aux->get('fecha') == $cita->get('fecha')) AND ($cita_aux->get('hora') == $hora_comp) AND ($cita_aux->get('veterinario') == $cita->get('veterinario'))){
                    $this->mensaje("warning","Error","","Ya existe una cita en esa fecha y hora para usted");
                    throw_exception(""); 
                }
            }
        }

        $option['tratamiento']['lvl2']="all";
        $this->orm->connect();
        $this->orm->read_data(array("tratamiento"), $option);
        $tratamientos = $this->orm->get_objects("tratamiento");

        if (!(is_empty($tratamientos))){
            foreach($tratamientos as $tr_aux){    
                if (($tr_aux->get('fecha') == $cita->get('fecha')) AND ($tr_aux->get('hora') == $hora_comp) AND ($tr_aux->get('animal') == $cita->get('animal'))){
                    $this->mensaje("warning","Error","","Ya existe un tratamiento en esa fecha y hora para este animal");
                    throw_exception(""); 
                }
            }
        }

        if (!(is_empty($tratamientos))){
            foreach($tratamientos as $tr_aux){    
                if (($tr_aux->get('fecha') == $cita->get('fecha')) AND ($tr_aux->get('hora') == $hora_comp) AND ($tr_aux->get('veterinario') == $cita->get('veterinario'))){
                    $this->mensaje("warning","Error","","Ya existe un tratamiento en esa fecha y hora para usted");
                    throw_exception(""); 
                }
            }
        }

        $this->orm->connect();
        $this->orm->insert_data("normal",$cita);
        $this->orm->close();

        $dir=$gvar['l_global']."buscar_animal.php";
        $this->mensaje("check-circle","Confirmación",$dir,"Cita asignada exitosamente!");

    }

    public function cancelar(){
        $msg_dir=$gvar['l_global']."buscar_animal.php";
        $this->mensaje("info","Informacion",$msg_dir,"Operacion cancelada");
    }

    public function display(){
        $this->engine->assign('title', "Asignar Cita");
        $this->engine->assign('nombre',$this->session['usuario']['nombre']);
        $this->engine->assign('identificacion',$this->session['usuario']['identificacion']);
        $this->engine->assign('tipo',$this->session['usuario']['tipo']);
        $this->engine->assign('nombre_animal',$this->post->nombre);
        $this->engine->assign('id_animal',$this->post->id);
        $this->engine->display('cabecera.tpl');
        if (($this->session['usuario']['tipo'] == "administrador") OR ($this->session['usuario']['tipo'] == "veterinario")) {

            $option['veterinario']['lvl2']="all";
            $this->orm->connect();
            $this->orm->read_data(array("veterinario"), $option);
            $variable = $this->orm->get_objects("veterinario");
            $this->engine->assign('objeto',$variable);

            $this->engine->display($this->temp_aux);
            $this->engine->display('asignar_cita.tpl');
        }else{
            $direccion=$gvar['l_global']."index.php";
            $this->mensaje("warning","Informacion",$direccion,"Lo sentimos, usted no tiene permisos para acceder");
            $this->engine->display($this->temp_aux); 
        }
        $this->engine->display('piedepagina.tpl');
    }
    
    public function run() {
        try {
            if (isset($this->get->option)) {
                if ($this->get->option == "asignar_por_administrador"){
                    $this->{$this->get->option}();
                }elseif ($this->get->option == "asignar_por_veterinario"){
                    $this->{$this->get->option}();
                }elseif ($this->get->option == "cancelar"){
                    $this->{$this->get->option}();
                }else{
                    throw_exception("Opción ". $this->get->option." no disponible");
                }
            }
        }catch (Exception $e) {
            $this->error=1;
            $this->msg_warning=$e->getMessage();
            $this->temp_aux = 'message.tpl';
            $this->engine->assign('type_warning',$this->type_warning);
            $this->engine->assign('msg_warning',$this->msg_warning);
        }
        $this->display();
    }
        
}
    $call = new c_asignar_cita();
    $call->run();
?>