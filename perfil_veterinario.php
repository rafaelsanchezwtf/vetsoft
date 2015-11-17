<?php

require('configs/include.php');

class c_perfil_veterinario extends super_controller {

    public function display(){
        $this->engine->assign('title', "Perfil Veterinario");
        $this->engine->assign('nombre',$this->session['usuario']['nombre']);
        $this->engine->assign('tipo',$this->session['usuario']['tipo']);
        $this->engine->display('cabecera.tpl');
        if ($this->session['usuario']['tipo'] == "veterinario") {
            $_SESSION['mensaje']['tipo'] = '';
            $_SESSION['mensaje']['texto'] = '';
            $_SESSION['mensaje']['codigo'] = '';
            $this->engine->display($this->temp_aux);
            $this->engine->display('perfil_veterinario.tpl');
        }else{
            $direccion=$gvar['l_global']."index.php";
            $this->mensaje("info","Informacion",$direccion,"Lo sentimos, usted no tiene permisos para acceder");
            $this->engine->display($this->temp_aux);     
        }
    }
    
    public function run() {
        $this->display();
    }
        
}

    $call = new c_perfil_veterinario();
    $call->run();


?>