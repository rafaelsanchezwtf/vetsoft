<?php

require('configs/include.php');
require('modules/m_phpass/PasswordHash.php');

class c_asignar_tratamiento extends super_controller {

    public function asignar_datos($tratamiento){
        $this->engine->assign('titulo_t',$tratamiento->get('titulo'));
        $this->engine->assign('descripcion_t',$tratamiento->get('descripcion'));
        $this->engine->assign('fecha_t',$tratamiento->get('fecha'));
        $this->engine->assign('hora_t',$tratamiento->get('hora'));     
        $this->engine->assign('lugar_t',$tratamiento->get('lugar'));
    }

    public function asignar_vacios($tratamiento){
        if (is_empty($tratamiento->get('titulo'))){
            $this->engine->assign("titulo_t_vacio",0);
        }
        if (is_empty($tratamiento->get('descripcion'))){
            $this->engine->assign("descripcion_t_vacio",0);
        }
        if (is_empty($tratamiento->get('fecha'))){
            $this->engine->assign("fecha_t_vacio",0);
        }
        if (is_empty($tratamiento->get('hora'))){
            $this->engine->assign("hora_t_vacio",0);
        }
        if (is_empty($tratamiento->get('lugar'))){
            $this->engine->assign("lugar_t_vacio",0);
        }
     }

     public function asignar_invalidos($tratamiento){
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

        if((!($tratamiento->validateDate($tratamiento->get('fecha')))) OR ($tratamiento->get('fecha') < $fecha_actual)){
            $this->engine->assign('fecha_t_invalido',0);   
        }
        if((!($tratamiento->validateTime($tratamiento->get('hora')))) OR (($tratamiento->get('fecha') == $fecha_actual) AND ($tratamiento->get('hora') <= $hora_actual))){
            $this->engine->assign('hora_t_invalido',0);
        }
     }

    public function asignar(){

        $this->engine->assign('nombre_animal',$this->post->nombre_animal);
        $n = $this->post->nombre_animal;
        $tratamiento = new tratamiento($this->post);
        $tratamiento->set('estado','pendiente');
        
        if ($this->session['idcita'] != ""){
            $option['cita']['lvl2']= "por_codigo";
            $cod['cita']['codigo'] = $this->session['idcita'];
            $this->orm->connect();
            $this->orm->read_data(array("cita"), $option, $cod);
            $citaux = $this->orm->get_objects("cita");
            
            $tratamiento->set('animal',$citaux[0]->get('animal'));
            $tratamiento->set('veterinario',$citaux[0]->get('veterinario'));
            $_SESSION['idcita'] = "";
            $this->session = $_SESSION;
        }else{
            $tratamiento->set('animal',$this->post->id);
            $tratamiento->set('veterinario',$this->session['usuario']['identificacion']);    
        }
        
        self::asignar_datos($tratamiento);
        $incompletitud_tratamiento = tratamiento::validar_completitud($tratamiento);

        if ($incompletitud_tratamiento){
            self::asignar_vacios($tratamiento);
            $this->mensaje("warning","Error","","Hay campos vacíos");
            throw_exception("");  
        }

        $incorrectitud_tratamiento = tratamiento::validar_correctitud($tratamiento);

        if ($incorrectitud_tratamiento){
            self::asignar_invalidos($tratamiento);
            $this->mensaje("warning","Error","","Hay datos inválidos");
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

        $option['tratamiento']['lvl2']="all";
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
        $this->orm->insert_data("normal",$tratamiento);
        $this->orm->close();

        $dir=$gvar['l_global']."buscar_animal.php";
        $this->mensaje("check-circle","Confirmación",$dir,"Tratamiento Asignado exitosamente!");

    }

    public function cancelar(){
        $msg_dir=$gvar['l_global']."buscar_animal.php";
        $this->mensaje("info","Informacion",$msg_dir,"Operacion cancelada por el veterinario");
    }

    public function display(){
        $this->engine->assign('title', "Asignar Tratamiento");
        $this->engine->assign('nombre',$this->session['usuario']['nombre']);
        $this->engine->assign('identificacion',$this->session['usuario']['identificacion']);
        $this->engine->assign('tipo',$this->session['usuario']['tipo']);
        $this->engine->assign('nombre_animal',$this->post->nombre);
        $this->engine->assign('id_animal',$this->post->id);
        $this->engine->display('cabecera.tpl');
        if (($this->session['usuario']['tipo'] == "veterinario")) {
            $this->engine->display($this->temp_aux);
            $this->engine->display('asignar_tratamiento.tpl');
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
                if ($this->get->option == "asignar"){
                    $this->{$this->get->option}();
                }elseif ($this->get->option == "asignar"){
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
    $call = new c_asignar_tratamiento();
    $call->run();
?>
