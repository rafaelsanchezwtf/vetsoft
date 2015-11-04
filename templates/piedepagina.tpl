




 
 
                    </div>
                </div>
            </div>
        </div>

    </div>

 

    {literal}
    <script src="{/literal}{$gvar.l_global}{literal}js/sidebar_menu.js" language="Javascript"></script>
    <!-- script para el comportamiento del boton editar dueño-->
    <script  language="Javascript">

        $("#editardueno").click(function(){
            $("#editardueno").css('display','none');
            $(".datosdeldueno").css('display','block');
            $(".datosdeldueno").css('visibility','visible');
            $( "#ocultodueno" ).append( "<input type='hidden' name='sidueno'>" );
        });
        
     
       

       

                        
        
        
        
        
        

    </script>
    {/literal}

</body>

</html>
