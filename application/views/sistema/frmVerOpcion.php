<div class="row"  id="validation">
    <div class="col-12">
        <div class="card ">
            <div class="card-body wizard-content">
                    <h4 class="card-title">Ver Opci&oacute;n del Sistema</h4>
                    <h6 class="card-subtitle"></h6>
                    <form  class="validation-wizard wizard-circle" id="save" onsubmit="ok()">
                         <h6>Generales</h6>
                          <?php 
                              foreach ($opcion as $item) {?> 
                                 <section>
                                        <div class="row">
                                                <div class="col-md-6">
                                                        <div class="form-group">
                                                                <label class="control-label" for="nombreOpcion"> Nombre de opci&oacute;n:</label>
                                                                <input style="text-transform:uppercase" readonly="true" class="form-control required" value="<?php echo $item['NOMBRE_OPCION_SISTEMA'];?>"  maxlength="50" id="nombreOpcion" name="nombreOpcion"  type="text"> 
                                                        </div>
                                                </div>
                                                <div class="col-md-6">
                                                        <div class="form-group">
                                                                <label for="rutaOpcion">Ruta:</label>
                                                                <input  class="form-control" readonly="true" value="<?php echo $item['RUTA_OPCION_SISTEMA']; ?>"  maxlength="150" id="rutaOpcion" name="rutaOpcion"  type="text"> 
                                                        </div>
                                                </div>
                                                
                                        </div>
                                         <div class="row">
                                                <div class="col-md-6">
                                                        <div class="form-group">
                                                                <label for="nivelOpcion">Nivel</label>
                                                                <select style="width: 100%" class="form-control" readonly="true" onchange="dependencia()"  id="nivelOpcion"  name="nivelOpcion" required="true">
                                                                   <option value="-1">Seleccione un Nivel</option>
                                                                   <option value="1">Men&uacute; Principal</option>
                                                                   <option value="2">Sub Men&uacute;</option>
                                                                </select> 
                                                                 
                                                        </div>
                                                 </div>
                                                <div class="col-md-6">
                                                        <div class="form-group">
                                                                <label for="dependenciaOpcion">Dependencia</label>
                                                                <select style="width: 100%" id="dependenciaOpcion" readonly="true"  required="true" class="form-control" name="dependenciaOpcion" required="true">
                                                                      <option value="-1">Debe seleccionar un  Nivel</option>
                                                                </select> 
                                                        </div>
                                                </div>
                                        </div>
                                        <input type="hidden" value="<?php echo $item['ID_OPCION_SISTEMA']; ?>" name='idOpcion' id='idOpcion' >
                                       
                                        <input type="hidden" value="2" name='tipo' id='tipo' >
                                </section>
                        <?php } ?>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        function dependencia()
        {
              var y = $('#idOpcion').val();
             var x = $('#nivelOpcion').val();
             $('#dependenciaOpcion').html();
            var url = "<?php echo site_url(); ?>/Sistema/cargarDependencias";
            if(x>1){
                $.ajax({                        
                   type: "POST",                 
                   url: url,                     
                   data:'id='+y, 
                   success: function(data)             
                   {
                    $('#dependenciaOpcion').html(data);
                     $('#rutaOpcion').addClass('required');
                 }
               }); 
            }
            else{
                if(x==1){
                    $('#dependenciaOpcion').html('<option value="0">No aplica</option>');
                    $('#rutaOpcion').removeClass('required');
                }else{
                     $('#dependenciaOpcion').html('<option value="-1">Debe seleccionar un  Nivel</option>');
                     $('#rutaOpcion').removeClass('required');
                }
            }

        }
        function ok()
        {
            if($('#nivelOpcion').val()==-1)
            {
                swal('El nivel seleccionado es incorrecto');
            }
            else
            {
                if($('#dependenciaOpcion').val()==-1)
                {
                    swal('La dependencia seleccionada es incorrecta');
                }
                else
                {
                    var url = "<?php echo site_url(); ?>/Sistema/saveOpcion";
                    $.ajax({                        
                       type: "POST",                 
                       url: url,                     
                       data: $("#save").serialize(), 
                       success: function(data)             
                       {
                         if(data == "exito"){
                             swal({ title: "¡Se edito el registro de forma exitosa!", type: "success", showConfirmButton: true });
                        }else{
                            swal({ title: "¡No se pudo editar el registro!", type: "error", showConfirmButton: true });
                         }
                     }
                   });
                }  
            }
        }
        $(document).ready(function() {
           $("#nivelOpcion option[value=<?php echo $item['NIVEL_OPCION_SISTEMA']; ?>]").attr("selected",true);
           dependencia();
           $('.actions').attr('hidden','true');
       });
    </script>