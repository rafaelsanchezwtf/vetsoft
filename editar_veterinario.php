<?php

require('configs/include.php');

class c_editar_veterinario extends super_controller {
    
    public function asignar_datos_veterinario($identificacion,$nombre, $telefono,$email, $sueldo){
        $this->engine->assign('identificacion',$identificacion);
        $this->engine->assign('nombre_veterinario',$nombre);
        $this->engine->assign('telefono',$telefono);
        $this->engine->assign('email',$email);
        $this->engine->assign('sueldo',$sueldo); 
   
    }
    public function asignar_vacios_veterinario($nombre, $telefono, $email, $sueldo){
        $vs = false;
        if (is_empty($nombre)){
            $this->engine->assign("nombre_vacio",0); $vs=true;
        }
        
        if (is_empty($telefono)){
            $this->engine->assign("telefono_vacio",0); $vs=true;
        }
        if (is_empty($email)){
            $this->engine->assign("email_vacio",0); $vs=true;
        }
        if (is_empty($sueldo)){
            $this->engine->assign("sueldo_vacio",0); $vs=true;
        }
    return $vs;
 
    }
    
 
    
    
    public function asignar_invalidos_veterinario($veterinario){
        $v=false;

        if ((!is_numeric($veterinario->get('telefono'))) or ($veterinario->get('telefono') < 1000000)){
            $this->engine->assign("telefono_invalido",0);     
            $v=true;
        }
         if ((!is_numeric($veterinario->get('sueldo'))) or ($veterinario->get('sueldo') < 0)){
            $this->engine->assign("sueldo_invalido",0);     
            $v=true;
        }
        if (!filter_var($veterinario->get('email'), FILTER_VALIDATE_EMAIL)){
            $this->engine->assign("email_invalido",0);   
            $v=true;
        }
        return $v;
    }
 
    public function actualizar(){
        
        
        $vaciosveterinario = self::asignar_vacios_veterinario($this->post->nombre,$this->post->telefono,$this->post->email,$this->post->sueldo);  
        
        
        $veterinario = new veterinario();
        $veterinario->set('identificacion',$this->post->identificacion);
        $veterinario->set('nombre',$this->post->nombre);
        $veterinario->set('telefono',$this->post->telefono);
        $veterinario->set('email',$this->post->email);
        $veterinario->set('sueldo',$this->post->sueldo);
        $incorrectosveterinario = self::asignar_invalidos_veterinario($veterinario);
        
        
        
        
        if($vaciosveterinario){
            $this->mensaje("warning","Error","","Hay campos vacíos");
            throw_exception("");
        }
        if($incorrectosveterinario){
            $this->mensaje("warning","Error","","Hay datos invalidos");
            throw_exception("");
        }
       
        
        $this->orm->connect();
        $this->orm->update_data("normal",$veterinario);
  
        $this->orm->close();
        
        
        
        $dir = $gvar['l_global']."buscar_veterinario.php";
        $this->mensaje("warning","Confirmacion",$dir,"Edicion exitosa"); 
    
    }
    public function mostrarEditables(){
        
       
        
        self::asignar_datos_veterinario($this->post->identificacion,$this->post->nombre,$this->post->telefono,$this->post->email,$this->post->sueldo);
        
    
    }

    public function cancelar(){
        $dir = $gvar['l_global']."buscar_veterinario.php";
        $this->mensaje("warning","Información",$dir,"Operacion cancelada por el administrador");
    }
    
    public function display(){
        $this->engine->assign('title', "Editar veterinario");
        $this->engine->assign('nombre',$this->session['usuario']['nombre']);
        $this->engine->assign('tipo',$this->session['usuario']['tipo']);
        $this->engine->display('cabecera.tpl');
        if ($this->session['usuario']['tipo'] == "administrador"){
            $this->engine->display($this->temp_aux);
            $this->engine->display('editar_veterinario.tpl');
        }else{
            $direccion=$gvar['l_global']."index.php";
            $this->mensaje("warning","Informacion",$direccion,"Lo sentimos, usted no tiene permisos para acceder");
            $this->engine->display($this->temp_aux); 
        }
        $this->engine->display('piedepagina.tpl');
    }
    
    public function run(){
        try {
            if(isset($this->get->option)){
                if($this->get->option=="cancelar"){
                    $this->{$this->get->option}();}
                else if($this->get->option=="actualizar"){
                    $this->{$this->get->option}();
                }
                
                else{throw_exception("Opción ". $this->get->option." no disponible");}
            }
           
            else if(isset($this->post->identificacion)){ 
                $this->mostrarEditables();
            }
            else{
             
            }
        } catch (Exception $e) {
            $this->error=1;
            $this->msg_warning=$e->getMessage();
            $this->temp_aux = 'message.tpl';
            $this->engine->assign('type_warning',$this->type_warning);
            $this->engine->assign('msg_warning',$this->msg_warning);
            $this->mostrarEditables();
            }
        $this->display();
    }
        
}

    $call = new c_editar_veterinario();
    $call->run();


?>