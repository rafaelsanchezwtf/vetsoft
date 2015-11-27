<?php

require('configs/include.php');

class c_editar_animal extends super_controller {
    
    public function asignar_datos_animal($id,$nombre, $foto,$fecha_de_nacimiento, $peso, $talla, $genero, $especie){
        $this->engine->assign('id',$id);
        $this->engine->assign('nombre_animal',$nombre);
        $this->engine->assign('foto_animal',$foto);
        $this->engine->assign('fecha_de_nacimiento',$fecha_de_nacimiento);
        $this->engine->assign('peso',$peso);
        $this->engine->assign('talla',$talla);
        $this->engine->assign('genero',$genero);
        $this->engine->assign('especie',$especie); 

        
    }
    public function asignar_vacios_animal($nombre, $fecha_de_nacimiento, $peso, $talla, $genero, $especie){
        $vs = false;
        if (is_empty($nombre)){
            $this->engine->assign("nombre_vacio",0); $vs=true;
        }
        if (is_empty($fecha_de_nacimiento)){
            $this->engine->assign("fecha_vacio",0); $vs=true;
        }
        if (is_empty($peso)){
            $this->engine->assign("peso_vacio",0); $vs=true;
        }
        if (is_empty($talla)){
            $this->engine->assign("talla_vacio",0); $vs=true;
        }
        if (is_empty($genero)){
            $this->engine->assign("genero_vacio",0); $vs=true;
        }
        if (is_empty($especie)){
            $this->engine->assign("especie_vacio",0); $vs=true;
        }
    return $vs;
 
    }
    public function asignar_vacios_dueno( $nombre, $telefono, $email){
        $vs = false;
        if (is_empty($nombre)){
            $this->engine->assign("nombre_dueno_vacio",0);$vs=true;
        }
        if (is_empty($telefono)){
            $this->engine->assign("telefono_dueno_vacio",0);$vs=true;
        }
        if (is_empty($email)){
            $this->engine->assign("email_dueno_vacio",0);$vs=true;
        }
        return $vs;
    }
    
    public function asignar_invalidos_animal($animal){
        $v=false;
        $fecha_actual = date('Y-m-d');
        if((!(animal::validateDate($animal->get('fecha_de_nacimiento')))) or ($animal->get('fecha_de_nacimiento') > $fecha_actual)){
            $this->engine->assign("fecha_invalido",0);
            $v=true;
        }
        if ((!is_numeric($animal->get('peso'))) or ($animal->get('peso') <= 0)){
            $this->engine->assign("peso_invalido",0); 
            $v=true;
        }
        if ((!is_numeric($animal->get('talla'))) or ($animal->get('talla') <= 0)){
            $this->engine->assign("talla_invalido",0); 
            $v=true;
        } 
        return $v;
    }
    public function asignar_invalidos_dueno($dueno){
        $v=false;

        if ((!is_numeric($dueno->get('telefono'))) or ($dueno->get('telefono') < 1000000)){
            $this->engine->assign("telefono_dueno_invalido",0);     
            $v=true;
        }
        if (!filter_var($dueno->get('email'), FILTER_VALIDATE_EMAIL)){
            $this->engine->assign("email_dueno_invalido",0);   
            $v=true;
        }
        return $v;
    }
    
    
     public function verificar_fotografia($foto){
        $mTmpFile = $_FILES[$foto]["tmp_name"];
        $mTipo = exif_imagetype($mTmpFile);
            if (($mTipo != IMAGETYPE_JPEG) && ($mTipo != IMAGETYPE_PNG)){
                $this->mensaje("warning","Error","","Formato fotografia inválido");
                throw_exception(""); 
            }
    }
     public function insertar_fotografia($foto,$final){
        $nombre_foto = $_FILES[$foto]["name"];
        $ext = strtolower(substr(strrchr($nombre_foto, '.'), 1));
    
        $nombre_final = $final;
        $nombre_final = $nombre_final . "." . $ext;

        if ($foto=="fotonueva"){
            move_uploaded_file($_FILES[$foto]["tmp_name"],"files/animal/" . $nombre_final);
            $foto_atributo = "files/animal/" . $nombre_final;
        }else{
            
                move_uploaded_file($_FILES[$foto]["tmp_name"],"files/dueno/" . $nombre_final);
            
            $foto_atributo = "files/dueno/" . $nombre_final;
        }
        RETURN $foto_atributo;
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
        $this->orm->update_data("normal",$animal);
        
        
        
        // se mostraron los inputs para editar dueño
        if(isset($this->post->sidueno)){
            
            
            
            
            
            
        $vaciosdueno = self::asignar_vacios_dueno($this->post->nombre_dueno,$this->post->telefono,$this->post->email);  
        
        //No es modificable el atributo cedula del dueno
        $dueno = new dueno();
        $dueno->set('cedula',$this->post->cedula);
        $dueno->set('nombre',$this->post->nombre_dueno);
        $dueno->set('telefono',$this->post->telefono);
        $dueno->set('email',$this->post->email);
        $incorrectosdueno = self::asignar_invalidos_dueno($dueno);
            
        if($vaciosdueno){
        $this->mensaje("warning","Error","","Hay campos vacíos");
        throw_exception("");
        }
        if($incorrectosdueno){
            $this->mensaje("warning","Error","","Hay datos invalidos");
            throw_exception("");
        }
            
            
            
             // si se selecciono una foto nueva para el dueno
        if ($_FILES['fotonuevad']['name'] <> "") {
                  self::verificar_fotografia('fotonuevad');
                  $dueno->set('foto',self::insertar_fotografia('fotonuevad',$this->post->cedula));
        }
        else{
                  $dueno->set('foto',$this->post->fotoviejad);
        }
            
        $this->orm->update_data("normal",$dueno);
      
            
            
        }
               
        
        
        
        $this->orm->close();
        
        
        
        $dir = $gvar['l_global']."buscar_animal.php";
        $this->mensaje("warning","Confirmacion",$dir,"Edicion exitosa"); 
    
    }
    public function mostrarEditables(){
        
        // verifica si tiene dueño
        if(!is_empty($this->post->dueno)) {
            $this->engine->assign('dueno',$this->post->dueno);
            
            // hace la consulta del dueño por el id
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
        
        self::asignar_datos_animal($this->post->id,$this->post->nombre,$this->post->foto,$this->post->fecha_de_nacimiento,$this->post->peso,$this->post->talla,$this->post->genero,$this->post->especie);
        
    
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
                else if($this->get->option=="actualizar"){
                    $this->{$this->get->option}();
                }
                
                else{throw_exception("Opción ". $this->get->option." no disponible");}
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
            $this->post->foto = $this->post->fotovieja;
            $this->post->nombre = $this->post->nombre_animal;
            $this->mostrarEditables();
            }
        $this->display();
    }
        
}

    $call = new c_editar_animal();
    $call->run();


?>