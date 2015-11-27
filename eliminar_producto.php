<?php

require('configs/include.php');
        
class c_eliminar_producto extends super_controller {


    public function eliminar(){
        $producto = new producto($this->post);
        $this->orm->connect();  
        $this->orm->delete_data("normal",$producto);   
        $this->orm->close();
        
        $dir = $gvar['l_global']."buscar_producto.php";
        $this->mensaje("warning","Información",$dir,"Borrado exitoso"); 
        
        // para evitar el display de un error por inexistencia del registro recien borrado
        $this->get->option='cancelar';
    }
    public function cancelar(){
        $dir = $gvar['l_global']."buscar_producto.php";
        $this->mensaje("warning","Información",$dir,"Operacion cancelada por el adminsitardor");
    }

    public function buscar(){
        $opcion = $this->post->optradio;
        $valor = $_POST['codigo'];
        if(is_empty($valor) AND is_empty($opcion)){
            $consulta = "all";   
        }
        else{
            switch ($opcion) {
                case 'n':
                    if (!(is_empty($valor))){
                        $consulta = "by_nombre";    
                    }else{
                        $this->engine->assign('error1',1);
                        $this->mensaje("warning","Error","","El campo de busqueda está vacío");
                        throw_exception("");
                    }
                    break;

                case 'p':
                    if (is_numeric($valor)){
                        if($valor<0){
                            $this->engine->assign('error2',2);
                            $this->mensaje("warning","Error","","Dato incorrecto");
                            throw_exception("");
                        }else{
                            $consulta = "by_precio"; 
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

                case 'f':
                    if (is_numeric($valor)){
                        if($valor<0){
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

                case 'm':
                    if (!(is_empty($valor))){
                        $consulta = "by_marca";    
                    }else{
                        $this->engine->assign('error1',1);
                        $this->mensaje("warning","Error","","El campo de busqueda está vacío");
                        throw_exception("");
                    }
                    break;
                case 't':
                    if (!(is_empty($valor))){
                        if((strcmp ( $valor , "medicamento" )==0) or (strcmp ( $valor , "implemento" )==0)){
                            $consulta = "by_tipo";
                        }else{
                            $this->engine->assign('error1',2);
                            $this->mensaje("warning","Error","","El creterio de búsqueda solo recibe los tipos implemneto o medicamento.");
                            throw_exception("");  
                        }
                            
                    }else{
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
        $options['producto']['lvl2'] = $consulta;
        $cod['producto']['valor'] = $valor;
        $this->orm->connect();
        $this->orm->read_data(array("producto"), $options, $cod);
        $productos = $this->orm->get_objects("producto");        
        $this->orm->close();
        if (is_empty($productos)){
            $this->engine->assign('error3',3);
            $this->mensaje("warning","Error","","No existen coincidencias!");
            throw_exception("");
        }else{
            $this->engine->assign("productos",$productos);
        }
    }
    
    
    public function display(){
        

        $this->engine->assign('title', "Eliminar Producto");
        $this->engine->assign('nombre',$this->session['usuario']['nombre']);
        $this->engine->assign('tipo',$this->session['usuario']['tipo']);
        $this->engine->display('cabecera.tpl');
        if (($this->session['usuario']['tipo'] == "administrador")){
            settype($data,'object');
            $data->id=$this->post->id;
            $data->nombre=$this->post->nombre_p;
            $data->marca=$this->post->marca;
            $data->cantidad=$this->post->cantidad_viejo;
            $data->precio_unidad=$this->post->precio_unidad;
            $data->fecha_de_adquisicion=$this->post->fecha_de_adquisicion;
            $data->tipo=$this->post->tipo;
            $producto=new producto($data);
            $this->engine->assign('producto',$producto);
            $this->engine->display($this->temp_aux);
            $this->engine->display('eliminar_producto.tpl');
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