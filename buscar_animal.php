<?php

require('configs/include.php');

class c_buscar_animal extends super_controller {

    public function buscar(){
        function edad($fechanacimiento){
            list($ano,$mes,$dia) = explode("-",$fechanacimiento);
            $ano_diferencia  = date("Y") - $ano;
            if($mes<date("m")){
                $mes_diferencia  = date("m") - $mes;
                
            }elseif($mes==date("m")){
                $mes_diferencia  =1;
            }else{
                $mes_diferencia  = (12 - date("m")) + $mes;
            }
            return ($ano_diferencia*12)+$mes_diferencia;
        }
        $id= $_POST['codigo'];
        if(is_empty($id)){
            $this->engine->assign('error1',1);
            throw_exception("Error, el campo de texto está vacío!");
            
        }
        elseif(is_numeric($id)){
            $options['animal']['lvl2'] = "some";
            $cod['animal']['id'] = $id;
            $this->orm->connect();
            $this->orm->read_data(array("animal"), $options, $cod);
            $animales = $this->orm->get_objects("animal");
            $this->orm->close();
            if (is_empty($animales)){
                $this->engine->assign('error3',3);
                throw_exception("Código no existe o no ha sido asignado");
            }else{
                /*$cant=count($animales);
                $array = array();
                for($i=0;$i<$cant;$i++) {
                    settype($data,'object');  
                    $edad=$animales[$i]->get('fecha_de_nacimiento');
                    $edad=edad($edad);      
                    $data->id =$animales[$i]->get('id');
                    $data->nombre = $animales[$i]->get('nombre');
                    $data->foto = $animales[$i]->get('foto');
                    $data->fecha_de_nacimiento =$edad;
                    $data->peso = $animales[$i]->get('peso');
                    $data->talla = $animales[$i]->get('talla');
                    $data->genero = $animales[$i]->get('genero');
                    $data->especie = $animales[$i]->get('especie');
                    $data->dueno = $animales[$i]->get('dueno');
                    $array[] = new animal($data);
                    
                }*/
                $this->engine->assign("animal",$animales);
            }
        }else{
            $this->engine->assign('error2',2);
            throw_exception("Dato incorrecto!");
        }

        #$this->engine->assign('type_warning','success');
        #$this->engine->assign('msg_warning',"Welcome!");
        $this->temp_aux = 'message.tpl';
    }
    
    
    public function display(){
        $this->engine->display('cabecera.tpl');
        // if ($this->session['usuario']['tipo'] == "administrador") {
            // echo $this->session['mensaje']['tipo']. $this->session['mensaje']['texto'];
            $this->engine->display($this->temp_aux);
            $this->engine->display('buscar_animal.tpl');
            // $this->engine->display($this->temp_aux);
        // }else{
            // $this->engine->assign('type_warning','Lo sentimos:');
            // $this->engine->assign('msg_warning',"Usted no tiene permiso para acceder a esta opción.");
            // $this->temp_aux = 'message.tpl';
            // $this->engine->display($this->temp_aux);    
        // }
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