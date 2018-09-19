<div class="row"  id="validation">
    <div class="col-12">
        <div class="card ">
            <div class="card-body wizard-content">
                    <h4 class="card-title">Ver Usuario del Sistema</h4>
                    <h6 class="card-subtitle"></h6>
                      <?php 
                              foreach ($usuario as $item) {?> 
                    <form  class="validation-wizard wizard-circle" id="save" onsubmit="ok()">
                         <h6>Generales</h6>
                         <section>
                                <div class="row">
                                        <div class="col-md-6">
                                                <div class="form-group">
                                                        <label class="control-label" for="idUsuario"> ID de Usuario:</label>
                                                        <input  class="form-control " onblur="valida()" disabled maxlength="30" placeholder="Entre 8 y 30 caracteres, sin espacios." minlength="8" id="idUsuario" name="idUsuario"  type="text"> 
                                                </div>
                                        </div>
                                        <div class="col-md-6">
                                                <div class="form-group">
                                                        <label for="nombreUsuario">Nombre de Usuario:</label>
                                                        <input  class="form-control " disabled placeholder="Max. 150 caracteres" maxlength="150" id="nombreUsuario" name="nombreUsuario"  type="text"> 
                                                </div>
                                        </div>
                                        
                                </div>
                                <div class="row">
                                 <div class="col-md-6">
                                                <div class="form-group">
                                                        <label for="tipoUsuario">Tipo de Usuario</label>
                                                        <select style="width: 100%" disabled class="form-control " onchange="block()"  id="tipoUsuario"  name="tipoUsuario" >
                                                           <option value="1">Interno</option>
                                                           <option value="2">Externo</option>
                                                        </select> 
                                                         
                                                </div>
                                         </div>
                              
                                    <div class="col-md-6">
                                                <div class="form-group">
                                                        <label for="passUsuario">Contraseña:</label>
                                                        <input  class="form-control " disabled  maxlength="15" id="passUsuario" name="passUsuario"  type="password"> 
                                                </div>
                                        </div>   
                                </div>
                        </section>
                        <h6>Generales 2</h6>
                        <section>
                                 <div class="row">
                                        <div class="col-md-6">
                                                <div class="form-group">
                                                        <label for="estadoUsuario">Estado de Usuario</label>
                                                        <select style="width: 100%" class="form-control "  disabled  id="estadoUsuario"  name="estadoUsuario">
                                                           <option value="1">Activo</option>
                                                           <option value="2">Inactivo</option>
                                                        </select> 
                                                         
                                                </div>
                                         </div>
                                        <div class="col-md-6">
                                                <div class="form-group">
                                                        <label for="rolUsuario">Rol</label>
                                                        <select style="width: 100%" id="rolUsuario" disabled  class=" form-control" name="rolUsuario" >
                                                             
                                                        </select> 
                                                </div>
                                        </div>
                                </div>
                               <div class="rol">
                                    <div class="col-md-12">
                                                <div class="form-group">
                                                        <label for="asociacionUsuario">Asociacion del Usuario</label>
                                                        <select style="width: 100%" id="asociacionUsuario" disabled  class="form-control" name="asociacionUsuario">
                                                             
                                                        </select> 
                                                </div>
                                        </div>
                               </div>

                            </section>
                             <input type="hidden" value="2" name='tipo' id='tipo' >
                             <input type="hidden"  name='idAux' id='idAux' >
                    </form>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        function cargarRoles()
        {
         
            var url = "<?php echo site_url(); ?>/Rol/cargarRoles";
          
                $.ajax({                        
                   type: "POST",                 
                   url: url,                     
                   data:'tipo=1', 
                   success: function(data)             
                   {
                        $('#rolUsuario').html(data);
                   }
               }); 
        }

        function cargarAsociaciones()
        {
         
            var url = "<?php echo site_url(); ?>/Asociacion/cargarAsociaciones";
            var x='<?php echo $item['ID_USUARIO']; ?>';
            x=x.trim();
                $.ajax({                        
                   type: "POST",                 
                   url: url,                     
                   data:'id='+x, 
                   success: function(data)             
                   {
                        $('#asociacionUsuario').html(data);
                   }
               }); 
        }

        function ok()
        { 
                   
         swal({ title: "¡El registro es solo de lectura!", type: "warning", showConfirmButton: true });
                       
           
        }

        $(document).ready(function() {
            $('#asociacionUsuario').select2({
                placeholder: 'No hay datos para mostrar',
                closeOnSelect: true
               
            });
           cargarRoles();
           cargarAsociaciones();
           cargarCampos();
          // block();  
          // $('.actions').attr('hidden','true');  
           
       });

       function valida()
        {
            var url = "<?php echo site_url(); ?>/Usuario/validaId";
            var x=$('#idUsuario').val();
            x=x.trim();
                    $.ajax({                        
                       type: "POST",                 
                       url: url,                     
                       data: 'id='+x, 
                       success: function(data)             
                       {
                         if(data == "exito"){
                            // swal({ title: "¡Registro exitoso!", type: "success", showConfirmButton: true });
                        }else{
                            swal({ title: "¡El ID de usuario ya esta en uso, por favor escoja otro!", type: "error", showConfirmButton: true });
                            $('#idUsuario').val('')
                            $('#idUsuario').focus();
                         }
                     }
                   });
        }

        function block()
        {

            if($('#tipoUsuario').val()==1)
            {
                $('#passUsuario').val('');
                $('#passUsuario').attr('disabled',true); 
                $('#passUsuario').removeClass('');
            }
            else
            {
                $('#passUsuario').attr('disabled',false);
                $('#passUsuario').addClass('');
            }
        }
        function cargarCampos()
        {
          $('#idUsuario').val('<?php echo $item['ID_USUARIO']; ?>');
          $('#idAux').val('<?php echo $item['ID_USUARIO']; ?>');
          $('#nombreUsuario').val('<?php echo $item['NOMBRE_USUARIO']; ?>');
          
          $("#tipoUsuario option[value=<?php echo $item['TIPO_USUARIO']; ?>]").attr("selected",true);
          $("#rolUsuario option[value=<?php echo $item['ID_ROL_USUARIO']; ?>]").attr("selected",true);
          $("#estadoUsuario option[value=<?php echo $item['ESTADO_USUARIO']; ?>]").attr("selected",true);
          

        }
    </script>