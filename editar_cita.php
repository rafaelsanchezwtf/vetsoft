<?php

require('configs/include.php');

class c_editar_cita extends super_controller {
    
    public function asignar_datos_cita($codigo,$motivo, $fecha,$hora, $lugar, $animal){
        $this->engine->assign('codigo',$codigo);
        $this->engine->assign('motivo',$motivo);
        $this->engine->assign('fecha',$fecha);
        $this->engine->assign('hora',$hora);
        $this->engine->assign('lugar',$lugar);    
    }
    public function asignar_vacios_cita($motivo, $fecha,$hora, $lugar){
        $vs = false;
        if (is_empty($motivo)){
            $this->engine->assign("motivo_vacio",0); $vs=true;
        }
        if (is_empty($fecha)){
            $this->engine->assign("fecha_vacio",0); $vs=true;
        }
        if (is_empty($hora)){
            $this->engine->assign("hora_vacio",0); $vs=true;
        }
        if (is_empty($lugar)){
            $this->engine->assign("lugar_vacio",0); $vs=true;
        }
    return $vs;
 
    }
      
    public function asignar_invalidos_cita($cita){
        $v=false;
        $fecha_actual = date('Y-m-d');
        if((!(cita::validateDate($cita->get('fecha')))) or ($cita->get('fecha') < $fecha_actual)){
            $this->engine->assign("fecha_invalido",0);
            $v=true;
        }
        if ((!is_numeric($animal->get('peso'))) or ($animal->get('peso') <= 0)){
            $this->engine->assign("peso_invalido",0); 
            $v=true;
        }
        return $v;
    }
   
    
    public function actualizar(){
        
          

        
        $vaciosanimal = self::asignar_vacios_animal($this->post->nombre_animal,$this->post->fecha_de_nacimiento,$this->post->peso,$this->post->talla,$this->post->genero,$this->post->especie);  
        
        //No es modificable el atributo dueño de un animal
        $animal = new animal();
        $animal->set('id',$this->post->id);
        $animal->set('nombre',$this->post->nombre_animal);
        $animal->set('fecha_de_nacimiento',$this->post->fecha_de_nacimiento);
        $animal->set('peso',$this->post->peso);
        $animal->set('talla',$this->post->talla);
        $animal->set('genero',$this->post->genero);
        $animal->set('especie',$this->post->especie);
        $incorrectosanimal = self::asignar_invalidos_animal($animal);
        
        
        
        
        if($vaciosanimal){
            $this->mensaje("warning","Error","","Hay campos vacíos");
            throw_exception("");
        }
        if($incorrectosanimal){
            $this->mensaje("warning","Error","","Hay datos invalidos");
            throw_exception("");
        }
        
        // si se selecciono una foto nueva para el animal
        if ($_FILES['fotonueva']['name'] <> "") {
                  self::verificar_fotografia('fotonueva');
                  $animal->set('foto',self::insertar_fotografia('fotonueva',$this->post->id));
        }
        else{
                  $animal->set('foto',$this->post->fotovieja);
        }
        
        
        $this->orm->connect();
        $this->orm->update_data("normal",$cita);
        $this->orm->close();
        
        $dir = $gvar['l_global']."buscar_cita.php";
        $this->mensaje("warning","Confirmacion",$dir,"Edicion exitosa"); 
    
    }
    public function mostrarEditables(){
        
        // Se realizan los assign para mostrarsen en el tpl, los valores son los que se tenian
        // en los inputs en el ultimo submit
        self::asignar_datos_cita($this->post->codigo,$this->post->motivo,$this->post->fecha,$this->post->hora,$this->post->lugar,$this->post->animal);
    }

    public function cancelar(){
        $dir = $gvar['l_global']."buscar_cita.php";
        $this->mensaje("warning","Información",$dir,"Operacion cancelada por el veterinario");
    }
    
    public function display(){
        $this->engine->assign('title', "Editar Cita");
        $this->engine->assign('nombre',$this->session['usuario']['nombre']);
        $this->engine->assign('tipo',$this->session['usuario']['tipo']);
        $this->engine->display('cabecera.tpl');
        if ($this->session['usuario']['tipo'] == "veterinario"){
            $this->engine->display($this->temp_aux);
            $this->engine->display('editar_cita.tpl');
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
           
            else if(isset($this->post->codigo)){ 
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

    $call = new c_editar_cita();
    $call->run();


?>