<div class="container">
    <h2><div class="alert alert-danger">¿Realmente deseas eliminar este tratamiento?</div></h2>
    
            <div class="table-responsive">
                <table class="table table-hover">
                    <tr class="info">
                        <th>Código</th>
                        <th>Titulo</th>
                        <th>descripcion</th>
                        <th>Fecha</th>
                        <th>Hora</th>
                        <th>Lugar</th>
                          
                    </tr>
                    
                    
                    <tr>
                            <td>{$tratamiento->get("codigo")}</td>
                            <td>{$tratamiento->get("titulo")}</td>
                            <td>{$tratamiento->get("descripcion")}</td>
                            <td>{$tratamiento->get("fecha")}</dh>
                            <td>{$tratamiento->get("hora")}</td>
                            <td>{$tratamiento->get("lugar")}</td>
                         

                      </tr>    
                   
                </table>
        </div>
    
                 
            <div class="row" >
                <div class="col-xs-6" align="center">
                    <form class="form-group" method="post" action="{$gvar.l_global}eliminar_tratamiento.php?option=eliminar">
                            <input type="hidden" name="codigo" value="{$tratamiento->get('codigo')}">
                            <input type="hidden" name="animal" value="{$tratamiento->get('animal')}">
                            <button type="submit" class="btn btn-primary"><span class="fa fa-exclamation-triangle"></span> Eliminar</button>         
                    
                </form>
                </div>
                <div align="center">
                    <form class="form-group" method="post" action="{$gvar.l_global}eliminar_tratamiento.php?option=cancelar">
                    
                            <button type="submit" class="btn btn-primary"><span class="fa fa-search"></span> Cancelar</button>         
                    
                </form>

                </div>
                


            </div>

</div>
<div class="container">
    
</div>