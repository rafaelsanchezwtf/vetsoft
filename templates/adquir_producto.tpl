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
                        <input type="text" class="form-control" name="nombre" placeholder="Nombre">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-6">
                        <h4>Marca</h4>
                        <input type="text" class="form-control" name="marca" placeholder="Marca">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-6">
                        <h4>Cantidad</h4>
                        <input type="number" class="form-control" name="cantidad" placeholder="Cantidad">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-6">
                        <h4>Tipo</h4>
                        <select name="tipo" class="col-sm-offset-0 col-sm-6">
                              <option value="">Seleccion</option>
                              <option value="medicamento">Medicamento</option>
                              <option value="implemento">Implemento</option>
                        </select> 
                    </div>
                </div> 
            </br>
            </br>
            </br>
                <div class="col-sm-offset-5 col-sm-6">              
                    <button type="submit" name="agregar" class="btn btn-primary">Agregar</button>
                    <button type="submit" name="cancelar" class="btn btn-primary">Cancelar</button>
                </div>
            </form>
        </div>
    </div>
    

    <footer>
    </footer>
</body>
</html>

