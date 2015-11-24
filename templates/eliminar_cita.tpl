<div class="container">

    
            <div class="table-responsive">
                <table class="table table-hover">
                    <tr class="info">
                        <th>Código</th>
                        <th>Motivo</th>
                        <th>Fecha</th>
                        <th>Hora</th>
                        <th>Lugar</th>
                          
                    </tr>
                    
                    
                    <tr>
                            <td>{$cita->get("codigo")}</td>
                            <td>{$cita->get("motivo")}</td>
                            <td>{$cita->get("fecha")}</dh>
                            <td>{$cita->get("hora")}</td>
                            <td>{$cita->get("lugar")}</td>
                         

                      </tr>    
                   
                </table>
        </div>
    
                 
            <div class="row" >
                <div class="col-xs-6" align="center">
                    <form class="form-group" method="post" action="{$gvar.l_global}eliminar_cita.php?option=eliminar">
                            <input type="hidden" name="codigo" value="{$cita->get('codigo')}">
                            <input type="hidden" name="hora" value="{$cita->get('hora')}">
                            <input type="hidden" name="fecha" value="{$cita->get('fecha')}">
                            <button type="submit" class="btn btn-primary"><span class="fa fa-search"></span> Eliminar</button>         
                    
                </form>
                </div>
                <div align="center">
                    <form class="form-group" method="post" action="{$gvar.l_global}eliminar_cita.php?option=cancelar">
                    
                            <button type="submit" class="btn btn-primary"><span class="fa fa-search"></span> Cancelar</button>         
                    
                </form>

                </div>
                


            </div>

</div>
<div class="container">
    
</div>