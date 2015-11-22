<div class="container">
    <section class="main row" >
    
    <form action="{$gvar.l_global}editar_cita.php?option=actualizar" method="post" >
    
    
    {if isset($codigo)}
           
            
               
                   <b> Información de la cita:</b><br>
                   <hr>
                   
                   <div class="camposeditar">
                   
                       <input type="hidden" value="{$codigo}" name="codigo" >
                       <input type="hidden" value="{$animal}" name="animal" >
                       
                       <div class="input-group">
                          <span class="input-group-addon" >Motivo*</span>
                          <input type="text" class="form-control " value="{$motivo}" required name="motivo" aria-describedby="basic-addon1" {if isset($motivo_vacio)} style="background-color: #F78181" {/if}>
                        </div>
                   </div>
                       
                    <div class="camposeditar">
                        <div class="input-group" >
                            <span class="input-group-addon">Fecha*</span>
                            <input id ="datepicker" class="form-control " type="date" value="{$fecha}" required placeholder="YYYY-mm-dd" name="fecha" aria-describedby="basic-addon1" {if isset($fecha_vacio) or isset($fecha_invalido)} style="background-color: #F78181" {/if}>
                        </div>
                    </div> 
                     
                      <div class="camposeditar">
                        <div class="input-group">
                            <span class="input-group-addon" >Hora* (HH:MM)</span>
                            <input  class="form-control " type="time" value="{$hora}" required name="hora" aria-describedby="basic-addon1" {if isset($hora_vacio) or isset($hora_c_invalido)} style="background-color: #F78181" {/if}>
                        </div>
                    </div> 
                       
                     <div class="camposeditar">
                        <div class="input-group">
                            <span class="input-group-addon" >Lugar*</span>
                            <input type="text" value="{$lugar}" required name="lugar"  class="form-control " aria-describedby="basic-addon1" {if isset($lugar_vacio)} style="background-color: #F78181" {/if}>
                        </div>
                    </div>  
                      
                      
                    <button class="btn btn-default" type="submit"><span class="fa fa-check"></span> Aceptar</button>
                        <a href="{$gvar.l_global}editar_cita.php?option=cancelar" class="btn btn-default" role="button"><span class="fa fa-close"></span> Cancelar</a>    
                    
                                                   
            
        
    {/if}
                
               
    </form>
    </section>
</div>

<script type="text/javascript">
    $(".form-control").focus(function(){
        $(this).attr("style","");
    });

    
</script>


                       
                    






