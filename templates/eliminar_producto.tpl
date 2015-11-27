<div class="container">

     <h2><div class="alert alert-danger">¿Realmente deseas eliminar este producto?</div></h2>
            <div class="table-responsive">
                <table class="table table-hover">
                    <tr class="info">
                        <th>Código</th>
                        <th>Nombre</th>
                        <th>Fecha de adquisición</th>
                        <th>Marca</th>
                        <th>Cantidad</th>
                        <th>Precio</th>
                        <th>Tipo</th>
                          
                    </tr>
                    
                    <tr>
                            <td>{$producto->get("id")}</td>
                            <td>{$producto->get("nombre")}</td>
                            <td>{$producto->get("fecha_de_adquisicion")}</dh>
                            <td>{$producto->get("marca")}</td>
                            <td>{$producto->get("cantidad")}</td>
                            <td>{$producto->get("precio_unidad")}</td>
                            <td>{$producto->get("tipo")}</td>
                         

                      </tr>    
                    
                </table>
        </div>
    
                 
            <div class="row" >
                <div class="col-xs-6" align="center">
                    <form class="form-group" method="post" action="{$gvar.l_global}eliminar_producto.php?option=eliminar">
                            <input type="hidden" name="id" value="{$producto->get('id')}">
                            <button type="submit" class="btn btn-primary"><span class="fa fa-search"></span> Eliminar</button>         
                    
                </form>
                </div>
                <div align="center">
                    <form class="form-group" method="post" action="{$gvar.l_global}eliminar_producto.php?option=cancelar">
                    
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