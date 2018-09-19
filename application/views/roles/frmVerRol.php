<div class="row"  id="validation">
    <div class="col-12">
        <div class="card ">
            <div class="card-body wizard-content">
                    <h4 class="card-title">Ver Rol</h4>
                    <h6 class="card-subtitle"></h6>
                    <form  class="validation-wizard wizard-circle" id="save" onsubmit="ok()">
                         <h6>Generales</h6>
                         <?php 
                              foreach ($rol as $item) {?> 
                         <section>
                                <div class="row">
                                        <div class="col-md-6">
                                                <div class="form-group">
                                                        <label class="control-label" for="nombreRol"> Nombre de Rol:</label>
                                                        <input style="text-transform:uppercase" class="form-control required" readonly="true" value="<?php echo $item['NOMBRE_ROL_USUARIO']; ?>" maxlength="50" id="nombreRol" name="nombreRol"  type="text"> 
                                                </div>
                                        </div>
                                        <div class="col-md-6">
                                                <div class="form-group">
                                                        <label for="descripcionRol">Descripcion:</label>
                                                        <input  class="form-control required"  maxlength="150" id="descripcionRol" readonly="true" name="descripcionRol" value="<?php echo $item['DESCRIPCION_ROL_USUARIO']; ?>" type="text"> 
                                                </div>
                                        </div>
                                        
                                </div>
                                 <div class="row">
                                        <div class="col-md-12">
                                                <div class="form-group">
                                                        <label for="opcionesRol">Opciones por Rol</label>
                                                        <select style="width: 100%" class="text-info" id="opcionesRol" readonly="true"  name="opcionesRol[]" required="true" multiple="true">
                                                          
                                                        </select> 
                                                         
                                                </div>
                                         </div>
                                        
                                </div>
                            <input type="hidden" value="<?php echo $item['ID_ROL_USUARIO']; ?>" name='idRol' id='idRol' >
                            <input type="hidden" value="2" name='tipo' id='tipo' >
                        </section>
                        <?php } ?>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        function cargarOpciones()
        {
           
            var url = "<?php echo site_url(); ?>/Rol/cargarOpciones";
            var x = $('#idRol').val();
                $.ajax({                        
                   type: "POST",                 
                   url: url,                     
                   data:'id='+x, 
                   success: function(data)             
                   {
                    $('#opcionesRol').html(data);
                    //$('#descripcionRol').addClass('required');
                 }
               }); 
        }
        function ok()
        {
                    var url = "<?php echo site_url(); ?>/Rol/saveRol";
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
                closeOnSelect: false,
                allowClear: true
            });
            cargarOpciones();
            $('.actions').attr('hidden','true');
       });
    </script>