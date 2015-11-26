<html>
<head>
    <meta charset="UTF-8">
    <title></title>
    <link rel="stylesheet" type="text/css" href="css/vetsoft.css"/>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css"/>
</head>
<body>
    <header>
    </header>
    {if not isset($opciones) or $opciones eq "no"}
        <div>
            <b>Por favor elija una opción para continuar:</b><br/><br/>
        </div>
        <div class="container">
            <div class="col-sm-offset-1 col-sm-6">
                <form class="form-horizontal" action="{$gvar.l_global}usar_producto.php?option=mostrar_buscar" method="post">
                    <input type="hidden" name="tipo_prod" value="medicamento">             
                        <button class="btn btn-default" type="submit"><span class="fa fa-eyedropper"></span> Usar Medicamento</button>
                </form>
            </div>
            <br/>
            <br/>
            <div class="col-sm-offset-1 col-sm-6">
                 <form class="form-horizontal" action="{$gvar.l_global}usar_producto.php?option=mostrar_buscar" method="post">
                    <input type="hidden" name="tipo_prod" value="implemento">           
                        <button class="btn btn-default" type="submit"><span class="fa fa-legal"></span> Usar Implemento</button>
                </form>
            </div>
            <br/>
            <br/>
            <br/>
        </div>
        <a href="{$gvar.l_global}usar_producto.php?option=finalizar" class="btn btn-default" role="button"><span class="fa fa-check"></span> Finalizar</a>
    {else}
        {if $opciones_datos eq "medicamento"}
            <form class="form-horizontal" action="{$gvar.l_global}usar_producto.php?option=buscar_medicamento" method="post">
            <div class="col-sm-offset-1 col-sm-4">
                <input type="text" class="form-control default_color" name="nombre_prod" placeholder="Ingrese total o parcialmente el nombre del producto"/>
            </div>
            <div class="form-group">
                    <button type="submit" class=" btn btn-primary"><span class="fa fa-search"></span> Filtrar</button>         
            </div>
            </form>
        {else}
            <form class="form-horizontal" action="{$gvar.l_global}usar_producto.php?option=buscar_implemento" method="post">
            <div class="col-sm-offset-1 col-sm-4">
                <input type="text" class="form-control default_color" name="nombre_prod" placeholder="Ingrese total o parcialmente el nombre del producto"/>
            </div>
            <div class="form-group">
                    <button type="submit" class="btn btn-primary"><span class="fa fa-search"></span> Filtrar</button>         
            </div>
            </form>
        {/if}

        {if isset($producto)}
        <div class="container">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <tr class="info">
                                <th>Nombre</th>
                                <th>Marca</th>
                                <th>Unidades disponibles</th>
                                <th>Unidades a usar</th>
                                <th>Usar</th>
                            </tr>
                            {for $j=0 to count($producto)-1}
                                <tr>
                                    <form action="{$gvar.l_global}usar_producto.php?option=usar" method="post"> 
                                        <td>{$producto[$j]->get("nombre")}</td>
                                        <td>{$producto[$j]->get("marca")}</td>
                                        <td>{$producto[$j]->get("cantidad")}</td>
                                        <td><input type="number" min="1" name="cantidad_usar"></dh>
                                        <input type="hidden" name="cantidad_disponible" value="{$producto[$j]->get('cantidad')}">       
                                        <input type="hidden" name="id_prod" value="{$producto[$j]->get('id')}">

                                        <td><button type ="submit" class="btn btn-primary"><span class="fa fa-medkit"></span> Usar</button></td>
                                    </form>
                                </tr>    
                            {/for}
                        </table>
                </div>
        </div>
         {/if}
         <a href="{$gvar.l_global}usar_producto.php?option=atras" class="btn btn-default" role="button"><span class="fa fa-close"></span> Atras</a>
    {/if}
    <script type="text/javascript">
        $(".default_color").focus(function(){
            $(this).attr("style","");
        });
    </script>
</body>
</html>

