<div class="container">

    
            <div class="table-responsive">
                <table class="table table-hover">
                    <tr class="info">
                        <th>Código</th>
                        <th>Nombre</th>
                        <th>Fecha de adquisición</th>
                        <th>Marca</th>
                        <th>Precio</th>
                        <th>Tipo</th>
                          
                    </tr>
                    {for $j=0 to count($productos)-1}
                    <tr>
                            <td>{$productos[$j]->get("id")}</td>
                            <td>{$productos[$j]->get("nombre")}</td>
                            <td>{$productos[$j]->get("fecha_de_adquisicion")}</dh>
                            <td>{$productos[$j]->get("marca")}</td>
                            <td>{$productos[$j]->get("precio_unidad")}</td>
                            <td>{$productos[$j]->get("tipo")}</td>
                         

                      </tr>    
                    {/for}
                </table>
        </div>
    
                 
            <div class="row" >
                <div class="col-xs-6" align="center">
                    <form class="form-group" method="post" action="{$gvar.l_global}buscar_producto.php?option=eliminar">
                    
                            <button type="submit" class="btn btn-primary"><span class="fa fa-search"></span> Eliminar</button>         
                    
                </form>
                </div>
                <div align="center">
                    <form class="form-group" method="post" action="{$gvar.l_global}eliminar_producto.php?option=">
                    
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