<title>{$title}</title>
<section class="main row" >
            
            <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8 panelperfil">
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
                                   <a href="{$gvar.l_global}registrar_animal.php" class="btn btn-default opcion" role="button">Registrar animal</a>
                                    <button type="submit" class="btn btn-default opcion">Contratar veterinario</button>
                                </div>
                                <div class=" col-xs-8 col-sm-8 col-md-8 col-lg-8 parcito">
                                    <button type="submit" class="btn btn-default opcion">Buscar animal</button>
                                    <button type="submit" class="btn btn-default opcion">Buscar producto</button>
                                </div>
                                <div class=" col-xs-8 col-sm-8 col-md-8 col-lg-8  parcito">
                                    <button type="submit" class="btn btn-default opcion">Buscar veterinario</button>
                                    <button type="submit" class="btn btn-default opcion">Asignar cita</button>
                                </div>
                            </div>

                          </div>
                    </div> 
                </form>
            </div>
        </section>