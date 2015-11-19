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
    <div class="container">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <form class="form-horizontal" action="{$gvar.l_global}contratar_veterinario.php" method="post">
                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-6">
                        <h4>Identificacion*</h4>
                        <input type="text" {if isset($id_v)}value="{$id_v}"{/if} {if isset($id_v_vacio) or isset($id_v_invalido)} style="background-color: #F78181" {/if} class="form-control default_color" name="identificacion" placeholder="Identificacion">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-6">
                        <h4>Nombre*</h4>
                        <input type="text" {if isset($nombre_v)}value="{$nombre_v}"{/if} {if isset($nombre_v_vacio)} style="background-color: #F78181" {/if} class="form-control default_color" name="nombre" placeholder="Nombre">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-6">
                        <h4>Telefeono*</h4>
                        <input type="text" {if isset($telefono_v)}value="{$telefono_v}"{/if} {if isset($telefono_v_vacio) or isset($telefono_v_invalido)} style="background-color: #F78181" {/if} class="form-control default_color" name="telefono" placeholder="Telefono">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-6">
                        <h4>Email*</h4>
                        <input type="text" {if isset($email_v)}value="{$email_v}"{/if} {if isset($email_v_vacio) or isset($email_v_invalido)} style="background-color: #F78181" {/if} class="form-control default_color" name="email" placeholder="Email">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-6">
                        <h4>Sueldo* (COP)</h4>
                        <input type="text" {if isset($sueldo_v)}value="{$sueldo_v}"{/if} {if isset($sueldo_v_vacio) or isset($sueldo_v_invalido)} style="background-color: #F78181" {/if} class="form-control default_color" name="sueldo" placeholder="Sueldo">
                    </div>
                </div> 
            </br>
            
            <div class="col-sm-offset-3 col-sm-6">
                * Campos obligatorios.
            </div>
            </br>
            </br>
                <div class="col-sm-offset-5 col-sm-6">              
                    <a href="{$gvar.l_global}contratar_veterinario.php?option=contratar" class="btn btn-default" role="button"><span class="fa fa-check"></span> Contratar</a>
                    <a href="{$gvar.l_global}contratar_veterinario.php?option=cancelar" class="btn btn-default" role="button"><span class="fa fa-close"></span> Cancelar</a>
                </div>
            </form>
        </div>
    </div>
    <script type="text/javascript">
        $(".default_color").focus(function(){
            $(this).attr("style","");
        });
    </script>
</body>
</html>

