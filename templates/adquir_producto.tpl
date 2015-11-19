<html>
<head>
    <meta charset="UTF-8">
    <title></title>
    <link rel="stylesheet" type="text/css" href="vetsoft.css"/>
    <link rel="stylesheet" type="text/css" href="bootstrap.css"/>
</head>
<body>
    <header>
    </header>
    <div class="container">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <form class="form-horizontal" action="{$gvar.l_global}adquirir_producto.php?option=agregar" method="post">
                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-6">
                        <h4>Nombre</h4>
                        <input type="text" {if isset($nombre_p)}value="{$nombre_p}"{/if} {if isset($nombre_vacio)} style="background-color: #F78181" {/if} class="form-control default_color" name="nombre" placeholder="Nombre">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-6">
                        <h4>Marca</h4>
                        <input type="text" {if isset($marca)}value="{$marca}"{/if} {if isset($marca_vacio)} style="background-color: #F78181" {/if} class="form-control default_color" name="marca" placeholder="Marca">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-6">
                        <h4>Cantidad</h4>
                        <input type="text" {if isset($cantidad)}value="{$cantidad}"{/if} {if isset($cantidad_vacio) or isset($cantidad_invalido)} style="background-color: #F78181" {/if} class="form-control default_color" name="cantidad" placeholder="Número de unidades">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-6">
                        <h4>Precio Neto (COP)</h4>
                        <input type="text" {if isset($precio_neto)}value="{$precio_neto}"{/if} {if isset($precio_neto_vacio) or isset($precio_neto_invalido)} style="background-color: #F78181" {/if} class="form-control default_color" name="precio_neto" placeholder="Precio Neto">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-6">
                        <h4>Tipo</h4>
                        <select name="tipo" class="form-control default_color" {if isset($tipo_vacio) or isset($tipo_invalido)} style="background-color: #F78181" {/if}>
                            <option value="seleccion">Seleccion</option>
                            <option value="medicamento">Medicamento</option>
                            <option value="implemento">Implemento</option>
                        </select> 
                    </div>
                </div> 
            </br>
            </br>
            </br>
                <div class="col-sm-offset-5 col-sm-6">              
                    <button class="btn btn-default" type="submit"><span class="fa fa-check"></span> Agregar</button>
                    <a href="{$gvar.l_global}adquirir_producto.php?option=cancelar" class="btn btn-default" role="button"><span class="fa fa-close"></span> Cancelar</a>

                </div>
            </form>
        </div>
    </div>
</body>
</html>
<script type="text/javascript">
    $(".default_color").focus(function(){
        $(this).attr("style","");
    });
</script>


