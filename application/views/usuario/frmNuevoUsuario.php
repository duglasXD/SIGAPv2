<div class="row"  id="validation">
    <div class="col-12">
        <div class="card ">
            <div class="card-body wizard-content">
                    <h4 class="card-title">Nuevo Usuario del Sistema</h4>
                    <h6 class="card-subtitle">Ingreso de Usuario del Sistema paso a paso</h6>
                    <form  class="validation-wizard wizard-circle" id="save" onsubmit="ok()">
                         <h6>Generales</h6>
                         <section>
                                <div class="row">
                                        <div class="col-md-6">
                                                <div class="form-group">
                                                        <label class="control-label" for="idUsuario"> ID de Usuario:</label>
                                                        <input  class="form-control required" onblur="valida()"  maxlength="30" placeholder="Entre 8 y 30 caracteres, sin espacios." minlength="8" id="idUsuario" name="idUsuario"  type="text"> 
                                                </div>
                                        </div>
                                        <div class="col-md-6">
                                                <div class="form-group">
                                                        <label for="nombreUsuario">Nombre de Usuario:</label>
                                                        <input  class="form-control required" placeholder="Max. 150 caracteres" maxlength="150" id="nombreUsuario" name="nombreUsuario"  type="text"> 
                                                </div>
                                        </div>
                                        
                                </div>
                                <div class="row">
                                 <!-- <div class="col-md-6">
                                                <div class="form-group">
                                                        <label for="tipoUsuario">Tipo de Usuario</label>
                                                        <select style="width: 100%" class="form-control required" onchange="block()"  id="tipoUsuario"  name="tipoUsuario" required="true">
                                                           <option value="1">Interno</option>
                                                           <option value="2">Externo</option>
                                                        </select> 
                                                         
                                                </div>
                                         </div> -->
                              
                                    <div class="col-md-6">
                                                <div class="form-group">
                                                        <label for="passUsuario">Contraseña:</label>
                                                        <input  class="form-control required"  maxlength="15" id="passUsuario" name="passUsuario"  type="password"> 
                                                </div>
                                        </div>  
                                        <div class="col-md-6">
                                                <div class="form-group">
                                                        <label for="estadoUsuario">Estado de Usuario</label>
                                                        <select style="width: 100%" class="form-control required" required="true"  id="estadoUsuario"  name="estadoUsuario">
                                                           <option value="1">Activo</option>
                                                           <option value="2">Inactivo</option>
                                                        </select> 
                                                         
                                                </div>
                                         </div> 
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                                <div class="form-group">
                                                        <label for="asociacionUsuario">Asociacion del Usuario</label>
                                                        <select style="width: 100%" id="asociacionUsuario"   class="form-control" name="asociacionUsuario">
                                                             
                                                        </select> 
                                                </div>
                                        </div>
                               </div>
                        </section>

                             <input type="hidden" value="1" name='tipo' id='tipo' >
                    </form>
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
          
                $.ajax({                        
                   type: "POST",                 
                   url: url,                     
                   data:'id=1', 
                   success: function(data)             
                   {
                        $('#asociacionUsuario').html(data);
                   }
               }); 
            
            

        }
        function ok()
        { 
                    var url = "<?php echo site_url(); ?>/Usuario/saveUsuario";
                    $.ajax({                        
                       type: "POST",                 
                       url: url,                     
                       data: $("#save").serialize(), 
                       success: function(data)             
                       {
                         if(data == "exito"){
                             swal({ title: "¡Registro exitoso!", type: "success", showConfirmButton: true });
                        }else{
                            swal({ title: "¡No se guardo el registro!", type: "error", showConfirmButton: true });
                         }
                     }
                   });
           
        }
        $(document).ready(function() {
            $('select').select2({
                placeholder: 'No hay datos para mostrar', 
                closeOnSelect: false
            });
           //cargarRoles();
           cargarAsociaciones();
           //block();
           
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
                $('#passUsuario').removeClass('required');
            }
            else
            {
                $('#passUsuario').attr('disabled',false);
                $('#passUsuario').addClass('required');
            }
        }
    </script>