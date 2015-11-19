<?php

require('configs/include.php');

class c_editar_animal extends super_controller {
    
    function validateDate($date, $format = 'Y-m-d'){
        $d = DateTime::createFromFormat($format, $date);
        return $d && $d->format($format) == $date;
    }

    public function actualizar(){
        
        $nombre_vacio = "";
        $fecha_vacio = "";
        $peso_vacio = "";
        $talla_vacio = "";
        $genero_vacio = "";
        $especie_vacio = "";

        $fecha_invalido = "";
        $peso_invalido = "";
        $talla_invalido = "";
        
        
    
        
        if(is_empty($this->post->id)){ throw_exception('Debes ingresar un valor en el campo Id.');} 
        if(is_empty($this->post->nombre)){ 
            $this->engine->assign("nombre_vacio",0);
            $nombre_vacio = " Campo nombre vacío";
            
        } 
        if(is_empty($this->post->fecha_de_nacimiento)){ 
            $this->engine->assign("fecha_vacio",0);
            $fecha_vacio = " Campo fecha de nacimiento vacío";
           
        } 
        if(is_empty($this->post->peso)){ 
            $this->engine->assign("peso_vacio",0);
            $peso_vacio = " Campo Peso vacío";
            
        } 
        if(is_empty($this->post->talla)){ 
            $this->engine->assign("talla_vacio",0);
            $talla_vacio = " Campo talla vacío";
           
        } 
        if(is_empty($this->post->genero)){ 
            $this->engine->assign("genero_vacio",0);
            $genero_vacio = " Campo genero vacío";
            
        } 
        if(is_empty($this->post->especie)){ 
             $this->engine->assign("especie_vacio",0);
            $especie_vacio = " Campo especie vacío";
            
        } 
        
        if ($nombre_vacio<>""
            || $fecha_vacio<>""
            || $peso_vacio<>""
            ||$talla_vacio<>""
            || $genero_vacio<>""
            || $especie_vacio<>""){
            throw_exception("HAY DATOS INCOMPLETOS".$nombre_vacio.$fecha_vacio.
            $peso_vacio.$talla_vacio.$genero_vacio.$especie_vacio);
        }
        if(!($this->validateDate($this->post->fecha_de_nacimiento))){
            $this->engine->assign("fecha_invalido",0);
            $fecha_invalido = " Campo fecha de nacimiento invalido";
        }

        if (!is_numeric($this->post->peso)){
            $this->engine->assign("peso_invalido",0);
            $peso_invalido = " Campo peso invalido";      
        }

        if (!is_numeric($this->post->talla)){
            $this->engine->assign("talla_invalido",0);
            $talla_invalido = " Campo talla invalido";      
        }

        if ($fecha_invalido<>"" || $peso_invalido<>"" || $talla_invalido<>""){
            throw_exception("HAY DATOS INVALIDOS".$fecha_invalido.
            $peso_invalido.$talla_invalido);
        }
        
        
        
        $cambiofoto = false;
        if ($_FILES['fotonueva']['name'] <> "") {
            if ($_FILES['fotonueva']['type'] != "image/png"
            && $_FILES['fotonueva']['type'] != "image/jpeg"
            && $_FILES["fotonueva"]["type"] != "image/pjpeg"){ 
                throw_exception("Archivo inválido");
            }
            
            $this->post->foto = $_FILES['fotonueva']['name'];
            $cambiofoto=true;
        }
        else{
         $this->post->foto =  $this->post->fotovieja;
        }
        
        
        $animal = new animal($this->post);
        $this->orm->connect();
        
        // solo se almacenara la foto si es nueva
        if($cambiofoto){
            $nombre_foto = $this->post->foto;
            $ext = strtolower(substr(strrchr($nombre_foto, '.'), 1));
            $nombre_final = $this->post->id;
            $nombre_final = $nombre_final . "." . $ext;
            
            
            
            
                move_uploaded_file($_FILES["fotonueva"]["tmp_name"],"files/animal/" . $nombre_final);
                 $foto_para_subir = "http://localhost/vetsoft/files/animal/" . $nombre_final;
                $animal->set('foto',$foto_para_subir);
            
        }
        
        
        $this->orm->update_data("normal",$animal);
        
        $_SESSION['mensaje']['tipo'] = 'Confirmación: ';
        $_SESSION['mensaje']['texto'] = 'Animal editado';
        
        $_SESSION['mensaje']['texto'] .= ' y dueño editado';
        $_SESSION['mensaje']['codigo'] = $mensaje;
        $this->session = $_SESSION;
        
        // se mostraron los inputs para editar dueño
        if(isset($this->post->cedula) && !is_empty($this->post->cedula)){
        
            
            $nombred_vacio = "";
            $cedula_vacio = "";
            $telefono_vacio = "";
            $email_vacio = "";

            $cedula_invalido = "";
            $telefono_invalido = "";
            $email_invalido = "";
       
            if(is_empty($this->post->cedula)){ 
            
            $this->engine->assign("cedula_vacio",0);
            $cedula_vacio = " Campo cedula vacío";
            } 
            if(is_empty($this->post->nombred)){ 
                
                $this->engine->assign("nombred_vacio",0);
                $nombred_vacio = " Campo nombre de dueño vacío";
                } 
            if(is_empty($this->post->telefono)){ 
                $this->engine->assign("telefono_vacio",0);
                $telefono_vacio = " Campo telefono vacío";
            } 
            if(is_empty($this->post->email)){ 
                    $this->engine->assign("email_vacio",0);
                    $email_vacio = " Campo email vacío";
                } 
            //if(is_empty($this->post->fotod)){ throw_exception('Debes ingresar un valor en el campo fotod.');} 
        
            
            if ($nombred_vacio<>"" || $telefono_vacio<>"" || $cedula_vacio<>"" || $email_vacio<>""){
            throw_exception("HAY DATOS INCOMPLETOS".$nombred_vacio.$cedula_vacio.
            $telefono_vacio.$email_vacio);
                
            }
            
               // verificacion de tipo de datos   
            if (!is_numeric($this->post->telefono)){
                $this->engine->assign("telefono_invalido",0);
                $telefono_invalido = " Campo telefono invalido";      
            }

            if (!is_numeric($this->post->cedula)){
                $this->engine->assign("cedula_invalido",0);
                $cedula_invalido = " Campo cedula invalido";      
            }

            if (!filter_var($this->post->email, FILTER_VALIDATE_EMAIL)){
                $this->engine->assign("email_invalido",0);
                $email_invalido = " Campo email invalido";    
            }

            if ($telefono_invalido<>"" || $cedula_invalido<>"" || $email_invalido<>""){
                throw_exception("HAY DATOS INVALIDOS".$cedula_invalido.
                $telefono_invalido.$email_invalido);
            }
            
            
            $cambiofotod = false;
            if ($_FILES['fotod']['name'] <> "") {
                if ($_FILES['fotod']['type'] != "image/png"
                && $_FILES['fotod']['type'] != "image/jpeg"
                && $_FILES["fotod"]["type"] != "image/pjpeg"){ 
                throw_exception("Archivo inválido");
            }
            
            $this->post->foto = $_FILES['fotod']['name'];
            $cambiofotod=true;
        }
        else{
         $this->post->foto =  $this->post->fotoviejad;
        }
            
            
    
    

            $this->post->nombre = $this->post->nombred;
            $dueno = new dueno($this->post);
            
            
            // solo se almacenara la foto si es nueva
        if($cambiofotod){
            $nombre_foto = $this->post->foto;
            $ext = strtolower(substr(strrchr($nombre_foto, '.'), 1));
            $nombre_final = $this->post->cedula;
            $nombre_final = $nombre_final . "." . $ext;
            
            
           
                move_uploaded_file($_FILES["fotod"]["tmp_name"],"files/dueno/" . $nombre_final);
                 $foto_para_subir = "http://localhost/vetsoft/files/dueno/" . $nombre_final;
                $dueno->set('foto',$foto_para_subir);
            
        }
            
            
            
            $this->orm->update_data("normal",$dueno);
            $_SESSION['mensaje']['texto'] .= ' y dueño editado';
        
        
            $_SESSION['mensaje']['codigo'] = $mensaje;
        
        
        }
        
        
        
        $this->orm->close();
        $this->session = $_SESSION;
        
        
        header('Location: buscar_animal.php'); 
    
    }
    public function mostrarEditables(){
        
        // verifica si tiene dueño
        if(!is_empty($this->post->dueno)) {
            $this->engine->assign('dueno',$this->post->dueno);
            
            
            $cod['dueno']['cedula'] = $this->post->dueno;
            
            $options['dueno']['lvl2'] = 'one';
            $this->orm->connect();
            
            $this->orm->read_data(array("dueno"),$options,$cod);
            $duenio = $this->orm->get_objects("dueno");
            
            $this->orm->close();

            if(isset($duenio)){
                $this->engine->assign('duenio',$duenio[0]);
                
                
            }
            else{
                throw_exception('Debes ingresar una Cedula existente');
            }
            
            
        }
        $this->engine->assign('id',$this->post->id);
        $this->engine->assign('nombrec',$this->post->nombre);
        $this->engine->assign('fotoc',$this->post->foto);
        $this->engine->assign('peso',$this->post->peso);
        $this->engine->assign('talla',$this->post->talla);
        $this->engine->assign('genero',$this->post->genero);
        $this->engine->assign('especie',$this->post->especie);
        $this->engine->assign('fecha_de_nacimiento',$this->post->fecha_de_nacimiento);
       
       
     
    
    }

    public function cancelar(){
        $dir = $gvar['l_global']."buscar_animal.php";
        $this->mensaje("warning","Información",$dir,"Operacion cancelada por el administrador");
    }
    
    public function display(){
        $this->engine->assign('title', "Editar Animal");
        $this->engine->assign('nombre',$this->session['usuario']['nombre']);
        $this->engine->assign('tipo',$this->session['usuario']['tipo']);
        $this->engine->display('cabecera.tpl');
        if ($this->session['usuario']['tipo'] == "administrador"){
            $this->engine->display($this->temp_aux);
            $this->engine->display('editar_animal.tpl');
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
                else{throw_exception("Opción ". $this->get->option." no disponible");}
            }
            
            else if (isset($this->post->fotovieja)) {
                $this->actualizar();                
            }
            else if(isset($this->post->id)){ 
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

    $call = new c_editar_animal();
    $call->run();


?>