<div class="container">
{if isset($veterinario)}
     <h2><div class="alert alert-danger">¿Realmente deseas eliminar este veterinario?</div></h2>
            <div class="table-responsive">
                <table class="table table-hover">
                    <tr class="info">
                        <th>Identificación</th>
                        <th>Nombre</th>
                        <th>Teléfono</th>
                        <th>Email</th>
                        <th>Sueldo</th>
                          
                    </tr>
                    
                    <tr>
                            <td>{$veterinario->get("identificacion")}</td>
                            <td>{$veterinario->get("nombre")}</td>
                            <td>{$veterinario->get("telefono")}</dh>
                            <td>{$veterinario->get("email")}</td>
                            <td>{$veterinario->get("sueldo")}</td>
                    </tr>    
                    
                </table>
        </div>
    
{/if}                 
            <div class="row" >
                <div class="col-xs-6" align="center">
                    <form class="form-group" method="post" action="{$gvar.l_global}eliminar_veterinario.php?option=eliminar">
                            <input type="hidden" name="identificacion" value="{$veterinario->get('identificacion')}">
                            <input type="hidden" name="bandera" value="1">
                            <button type="submit" class="btn btn-primary"><span class="fa fa-search"></span> Eliminar</button>         
                    
                </form>
                </div>
                <div align="center">
                    <form class="form-group" method="post" action="{$gvar.l_global}eliminar_veterinario.php?option=cancelar">
                    
                            <button type="submit" class="btn btn-primary"><span class="fa fa-search"></span> Cancelar</button>         
                    
                </form>

                </div>
                


            </div>

</div>
<div class="container">
    
</div>
<script type="text/javascript">
    $(".default_color").focus(function(){
        $(this).attr("style","");
    });
</script>