<?php

require('configs/include.php');

class c_perfil_veterinario extends super_controller {
    
    public function display(){
        $this->engine->assign('title', "Perfil Veterinario");
        $this->engine->assign('nombre',$this->session['usuario']['nombre']);
        $this->engine->assign('tipo',$this->session['usuario']['tipo']);
        $this->engine->display('cabecera.tpl');
        $this->engine->display('perfil_veterinario.tpl');
        $this->engine->display('piedepagina.tpl');
    
    }
    
    public function run() {
        $this->display();
    }
        
}

    $call = new c_perfil_veterinario();
    $call->run();


?>