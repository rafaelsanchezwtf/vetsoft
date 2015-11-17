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
            <form class="form-horizontal" action="{$gvar.l_global}contratar_veterinario.php" method="post">
                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-6">
                        <h4>Identificacion*</h4>
                        <input type="text" {if isset($id_v)}value="{$id_v}"{/if} {if isset($id_v_vacio) or isset($id_v_invalido)} style="background-color: #F78181" {/if} class="form-control" name="identificacion" placeholder="Identificacion">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-6">
                        <h4>Nombre*</h4>
                        <input type="text" {if isset($nombre_v)}value="{$nombre_v}"{/if} {if isset($nombre_v_vacio)} style="background-color: #F78181" {/if} class="form-control" name="nombre" placeholder="Nombre">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-6">
                        <h4>Telefeono*</h4>
                        <input type="text" {if isset($telefono_v)}value="{$telefono_v}"{/if} {if isset($telefono_v_vacio) or isset($telefono_v_invalido)} style="background-color: #F78181" {/if} class="form-control" name="telefono" placeholder="Telefono">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-6">
                        <h4>Email*</h4>
                        <input type="text" {if isset($email_v)}value="{$email_v}"{/if} {if isset($email_v_vacio) or isset($email_v_invalido)} style="background-color: #F78181" {/if} class="form-control" name="email" placeholder="Email">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-6">
                        <h4>Sueldo* (COP)</h4>
                        <input type="text" {if isset($sueldo_v)}value="{$sueldo_v}"{/if} {if isset($sueldo_v_vacio) or isset($sueldo_v_invalido)} style="background-color: #F78181" {/if} class="form-control" name="sueldo" placeholder="Sueldo">
                    </div>
                </div> 
            </br>
            
            <div class="col-sm-offset-3 col-sm-6">
                * Campos obligatorios.
            </div>
            </br>
            </br>
                <div class="col-sm-offset-5 col-sm-6">              
                    <input class="btn btn-primary" name="contratar" type="submit" value="Contratar"/>
                    <input class="btn btn-primary" name="cancelar" type="submit" value="Cancelar"/>
                </div>
            </form>
        </div>
    </div>
    

    <footer>
    </footer>
</body>
</html>

