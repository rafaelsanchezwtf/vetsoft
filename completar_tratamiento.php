<?php

require('configs/include.php');
require('modules/m_phpass/PasswordHash.php');

class c_completar_tratamiento extends super_controller {

    public function finalizar(){

        $tratamiento = new tratamiento($this->post);

        $this->engine->assign('duracion_t',$tratamiento->get('duracion'));
        $this->engine->assign('resultado_t',$tratamiento->get('resultado'));

        if (is_empty($tratamiento->get('duracion')) OR is_empty($tratamiento->get('resultado'))){
            if (is_empty($tratamiento->get('duracion'))){
                $this->engine->assign('duracion_t_vacio',0);
            }
            if (is_empty($tratamiento->get('resultado'))){
                $this->engine->assign('resultado_t_vacio',0);
            }
            $this->mensaje("warning","Error","","Hay campos vacíos");
            throw_exception("");  
        }

        $tratamiento->set('estado','finalizado');

        $this->orm->connect();
        $this->orm->update_data("normal_completar",$tratamiento);
        $this->orm->close();

        $msg = "Tratamiento completado satisfactoriamente!";
        $dir=$gvar['l_global']."buscar_tratamiento.php";
        $this->mensaje("check-circle","Confirmación",$dir,$msg);
    }

    public function cancelar(){
        $msg = "Operacion cancelada por el veterinario";
        $dir=$gvar['l_global']."buscar_tratamiento.php";
        $this->mensaje("info","Informacion",$dir,$msg); 
    }

    public function display(){
        $this->engine->assign('title', "Completar Tratamiento");
        if (isset($this->session['desde_cod_prod'])){
            $codigo = $this->session['desde_cod_prod'];   
        }else{
            $codigo = $this->post->codigo;
        }
        $this->engine->assign('nombre',$this->session['usuario']['nombre']);
        $this->engine->assign('identificacion',$this->session['usuario']['identificacion']);
        $this->engine->assign('tipo',$this->session['usuario']['tipo']);
        $this->engine->display('cabecera.tpl');
        if (($this->session['usuario']['tipo'] == "veterinario")) {
            $hoy = getdate();
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


            $tiempo_actual = $hora . ":" . $minutos . ":" . $segundos;

            $option['tratamiento']['lvl2']= "por_codigo";
            $cod['tratamiento']['codigo'] = $codigo;
            $auxiliars['tratamiento']=array("nombre_animal");
            $this->orm->connect();
            $this->orm->read_data(array("tratamiento"), $option, $cod);
            $mi_tratamiento = $this->orm->get_objects("tratamiento", NULL, $auxiliars);
            $mi_tratamiento = $mi_tratamiento[0];

            $horat = substr($mi_tratamiento->get('hora'), 0, 2);
            $minutost = substr($mi_tratamiento->get('hora'), 3, 2);

            $minutos_antes = $minutost - 30;
            $hora_antes = $horat;
            if ($minutos_antes < 0){
                $hora_antes = $horat-1;
                $minutos_antes = 60 + $minutos_antes;
                if ($hora_antes < 0){
                    $hora_antes="-01";
                }
            }
            if ($hora_antes<10 AND $hora_antes>0){
                $hora_antes = "0" . $hora_antes;    
            }

            if ($minutos_antes<10){
                $minutos_antes = "0" . $minutos_antes;    
            }

            $minutos_despues = $minutost + 30;
            $hora_despues = $horat;
            if ($minutos_despues >= 60){
                $hora_despues = $horat+1;
                $minutos_despues = $minutos_despues - 60;
            }
            // if ($hora_despues<10 AND $hora_despues>0){
            //     $hora_despues = "0" . $hora_despues;    
            // }
            // if ($minutos_despues<10){
            //     $minutos_despues = "0" . $minutos_despues;    
            // }
            
            $tiempo_antes = $hora_antes . ":" . $minutos_antes . ":00";
            $tiempo_despues = $hora_despues . ":" . $minutos_despues . ":00";


            if(($fecha_actual < $mi_tratamiento->get('fecha')) OR (($fecha_actual == $mi_tratamiento->get('fecha')) AND ($tiempo_actual<$tiempo_antes))){
                
                $dir=$gvar['l_global']."buscar_tratamiento.php";
                $this->mensaje("warning","Error",$dir,"No puede acceder a este tratamiento ya que se anticipó a su horario");
                $this->engine->display($this->temp_aux);     
            }
            if(($fecha_actual > $mi_tratamiento->get('fecha')) OR (($fecha_actual == $mi_tratamiento->get('fecha')) AND ($tiempo_actual>$tiempo_despues))){
                
                $this->orm->connect();
                $this->orm->delete_data("normal",$mi_tratamiento);
                $this->orm->close();

                $dir=$gvar['l_global']."buscar_tratamiento.php";
                $this->mensaje("warning","Error",$dir,"No puede acceder a este tratamiento ya que se excedió a su horario. El tratamiento será eliminada");
                $this->engine->display($this->temp_aux);     
            }

            $_SESSION['desde_cod_prod'] = $codigo;
            $_SESSION['desde_prod'] = "tratamiento";
            $this->session = $_SESSION;
            $this->engine->assign('mi_tratamiento',$mi_tratamiento);
            $this->engine->display($this->temp_aux);
            $this->engine->display('completar_tratamiento.tpl');
       
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
                if ($this->get->option == "finalizar"){
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
    $call = new c_completar_tratamiento();
    $call->run();
?>