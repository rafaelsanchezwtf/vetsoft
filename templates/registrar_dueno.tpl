<div>
    <b>Datos del dueño:</b><br /><br />
</div>
<div class="col-sm-offset-3 col-sm-10">
    <form action="{$gvar.l_global}login.php" method="post">
        <table width="100%" border="0" cellpadding="0" cellspacing="5">
            <tr>
                <td>
                    
                    <b>Cedula:</b> <input class="input" type="text" required name="cedula"/>
                    &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                    <b>Telefono:</b> <input type="numeric" required name="telefono"/></br></br>
                    
                    <b>Nombre:</b> <input  type="text" required name="nombre"/>
                    &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                    <b>Email:</b> <input  type="text" required name="email"/>
                    </br></br>
                    <b>Fotografia:</b></br> <input type="file" name="foto" />
                </br>
                    <input class="btn btn-primary" type="submit" value="Aceptar" />
                </td>
            </tr>
        </table>
    </form> 
</br>
    <form action="{$gvar.l_global}registrar_animal.php" method="post">
        <input class="btn btn-primary" type="submit" value="Cancelar" />
    </form> 
</div>

