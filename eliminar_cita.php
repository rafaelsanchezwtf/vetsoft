<?php

require('configs/include.php');
        
class c_eliminar_cita extends super_controller {
    
    
    public function cancelar(){
        $dir = $gvar['l_global']."buscar_cita.php";
        $this->mensaje("warning","Información",$dir,"Operacion cancelada por el veterinario");
    }

    public function eliminar(){
        
       
    
        $cita = new cita($this->post);
        $this->orm->connect();  
        $this->orm->delete_data("normal",$cita);   
        $this->orm->close();
        
        $dir = $gvar['l_global']."buscar_cita.php";
        $this->mensaje("warning","Confirmacion",$dir,"Borrado exitoso"); 
        
        // para evitar el display de un error por inexistencia del registro recien borrado
        $this->get->option='cancelar';
    
    }
    public function display(){
        
        
           
        $cod['cita']['codigo'] = $this->post->codigo;
        $options['cita']['lvl2'] = "one";
        $this->orm->connect();
        $this->orm->read_data(array("cita"),$options,$cod);
        $cita = $this->orm->get_objects("cita");
        $this->engine->assign('cita',$cita[0]);
        $this->orm->close();
      
        
               
        $this->engine->assign('title', "Eliminar Cita"); 
        $this->engine->assign('nombre',$this->session['usuario']['nombre']);
        $this->engine->assign('tipo',$this->session['usuario']['tipo']);
        $this->engine->display('cabecera.tpl');
        if (($this->session['usuario']['tipo'] == "veterinario")){
            $this->engine->display($this->temp_aux);
            
            if(!($this->get->option=='cancelar')){$this->engine->display('eliminar_cita.tpl');}
            
            
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

    $call = new c_eliminar_cita();
    $call->run();


?>