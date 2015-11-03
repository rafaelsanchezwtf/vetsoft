<?php

require('configs/include.php');

class c_perfil_administrador extends super_controller {
    
    public function display(){
        $this->engine->assign('title', "Perfil Administrador");
        $this->engine->assign('nombre',$this->session['usuario']['nombre']);
        $this->engine->assign('tipo',$this->session['usuario']['tipo']);
        $this->engine->display('cabecera.tpl');
        if ($this->session['usuario']['tipo'] == "administrador") {
            echo $this->session['mensaje']['tipo']. $this->session['mensaje']['texto']. $this->session['mensaje']['codigo'];
            $_SESSION['mensaje']['tipo'] = '';
            $_SESSION['mensaje']['texto'] = '';
            $_SESSION['mensaje']['codigo'] = '';
            $this->engine->display($this->temp_aux);
            $this->engine->display('perfil_administrador.tpl');
        }else{
            $this->engine->assign('type_warning','Lo sentimos:');
            $this->engine->assign('msg_warning',"Usted no tiene permiso para acceder a esta opción.");
            $this->temp_aux = 'message.tpl';
            $this->engine->display($this->temp_aux);    
        }
        $this->engine->display('piedepagina.tpl');
    }
    
    public function run() {
        $_SESSION['animal']['dueno']['cedula'] = "";
        $this->session = $_SESSION;

        $this->display();
    }
        
}

    $call = new c_perfil_administrador();
    $call->run();


?>