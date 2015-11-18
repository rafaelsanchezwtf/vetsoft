<title>{$title}</title>
<section class="main row" >
            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-5 panelperfil">
                <form class="form-horizontal">
                    <div class="page-header text-center titulobienvenida">
                      <h1>Bienvenido(a) {$nombre}</h1>
                    </div>
                      <div class="panel panel-default paneladmin">
                          <div class="panel-heading text-center">
                            <h3 class="panel-title">Opciones</h3>
                          </div>
                          <div class="panel-body text-center ">
                           
                            <div class="form-group">
                                <div class=" col-xs-8 col-sm-8 col-md-8 col-lg-8 parcito">
                                    <a href="{$gvar.l_global}buscar_animal.php" class="btn btn-default opcion" role="button">Buscar Animal</a>
                                    <a href="{$gvar.l_global}buscar_cita.php" class="btn btn-default opcion" role="button">Buscar Cita</a>
                                </div>
                                <div class=" col-xs-8 col-sm-8 col-md-8 col-lg-8 parcito" >
                                    <a href="{$gvar.l_global}buscar_tratamiento.php" class="btn btn-default opcion" role="button">Buscar Tratamiento</a>
                                    <a href="{$gvar.l_global}historia_clinica.php" class="btn btn-default opcion" role="button">Ver Historia Clínica</a>
                                </div>
                                <div class=" col-xs-8 col-sm-8 col-md-8 col-lg-8  parcito" >
                                </div>
                            </div>
                          </div>
                    </div> 
                </form>
            </div>
        </section>