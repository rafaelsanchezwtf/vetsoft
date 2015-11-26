<?php

require('configs/include.php');
        
class c_eliminar_producto extends super_controller {


    public function eliminar(){
        $veterinario = new veterinario($this->post);
        $this->orm->connect();  
        $this->orm->delete_data("normal",$veterinario);   
        $this->orm->close();
        
        $dir = $gvar['l_global']."buscar_veterinario.php";
        $this->mensaje("warning","Información",$dir,"Borrado exitoso"); 
        
        // para evitar el display de un error por inexistencia del registro recien borrado
        $this->get->option='cancelar';
    }
    public function cancelar(){
        $dir = $gvar['l_global']."buscar_veterinario.php";
        $this->mensaje("warning","Información",$dir,"Operacion cancelada por el adminsitrador");
    }
    
    
    public function display(){
        

        $this->engine->assign('title', "Eliminar Veterinario");
        $this->engine->assign('nombre',$this->session['usuario']['nombre']);
        $this->engine->assign('tipo',$this->session['usuario']['tipo']);
        $this->engine->display('cabecera.tpl');
        if (($this->session['usuario']['tipo'] == "administrador")){
            #settype($data,'object');
            $identificacion=$this->post->identificacion;
            $options['veterinario']['lvl2'] = "por_identificacion";
            $cod['veterinario']['valor'] = $identificacion;
            $this->orm->connect();
            $this->orm->read_data(array("veterinario"), $options, $cod);
            $veterinario = $this->orm->get_objects("veterinario");        
            $this->orm->close();
            #print_r2($veterinario);
            $this->engine->assign('veterinario',$veterinario[0]);
            $this->engine->display($this->temp_aux);
            $this->engine->display('eliminar_veterinario.tpl');
        }else{
            $direccion=$gvar['l_global']."index.php";
            $this->mensaje("warning","Informacion",$direccion,"Lo sentimos, usted no tiene permisos para acceder");
            $this->engine->display($this->temp_aux); 
        }
        $this->engine->display('piedepagina.tpl');
    }
    
    public function run(){
                
        try {
            if (isset($this->get->option)) {
                if ($this->get->option == "cancelar")
                    $this->{$this->get->option}();
                elseif($this->get->option == "eliminar"){
                    $this->{$this->get->option}();
                }

                else
                    throw_exception("Opción ". $this->get->option." no disponible");
            }
        } catch (Exception $e) {
            $this->error=1;
            $this->msg_warning=$e->getMessage();
            $this->temp_aux = 'message.tpl';
            $this->engine->assign('type_warning',$this->type_warning);
            $this->engine->assign('msg_warning',$this->msg_warning);
        }
        $this->display();
    }
        
}

    $call = new c_eliminar_producto();
    $call->run();


?>