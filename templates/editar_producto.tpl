<div class="container">
    <section class="main row" >
    <h1>Editar Producto</h1><br>
    <form action="{$gvar.l_global}editar_producto.php?option=actualizar" method="post" >
    
    
    {if isset($id)}
           
            
               
                   <b> Información del producto:</b><br>
                   <hr>
                   
                   <div class="camposeditar">
                   
                       <input type="hidden" value="{$id}" name="id" >
                       <input type="hidden" value="{$cantidadbd}" name="cantidadbd" >
                       
                       <div class="input-group">
                          <span class="input-group-addon" >Nombre*</span>
                          <input type="text" class="form-control " value="{$nombre_p}" required name="nombre_p" aria-describedby="basic-addon1" {if isset($nombre_vacio)} style="background-color: #F78181" {/if}>
                        </div>
                   </div>
                       
                    <div class="camposeditar">
                        <div class="input-group" >
                            <span class="input-group-addon">Marca*</span>
                            <input  class="form-control " type="text" value="{$marca}" required  name="marca" aria-describedby="basic-addon1" {if isset($marca_vacio)} style="background-color: #F78181" {/if}>
                        </div>
                    </div> 
                     
                      <div class="camposeditar">
                        <div class="input-group">
                            <span class="input-group-addon" >Cantidad (Solo se permite aumentar)</span>
                            <input  class="form-control " type="time" value="{$cantidad}" required name="cantidad" aria-describedby="basic-addon1" {if isset($cantidad_vacio) or isset($cantidad_invalido)} style="background-color: #F78181" {/if}>
                        </div>
                    </div> 
                       
                     <div class="camposeditar">
                        <div class="input-group">
                            <span class="input-group-addon" >Fecha de adquisición*</span>
                            <input  id ="datepicker" type="date" value="{$fecha_de_adquisicion}" required name="fecha_de_adquisicion"  class="form-control " aria-describedby="basic-addon1" {if isset($fecha_vacio) or isset($fecha_invalido)} style="background-color: #F78181" {/if}>
                        </div>
                    </div>  
                     
                      <div class="camposeditar">
                        <div class="input-group">
                            <span class="input-group-addon" >Precio por unidad</span>
                            <input  class="form-control " type="time" value="{$precio_unidad}" required name="precio_unidad" aria-describedby="basic-addon1" {if isset($precio_unidad_vacio) or isset($precio_unidad_invalido)} style="background-color: #F78181" {/if}>
                        </div>
                    </div> 
                      
                      
                    <button class="btn btn-default" type="submit"><span class="fa fa-check"></span> Aceptar</button>
                        <a href="{$gvar.l_global}editar_producto.php?option=cancelar" class="btn btn-default" role="button"><span class="fa fa-close"></span> Cancelar</a>    
                    
                                                   
            
        
    {/if}
                
               
    </form>
    </section>
</div>

<script type="text/javascript">
    $(".form-control").focus(function(){
        $(this).attr("style","");
    });

    
</script>


                       
                    






