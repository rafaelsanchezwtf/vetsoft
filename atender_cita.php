<?php

require('configs/include.php');
require('modules/m_phpass/PasswordHash.php');

class c_atender_cita extends super_controller {

    public function finalizar(){

        $cita = new cita($this->post);

        $this->engine->assign('condicion_c',$cita->get('condicion'));
        $this->engine->assign('diagnostico_c',$cita->get('diagnostico'));

        if (is_empty($cita->get('condicion')) OR is_empty($cita->get('diagnostico'))){
            if (is_empty($cita->get('condicion'))){
                $this->engine->assign('condicion_c_vacio',0);
            }
            if (is_empty($cita->get('diagnostico'))){
                $this->engine->assign('diagnostico_c_vacio',0);
            }
            $this->mensaje("warning","Error","","Hay campos vacíos");
            throw_exception("");  
        }

        $cita->set('estado','finalizado');

        $this->orm->connect();
        $this->orm->update_data("normal_atender",$cita);
        $this->orm->close();

        if (isset($this->post->flagncita)){
            $_SESSION['idcita'] = $cita->get('codigo');
            $this->session = $_SESSION;
            $msg = "Cita finalizada correctamente, redirigiendo a asignar cita...";
            $dir=$gvar['l_global']."asignar_cita.php";
            $this->mensaje("check-circle","Confirmación",$dir,$msg);    
        }elseif (isset($this->post->flagntratamiento)){
            $_SESSION['idcita'] = $cita->get('codigo');
            $this->session = $_SESSION;
            $msg = "Cita finalizada correctamente, redirigiendo a asignar tratamiento...";
            $dir=$gvar['l_global']."asignar_tratamiento.php";
            $this->mensaje("check-circle","Confirmación",$dir,$msg); 
        }else{
            $msg = "Cita finalizada correctamente!";
            $dir=$gvar['l_global']."buscar_cita.php";
            $this->mensaje("check-circle","Confirmación",$dir,$msg);
        }
    }

    public function cancelar(){
        $dir = $gvar['l_global']."buscar_cita.php";
        $this->mensaje("warning","Información",$dir,"Operacion cancelada por el veterinario");
    }

    public function display(){
        $this->engine->assign('title', "Atender Cita");
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

            echo $fecha_actual . " " . $tiempo_actual; 
            $option['cita']['lvl2']= "por_codigo";
            $cod['cita']['codigo'] = $codigo;
            $auxiliars['cita']=array("nombre_animal");
            $this->orm->connect();
            $this->orm->read_data(array("cita"), $option, $cod);
            $mi_cita = $this->orm->get_objects("cita", NULL, $auxiliars);
            $mi_cita = $mi_cita[0];

            $horac = substr($mi_cita->get('hora'), 0, 2);
            $minutosc = substr($mi_cita->get('hora'), 3, 2);

            $minutos_antes = $minutosc - 30;
            $hora_antes = $horac;
            if ($minutos_antes < 0){
                $hora_antes = $horac-1;
                $minutos_antes = 60 + $minutos_antes;
                if ($hora_antes < 0){
                    $hora_antes="-01";
                }
            }
            if ($minutos_antes<10){
                $minutos_antes = "0" . $minutos_antes;    
            }

            $minutos_despues = $minutosc + 30;
            $hora_despues = $horac;
            if ($minutos_despues >= 60){
                $hora_despues = $horac+1;
                $minutos_despues = $minutos_despues - 60;
            }
            if ($hora_despues<10 AND $hora_despues>0){
                $hora_despues = "0" . $hora_despues;    
            }
            if ($minutos_despues<10){
                $minutos_despues = "0" . $minutos_despues;    
            }
            
            $tiempo_antes = $hora_antes . ":" . $minutos_antes . ":00";
            $tiempo_despues = $hora_despues . ":" . $minutos_despues . ":00";

            echo " " . $tiempo_antes . " " . $tiempo_despues; 

            if(($fecha_actual < $mi_cita->get('fecha')) OR (($fecha_actual == $mi_cita->get('fecha')) AND ($tiempo_actual<$tiempo_antes))){
                
                $dir=$gvar['l_global']."buscar_cita.php";
                $this->mensaje("warning","Error",$dir,"No puede acceder a esta cita ya que se anticipó a su horario");
                $this->engine->display($this->temp_aux);     
            }
            if(($fecha_actual > $mi_cita->get('fecha')) OR (($fecha_actual == $mi_cita->get('fecha')) AND ($tiempo_actual>$tiempo_despues))){
                
                $this->orm->connect();
                $this->orm->delete_data("normal",$mi_cita);
                $this->orm->close();

                $dir=$gvar['l_global']."buscar_cita.php";
                $this->mensaje("warning","Error",$dir,"No puede acceder a esta cita ya que se excedió a su horario. La cita será eliminada");
                $this->engine->display($this->temp_aux);     
            }

            $_SESSION['desde_cod_prod'] = $codigo;
            $_SESSION['desde_prod'] = "cita";
            $this->session = $_SESSION;

            $this->engine->assign('mi_cita',$mi_cita);
            $this->engine->display($this->temp_aux);
            $this->engine->display('atender_cita.tpl');
       
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
                }elseif ($this->get->option == "finalizar_asignar_cita"){
                    $this->{$this->get->option}();
                }elseif ($this->get->option == "finalizar_asignar_tratamiento"){
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
    $call = new c_atender_cita();
    $call->run();
?>