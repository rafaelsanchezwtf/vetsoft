<div class="container">
<section class="main row">                   
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12"  style="margin-top: 10px;">
                <form class="form-horizontal" method="post" action="{$gvar.l_global}buscar_producto.php?option=buscar">
                    <div class="form-group">
                        <h3 align="center"><b>Ingrese un valor en el campo de busqueda</b></h3>
                        <div class="col-sm-offset-4 col-sm-4">
                            
                            <input {if isset($error1)} style="background-color: #F78181" {/if} {if isset($error2)} style="background-color: #F78181" {/if} title="Ingrese un valor numérico." type="text" class="form-control default_color" name="codigo" placeholder="Campo de busqueda"/>
                        </div>
                    </div>
                        <h4 align="center">Criterio de busqueda</h4>
        
                    <div class="form-group">
                        <div class="col-sm-offset-4 col-sm-6">
                            
                            
                            <label class="radio-inline"><input type="radio" name="optradio" value="n">Nombre</label>
                            <label class="radio-inline"><input type="radio" name="optradio" value="f">Fecha de adquisición</label>                            
                            <label class="radio-inline"><input type="radio" name="optradio" value="m">Marca</label>
                            <label class="radio-inline"><input type="radio" name="optradio" value="p">Precio</label>
                            <label class="radio-inline"><input type="radio" name="optradio" value="t">Tipo</label>
                            
                            
                        </div>
                    </div>
                    <div class="form-group">
                            <button type="submit" class="col-sm-offset-5 col-sm-2 btn btn-primary"><span class="fa fa-search"></span> Buscar</button>         
                    </div>
                </form>
            </div>
</section>
</div>
<div class="container">
    {if isset($productos)}
            <div class="table-responsive">
                <table class="table table-hover">
                    <tr class="info">
                        <th>Código</th>
                        <th>Nombre</th>
                        <th>Fecha de adquisición</th>
                        <th>Marca</th>
                        <th>Precio</th>
                        <th>Tipo</th>
                        <th>Editar</th>
                        <th>Eliminar</th>   
                    </tr>
                    {for $j=0 to count($productos)-1}
                    <tr>
                            <td>{$productos[$j]->get("id")}</td>
                            <td>{$productos[$j]->get("nombre")}</td>
                            <td>{$productos[$j]->get("fecha_de_adquisicion")}</dh>
                            <td>{$productos[$j]->get("marca")}</td>
                            <td>{$productos[$j]->get("precio_neto")}</td>
                            <td>{$productos[$j]->get("tipo")}</td>
                          
                       
                        <form action="{$gvar.l_global}editar_producto.php" method="post">    
                            <input type="hidden" name="id" value="{$productos[$j]->get('id')}">
                            <input type="hidden" name="nombre" value="{$productos[$j]->get('nombre')}">
                            <input type="hidden" name="marca" value="{$productos[$j]->get('marca')}">
                            <input type="hidden" name="cantidad" value="{$productos[$j]->get('cantidad')}">
                            <input type="hidden" name="fecha_de_adquisicion" value="{$productos[$j]->get('fecha_de_adquisicion')}">
                            
 

                            <td><button type ="submit" class="btn btn-primary"><span class="fa fa-edit"></span> Editar</button></td>
                        </form>
                        
                        
                        
                        <form action="{$gvar.l_global}eliminar_producto.php" method="post">    
                            <input type="hidden" name="id" value="{$productos[$j]->get('id')}">
                            <td><button type ="submit" class="btn btn-primary"><span class="fa fa-close"></span> Eliminar</button></td>
                        </form>
                         

                      </tr>    
                    {/for}
                </table>
        </div>
    {/if}
</div>
<script type="text/javascript">
    $(".default_color").focus(function(){
        $(this).attr("style","");
    });
</script>