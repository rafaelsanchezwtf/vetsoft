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
            <form class="form-horizontal" action="{$gvar.l_global}adquirir_producto.php?" method="post">
                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-6">
                        <h4>Nombre</h4>
                        <input type="text" {if isset($nombre_p)}value="{$nombre_p}"{/if} {if isset($nombre_vacio)} style="background-color: #F78181" {/if} class="form-control" name="nombre" placeholder="Nombre">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-6">
                        <h4>Marca</h4>
                        <input type="text" {if isset($marca)}value="{$marca}"{/if} {if isset($marca_vacio)} style="background-color: #F78181" {/if} class="form-control" name="marca" placeholder="Marca">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-6">
                        <h4>Cantidad</h4>
                        <input type="text" {if isset($cantidad)}value="{$cantidad}"{/if} {if isset($cantidad_vacio) or isset($cantidad_invalido)} style="background-color: #F78181" {/if} class="form-control" name="cantidad" placeholder="Cantidad">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-6">
                        <h4>Tipo</h4>
                        <select name="tipo" class="col-sm-offset-0 col-sm-6" {if isset($tipo_vacio) or isset($tipo_invalido)} style="background-color: #F78181" {/if}>
                            <option value="sel">Seleccion</option>
                            <option value="medicamento">Medicamento</option>
                            <option value="implemento">Implemento</option>
                        </select> 
                    </div>
                </div> 
            </br>
            </br>
            </br>
                <div class="col-sm-offset-5 col-sm-6">              
                    <input class="btn btn-primary" name="agregar" type="submit" value="Agregar"/>
                    <input class="btn btn-primary" name="cancelar" type="submit" value="Cancelar"/>
                </div>
            </form>
        </div>
    </div>
    

    <footer>
    </footer>
</body>
</html>

