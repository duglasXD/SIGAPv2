<div class="row page-titles">
        <div class="col-md-5 col-8 align-self-center">
            <h3 class="text-themecolor m-b-0 m-t-0">Carga de Histórico</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo base_url();  ?>">Home</a></li>
              	<li class="breadcrumb-item active">Carga de Histórico</li>
            </ol>
        </div>             
</div>
<div class="row">
    <div class="col-12">
        <div class="card animated bounceIn">
            <div class="card-body">
                <h4 class="card-title">Cargar histórico</h4>
                <h6 class="card-subtitle"></h6>
                <form  class="" id="save"  enctype="multipart/form-data" method="POST" >
                               <div class="row">
                                     <div class="col-md-4">
                                                <div class="form-group">
                                                        <label for="tipoAsociacion">Tipo de Asociación</label>
                                                        <select style="width: 100%"  id="tipoAsociacion"  name="tipoAsociacion" required="true">
                                                          <option value="1">Confederaciones</option>
                                                          <option value="2">Federaciones</option>
                                                          <option value="3">Sindicatos</option>
                                                          <option value="4">Seccionales</option>
                                                        </select> 
                                                         
                                                </div>
                                         </div>
                                         <div class="col-md-4">
                                                <div class="form-group">
                                                        <label for="sectorAsociacion">Sector Asociación</label>
                                                        <select style="width: 100%"  id="sectorAsociacion"  name="sectorAsociacion" required="true">
                                                          <option value="1">PÚBLICO</option>
                                                          <option value="2">PRIVADO</option>
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
                                                <input type="file" id="userfile" class="dropify" name="userfile">
                                            </div>
                                        </div>
                                    </div>                                       
                                </div>
                         <input type="hidden" value="1" name='tipo' id='tipo' >
                    
                    <div align="right">
                      <button   class="btn waves-effect waves-light btn-info white">Cargar</button>
                    </div>
                  </form>  
              
                
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    
    $(document).ready(function() {
            $('select').select2({
                placeholder: 'No hay datos para mostrar',
                closeOnSelect: true,
                allowClear: true
            });
            $('.dropify').dropify();
            
       });

 $(function(){
        $("#save").on("submit", function(e){
            e.preventDefault();
            var f = $(this);
            var formData = new FormData(document.getElementById("save"));
            formData.append("dato", "valor");
            //formData.append(f.attr("name"), $(this)[0].files[0]);
            $.ajax({
                url: "<?php echo site_url(); ?>/Historico/saveHistorico",
                type: "post",
                dataType: "html",
                data: formData,
                cache: false,
                contentType: false,
       processData: false
            })
                .done(function(res){
                    if(res == "exito"){
                             swal({ title: "¡Datos cargados exitosamente!", type: "success", showConfirmButton: true });
                        }else{
                            swal({ title: "¡No se guardo el registro!\n"+res, type: "error", showConfirmButton: true });
                         }
                });
        });
    });
</script>