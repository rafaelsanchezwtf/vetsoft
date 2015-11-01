<?php

require('configs/include.php');

class c_perfil_administrador extends super_controller {
    
    public function display(){
        $this->engine->assign('title', "Perfil Administrador");
        $this->engine->assign('nombre',$this->session['usuario']['nombre']);
        $this->engine->assign('tipo',$this->session['usuario']['tipo']);
        $this->engine->display('cabecera.tpl');
        $this->engine->display('perfil_administrador.tpl');
        $this->engine->display('piedepagina.tpl');
    }
    
    public function run() {
        $this->display();
    }
        
}

    $call = new c_perfil_administrador();
    $call->run();


?>