<?php

require('configs/include.php');
        
class c_eliminar_tratamiento extends super_controller {
    
    
    public function cancelar(){
        $dir = $gvar['l_global']."buscar_tratamiento.php";
        $this->mensaje("warning","Información",$dir,"Operacion cancelada por el veterinario");
    }

    public function eliminar(){
        
       
    
        $tratamiento = new tratamiento($this->post);
        $this->orm->connect();  
        $this->orm->delete_data("normal",$tratamiento);   
        $this->orm->close();
        
        $dir = $gvar['l_global']."buscar_tratamiento.php";
        $this->mensaje("warning","Confirmacion",$dir,"Borrado exitoso"); 
        
        // para evitar el display de un error por inexistencia del registro recien borrado
        $this->get->option='cancelar';
    
    }
    public function display(){
        
        
           
        $cod['tratamiento']['codigo'] = $this->post->codigo;
        $options['tratamiento']['lvl2'] = "one";
        $this->orm->connect();
        $this->orm->read_data(array("tratamiento"),$options,$cod);
        $tratamiento = $this->orm->get_objects("tratamiento");
        $this->engine->assign('tratamiento',$tratamiento[0]);
        $this->orm->close();
      
        
               
        $this->engine->assign('title', "Eliminar tratamiento"); 
        $this->engine->assign('nombre',$this->session['usuario']['nombre']);
        $this->engine->assign('tipo',$this->session['usuario']['tipo']);
        $this->engine->display('cabecera.tpl');
        if (($this->session['usuario']['tipo'] == "veterinario")){
            $this->engine->display($this->temp_aux);
            
            if(!($this->get->option=='cancelar')){$this->engine->display('eliminar_tratamiento.tpl');}
            
            
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
                if ($this->get->option == "eliminar" or $this->get->option == "cancelar" )
                    $this->{$this->get->option}();
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

    $call = new c_eliminar_tratamiento();
    $call->run();


?>