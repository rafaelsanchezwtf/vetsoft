<div class="container">
<section class="main row">                   
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12"  style="margin-top: 10px;">
               
                <form class="form-inline" role="form" method="post" action="{$gvar.l_global}historia_clinica.php?option=buscar">
  <h3 align="center"><b>Ingrese el código completo del animal</b></h3>
                 
                  <div class="form-group center" >
                    
                    <input {if isset($error1)} style="background-color: #F78181" {/if} {if isset($error2)} style="background-color: #F78181" {/if} title="Ingrese un valor numérico." type="text" class="form-control default_color" name="id" placeholder="Código del animal"/>
                  </div>

                  <button type="submit" class="btn btn-default" >Buscar</button>
                </form>
                
            </div>
</section>
</div>


<div class="container">
    {if isset($tratamiento)}
            <div class="table-responsive">
                <table class="table table-hover">
                    <tr class="info">
                       <th>Fecha</th>
                        <th>Titulo</th>
                        <th>Descrip</th>
                        
                        <th>Hora</th>
                        <th>Lugar</th>
                        <th>Paciente</th>
                        <th>Duracion</th>
                        <th>Resultado</th>
                    </tr>
                    {for $j=0 to count($tratamiento)-1}
                    <tr>
                            <td>{$tratamiento[$j]->get("fecha")}</dh>
                            <td>{$tratamiento[$j]->get("titulo")}</td>
                            <td>{$tratamiento[$j]->get("descripcion")}</td>
                            
                            <td>{$tratamiento[$j]->get("hora")}</td>
                            <td>{$tratamiento[$j]->get("lugar")}</td>
                            <td>{$tratamiento[$j]->auxiliars['nombre_animal']}</td>
                            <td>{$tratamiento[$j]->get("duracion")}</td>
                            <td>{$tratamiento[$j]->get("resultado")}</td>


                      </tr>    
                    {/for}
                </table>
        </div>
    {/if}
</div>








