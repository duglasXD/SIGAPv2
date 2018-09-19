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
                                                        <label class="control-label" for="numeroAsociacion"> Numero de registro:</label>
                                                        <input style="text-transform:uppercase" disabled="true" class="form-control required"  value=" <?PHP echo $item['NUMERO_ASOCIACION']; ?> "  maxlength="25" id="numeroAsociacion" name="numeroAsociacion"  type="text"> 
                                                         
                                                </div>
                                        </div>
                        
                                        <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="nombreAsociacion"> Nombre Asociacion:</label>  
                                                    <input style="text-transform:uppercase" disabled="true" value=" <?PHP echo $item['NOMBRE_ASOCIACION']; ?> "  class="form-control required" maxlength="200" id="nombreAsociacion"  name="nombreAsociacion" type="text">
                             
                                                </div>
                                        </div>
                                       
                                </div>
                                <div class="row">
                                     
                                        <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="estadoAsociacion">Estado: *</label>
                                                    <select  style="width: 100%" class="form-control" id="estadoAsociacion" required="true"   name="estadoAsociacion">
                                                        <option value="Acéfalo">Acéfalo</option>
                                                        <option value="Activo">Activo</option>
                                                        <option value="Trámite">Trámite</option>
                                                        <option value="Cancelado">Cancelado</option>
                                                        <option value="Denegado">Denegado</option>
                                                    </select>
                       
                                                </div>
                                        </div>
                                </div>                                     
                               

                        </section>
                        <input type="hidden" name="idAsociacion" id="idAsociacion" value="<?PHP echo $item['ID_ASOCIACION']; ?>">
                        <input type="hidden" name="nombreAsoc" id="nombreAsoc" value="<?PHP echo $item['NOMBRE_ASOCIACION']; ?>">
                    <?php } ?>
                </form>


            </div>
        </div>
    </div>
</div>
  <script type="text/javascript">
        $(document).ready(function() {

          $("#estadoAsociacion option[value=<?php echo $item['ESTADO_ASOCIACION']; ?>]").attr("selected",true);
        });
        
        function ok() {
                var url = "<?php echo site_url(); ?>/Asociacion/editEstado";
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
   
    </script>
