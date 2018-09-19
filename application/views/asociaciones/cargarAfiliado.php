<div class="row"  id="validation">
    <div class="col-12">
        <div class="card ">
            <div class="card-body wizard-content">
                    <h4 class="card-title">Cargar afiliados</h4>
                    <h6 class="card-subtitle">Carga de afiliados paso a paso</h6>
                    <form  class="validation-wizard wizard-circle" id="save" onsubmit="ok()">
                      <? foreach ($asociacion as $item) {?> 
                         <h6>Generales</h6>
                         <section>
                                <div class="row">
                                        <div class="col-md-6">
                                                <div class="form-group">
                                                        <label class="control-label" for="numeroAsociacion"> Numero de registro*:</label>
                                                        <input style="text-transform:uppercase" disabled="true" class="form-control required"  value=" <?PHP echo $item['NUMERO_ASOCIACION']; ?> "  maxlength="25" id="numeroAsociacion" name="numeroAsociacion"  type="text"> 
                                                         
                                                </div>
                                        </div>
                        
                                        <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="nombreAsociacion"> Nombre Asociacion: *</label>  
                                                    <input style="text-transform:uppercase" required="true" disabled="true" value=" <?PHP echo $item['NOMBRE_ASOCIACION']; ?> "  class="form-control required" maxlength="200" id="nombreAsociacion"  name="nombreAsociacion" type="text">
                             
                                                </div>
                                        </div>
                                       
                                </div>
                                <div class="row">
                                     <div class="col-lg-12 col-md-12">
                                        <div class="card">
                                            <div class="card-body">
                                                <h4 class="card-title">Carga de Documento</h4>
                                                <label for="userfile">Elija un documento </label>
                                                <input type="file" id="userfile" class="dropify" name="userfile">
                                            </div>
                                        </div>
                                    </div>                                       
                                </div>

                        </section>
                        <input type="hidden" name="idAsociacion" id="idAsociacion" value="<?PHP echo $item['ID_ASOCIACION']; ?>">
                    <?php } ?>
                </form>


            </div>
        </div>
    </div>
</div>
  <script type="text/javascript">
        $(document).ready(function() {
            $('select').select2({
                placeholder: 'No hay datos para mostrar'
            });
             $('.dropify').dropify();
          
        });
        
        function ok() {
                
                    if($('#userfile').val()=='')
                    {
                       swal({ title: "¡No se ha seleccionado archivo para ser cargado!", type: "error", showConfirmButton: true });
                    }
                    else{


                        //var f = $(this);
                        var formData = new FormData(document.getElementById("save"));
                        formData.append("dato", "valor");
                        //formData.append(f.attr("name"), $(this)[0].files[0]);
                        $.ajax({
                            url: "<?php echo site_url(); ?>/Asociacion/saveAfiliado",
                            type: "post",
                            dataType: "html",
                            data: formData,
                            cache: false,
                            contentType: false,
                     processData: false
                        })
                            .done(function(res){
                                if(res == "exito"){
                                         swal({ title: "¡Registro exitoso!", type: "success", showConfirmButton: true });
                                    }else{
                                        swal({ title: "¡No se guardo el registro!", text: res, type: "error", showConfirmButton: true });
                                     }
                            });
                  
            }
        }
   
    </script>
