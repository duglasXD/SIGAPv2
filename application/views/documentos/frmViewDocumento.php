<div class="row"  id="validation">
    <div class="col-12">
        <div class="card ">
            <div class="card-body ">
                    <h4 class="card-title">Nuevo Documento</h4>
                    <h6 class="card-subtitle">Ingreso de Documento paso a paso</h6>
                      <form  class="" id="save"  enctype="multipart/form-data" method="POST" >
                       <?php 
                              foreach ($documento as $item) {?>     
                        
                                <div class="row">
                                        <div class="col-md-12">
                                                <div class="form-group">
                                                        <label class="control-label required" for="nombreDocumento"> Nombre de Documento:</label>
                                                        <input style="text-transform:uppercase" disabled='true' class="form-control required"  maxlength="50" id="nombreDocumento" value="<?php echo $item['NOMBRE_DOCUMENTO']; ?>" name="nombreDocumento"  type="text"> 
                                                </div>
                                        </div>
                                       
                                        
                                </div>
                                 <div class="row">
                                     <div class="col-md-4">
                                                <div class="form-group">
                                                        <label for="tipoDocumento">Tipo de documento</label>
                                                        <select style="width: 100%" disabled='true' class="form-control" id="tipoDocumento"  name="tipoDocumento" required="true">
                                                          <option value="word">Word</option>
                                                          <option value="excel">Excel</option>
                                                          <option value="powerpoint">Power Point</option>
                                                          <option value="pdf">PDF</option>
                                                          <option value="img">Imagen</option>
                                                        </select> 
                                                         
                                                </div>
                                         </div>
                                        <div class="col-md-4">
                                                <div class="form-group">
                                                        <label for="estadoDocumento">Estado de documento</label>
                                                        <select style="width: 100%" disabled='true' class="form-control" id="estadoDocumento"  name="estadoDocumento" required="true">
                                                          <option value="1">Activo</option>
                                                          <option value="2">Inactivo</option>
                                                        
                                                        </select> 
                                                </div>
                                        </div>
                                        <div class="col-md-4">
                                                <div class="form-group">
                                                        <label for="accesoDocumento">Acceso de documento</label>
                                                        <select style="width: 100%" disabled='true' class="form-control" id="accesoDocumento"  name="accesoDocumento" required="true">
                                                          <option value="1">Interno</option>
                                                          <option value="2">Externo</option>
                                                          <option value="3">Ambos</option>
                                                         
                                                        </select> 
                                                </div>
                                        </div>
                                    </div>
                                 <div class="row">
                                     <div class="col-lg-12 col-md-12">
                                        <div class="card">
                                            <div class="card-body">
                                                <h4 class="card-title">Carga de Documento</h4>
                                                <label for="userfile">Elija un documento </label>
                                                <input type="file" id="userfile" disabled='true' class="dropify" data-default-file='<?php echo site_url().$item['RUTA_DOCUMENTO']; ?>' name="userfile">
                                            </div>
                                        </div>
                                    </div>                                       
                                </div>
                                <div class="row" >
                                     <div class="col-md-12">
                                      <br>
                                    </div>
                                </div>
                                <div class="row">
                                  <div class="col-md-8" align="right">
                                      
                                    </div>
                                   
                                     <div class="col-md-4" align="right" >
                                       <div class="form-group">
                                        <input type="button" class="btn waves-effect waves-light btn-info" onclick="$('#otro').modal('hide');" name="" id="cancelar" value="Cancelar">
                                        <input type="submit" class="btn waves-effect waves-light btn-info" disabled='true'  value="Editar" >
                                      </div>
                                    </div>
                                </div>
                               
             

                       
                         <input type="hidden" value="2" name='tipo' id='tipo' >
                         <input type="hidden" value="<?php echo $item['ID_DOCUMENTO']; ?>" name='id' id='id' >
                    </form>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
      
          $(document).ready(function() {
           
            $('.dropify').dropify();
            $("#tipoDocumento option[value=<?php echo $item['TIPO_DOCUMENTO']; ?>]").attr("selected",true);
            $("#estadoDocumento option[value=<?php echo $item['ESTADO_DOCUMENTO']; ?>]").attr("selected",true);
            $("#accesoDocumento option[value=<?php echo $item['ACCESO_DOCUMENTO']; ?>]").attr("selected",true);
           
           
            
       });
 
    $(function(){
        $("#save").on("submit", function(e){
            e.preventDefault();
            var f = $(this);
            var formData = new FormData(document.getElementById("save"));
            formData.append("dato", "valor");
            //formData.append(f.attr("name"), $(this)[0].files[0]);
            $.ajax({
                url: "<?php echo site_url(); ?>/Documento/saveDocumento",
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
                            swal({ title: "¡No se guardo el registro!", type: "error", showConfirmButton: true });
                         }
                });
        });
    });
    </script>