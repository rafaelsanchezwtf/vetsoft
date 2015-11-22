<div class="container">
    <section class="main row" >
    <h1>Editar veterinario</h1><br>
    <form action="{$gvar.l_global}editar_veterinario.php?option=actualizar" method="post">
    
   
    {if isset($identificacion)}
           
           
                   <b> Información del veterinario:</b><br>
                   <hr>
                   
                   <div class="camposeditar">
                   
                       <input type="hidden" value="{$identificacion}" name="identificacion" >
                       <div class="input-group">
                          <span class="input-group-addon" >Nombre</span>
                          <input type="text" class="form-control " value="{$nombre_veterinario}" required name="nombre" aria-describedby="basic-addon1" {if isset($nombre_vacio)} style="background-color: #F78181" {/if}>
                        </div>
                   </div>
                       
                    <div class="camposeditar">
                        <div class="input-group" >
                            <span class="input-group-addon">Telefono</span>
                            <input  class="form-control " type="text" value="{$telefono}" required name="telefono" aria-describedby="basic-addon1" {if isset($telefono_vacio) or isset($telefono_invalido)} style="background-color: #F78181" {/if}>
                        </div>
                    </div> 
                     
                      <div class="camposeditar">
                        <div class="input-group">
                            <span class="input-group-addon" >Email</span>
                            <input class="form-control " type="email" value="{$email}" required name="email" aria-describedby="basic-addon1" {if isset($email_vacio) or isset($email_invalido)} style="background-color: #F78181" {/if}>
                        </div>
                    </div> 
                       
                     <div class="camposeditar">
                        <div class="input-group">
                            <span class="input-group-addon" >Sueldo</span>
                            <input type="text" value="{$sueldo}" required name="sueldo"  class="form-control " aria-describedby="basic-addon1" {if isset($sueldo_vacio) or isset($sueldo_invalido)} style="background-color: #F78181" {/if}>
                        </div>
                    </div>  
                  
                                  
                    <button class="btn btn-default" type="submit"><span class="fa fa-check"></span> Aceptar</button>
                        <a href="{$gvar.l_global}editar_veterinario.php?option=cancelar" class="btn btn-default" role="button"><span class="fa fa-close"></span> Cancelar</a>    
                    

                          
            
           
                {/if}
                
               
    </form>
    </section>
</div>

<script type="text/javascript">
    $(".form-control").focus(function(){
        $(this).attr("style","");
    });
    
 
</script>


                       
                    






