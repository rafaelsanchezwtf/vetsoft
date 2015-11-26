<?php

require('configs/include.php');
        
class c_buscar_animal extends super_controller {

    public function buscar(){
        $opcion = $this->post->optradio;
        $valor = $_POST['codigo'];
        if(is_empty($valor) AND is_empty($opcion)){
            $consulta = "all";   
        }
        else{
            switch ($opcion) {
                case 'i':
                    if (is_numeric($valor) or $valor>0){
                        $consulta = "by_id";    
                    }elseif(!(is_numeric($valor)) or $valor<=0){
                        $this->engine->assign('error2',2);
                        $this->mensaje("warning","Error","","Dato incorrecto");
                        throw_exception("");
                    }elseif (is_empty($valor)){
                        $this->engine->assign('error1',1);
                        $this->mensaje("warning","Error","","El campo de busqueda está vacío");
                        throw_exception("");
                    }
                    break;

                case 'n':
                    if (!(is_empty($valor))){
                        $consulta = "by_nombre";    
                    }else{
                        $this->engine->assign('error1',1);
                        $this->mensaje("warning","Error","","El campo de busqueda está vacío");
                        throw_exception("");
                    }
                    break;

                case 'e':
                    if (!(is_empty($valor))){
                        $consulta = "by_especie";    
                    }else{
                        $this->engine->assign('error1',1);
                        $this->mensaje("warning","Error","","El campo de busqueda está vacío");
                        throw_exception("");
                    }
                    break;

                case 'f':
                    if (is_numeric($valor)){
                        if($valor<=0){
                            $this->engine->assign('error2',2);
                            $this->mensaje("warning","Error","","Dato incorrecto");
                            throw_exception("");
                        }else{
                            $consulta = "by_fecha";
                        }   
                    }elseif (!(is_numeric($valor))){
                        $this->engine->assign('error2',2);
                        $this->mensaje("warning","Error","","Dato incorrecto");
                        throw_exception("");
                    }elseif (is_empty($valor)){
                        $this->engine->assign('error1',1);
                        $this->mensaje("warning","Error","","El campo de busqueda está vacío");
                        throw_exception("");
                    }
                    break;
                
                default:
                    $this->mensaje("warning","Error","","Debe seleccionar un criterio de busqueda");
                    throw_exception(""); 
                    break;
            }
        }
        $options['animal']['lvl2'] = $consulta;
        $cod['animal']['valor'] = $valor;
        $this->orm->connect();
        $this->orm->read_data(array("animal"), $options, $cod);
        $animales = $this->orm->get_objects("animal");
        $this->orm->close();
        if (is_empty($animales)){
            $this->engine->assign('error3',3);
            $this->mensaje("warning","Error","","No existen coincidencias!");
            throw_exception("");
        }else{
            $this->engine->assign("animal",$animales);
        }
    }
    
    
    public function display(){
        $this->engine->assign('title', "Buscar Animal");
        $this->engine->assign('nombre',$this->session['usuario']['nombre']);
        $this->engine->assign('tipo',$this->session['usuario']['tipo']);
        $this->engine->display('cabecera.tpl');
        if (($this->session['usuario']['tipo'] == "administrador") OR ($this->session['usuario']['tipo'] == "veterinario")){
            $this->engine->display($this->temp_aux);
            $this->engine->display('buscar_animal.tpl');
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
                if ($this->get->option == "buscar")
                    $this->{$this->get->option}();
                else
                    throw_exception("Opción ". $this->get->option." no disponible");
            }
        } catch (Exception $e) {
            #$this->error=1;
            $this->msg_warning=$e->getMessage();
            $this->temp_aux = 'message.tpl';
            $this->engine->assign('type_warning',$this->type_warning);
            $this->engine->assign('msg_warning',$this->msg_warning);
        }
        $this->display();
    }
        
}

    $call = new c_buscar_animal();
    $call->run();


?>