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
    <div>
        <b>PACIENTE: {$nombre_animal}</b><br/>
        <b>Por favor ingrese los datos del tratamiento:</b><br/>
    </div>
    <div class="container">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <form class="form-horizontal" action="{$gvar.l_global}asignar_tratamiento.php?option=asignar" method="post">
                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-4">
                        <h4>Titulo*</h4>
                        <input type="text" {if isset($titulo_t)}value="{$titulo_t}"{/if} {if isset($titulo_t_vacio)} style="background-color: #F78181" {/if} class="form-control default_color" name="titulo" placeholder="Nombre del tratamiento">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-7">
                        <h4>Descripción*</h4>
                        <input type="text" {if isset($descripcion_t)}value="{$descripcion_t}"{/if} {if isset($descripcion_t_vacio)} style="background-color: #F78181" {/if} class="form-control default_color" name="descripcion" placeholder="Detalles del tratamiento">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-2">
                        <h4>Fecha*</h4>
                        <input type="text" {if isset($fecha_t)}value="{$fecha_t}"{/if} {if isset($fecha_t_vacio) or isset($fecha_t_invalido)} style="background-color: #F78181" {/if} class="form-control default_color" name="fecha" placeholder="YYY-mm-dd">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-2">
                        <h4>Hora* (24 hrs)</h4>
                        <input type="text" {if isset($hora_t)}value="{$hora_t}"{/if} {if isset($hora_t_vacio) or isset($hora_t_invalido)} style="background-color: #F78181" {/if} class="form-control default_color" name="hora" placeholder="HH:MM:SS">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-6">
                        <h4>Lugar*</h4>
                        <input type="text" {if isset($lugar_t)}value="{$lugar_t}"{/if} {if isset($lugar_t_vacio)} style="background-color: #F78181" {/if} class="form-control default_color" name="lugar" placeholder="Lugar del tratamiento">
                    </div>
                </div>
            </br>
            <div class="col-sm-offset-3 col-sm-6">
                * Campos obligatorios.
            </div>
            </br>
            </br>
                <input type="hidden" name="nombre" value="{$nombre_animal}">
                <input type="hidden" name="id" value="{$id_animal}">
                <div class="col-sm-offset-5 col-sm-6">              
                    <button class="btn btn-default" type="submit"><span class="fa fa-check"></span> Asignar</button>
                    <a href="{$gvar.l_global}asignar_tratamiento.php?option=cancelar" class="btn btn-default" role="button"><span class="fa fa-close"></span> Cancelar</a>
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

