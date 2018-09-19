<div class="row"  id="validation">
    <div class="col-12">
        <div class="card ">
            <div class="card-body wizard-content">
                    <h4 class="card-title">Ver Asociaci&oacute;n</h4>
                    <h6 class="card-subtitle">Visualización de Asociaci&oacute;n paso a paso</h6>
                    <form  class="validation-wizard wizard-circle" id="save" onsubmit="ok()">
                      <?PHP foreach ($asociacion as $item) {?> 
                         <h6>Generales</h6>
                         <section>
                                <div class="row">
                                        <div class="col-md-6">
                                                <div class="form-group">
                                                        <label class="control-label" for="numeroAsociacion"> Número de registro*:</label>
                                                        <input readonly="true" style="text-transform:uppercase" class="form-control "  value=" <?PHP echo $item['NUMERO_ASOCIACION']; ?> "  maxlength="25" id="numeroAsociacion" name="numeroAsociacion"  type="text"> 
                                                         
                                                </div>
                                        </div>
                        
                                         <div class="col-md-6">
                                                <div class="form-group">
                                                        <label for="siglasAsociacion">Siglas</label>
                                                        <input readonly="true" style="text-transform:uppercase" class="form-control " value=" <?PHP echo $item['SIGLAS_ASOCIACION']; ?> "  maxlength="25"  id="siglasAsociacion" name="siglasAsociacion" type="text"> 
                                                        
                                                </div>
                                         </div>
                                </div>
                                <div class="row">
                                        <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="nombreAsociacion"> Nombre Asociación: *</label>  
                                                    <input readonly="true" style="text-transform:uppercase" required="true" value=" <?PHP echo $item['NOMBRE_ASOCIACION']; ?> "  class="form-control " maxlength="200" id="nombreAsociacion"  name="nombreAsociacion" type="text">
                             
                                                </div>
                                        </div>
                                        <div class="col-md-6">
                                               <div class="form-group">
                                                    <label for="institucionAsociacion">Institución a la que pertenece</label> 
                                                    <input readonly="true" style="text-transform:uppercase" value=" <?PHP echo $item['INSTITUCION_PERTENECE_ASOCIACION']; ?> " class="form-control" maxlength="50" id="institucionAsociacion"   name="institucionAsociacion" type="text">
                                               </div>
                                        </div>
                                </div>

                        </section>
                        <h6>Sector/tipo/clase</h6>
                        <section>
                                <div class="row">
                                        <div class="col-md-6">
                                                <div class="form-group">
                                                        <label for="sectorAsociacion">Sector</label>
                                                        <select disabled="true" readonly style="width: 100%" class="form-control" onchange="cambio()" value=" <?PHP echo $item['ID_SECTOR_ASOCIACION']; ?> " id="sectorAsociacion"  name="sectorAsociacion" required="true">
                                                           
                                                            <?PHP  foreach ($sector as $items) {
                                                                ?>
                                                                        <option value="<?PHP echo $items['ID_SECTOR_ASOCIACION']; ?>"> <?PHP echo $items['NOMBRE_SECTOR_ASOCIACION']; ?></option>
                                                                <?PHP
                                                                }
                                                            ?>
                                                        </select> 
                                                         
                                                </div>
                                         </div>
                                        <div class="col-md-6">
                                                <div class="form-group">
                                                        <label for="tipoAsociacion">Tipo de Asociación</label>
                                                        <select disabled="true" readonly style="width: 100%" id="tipoAsociacion" value=" <?PHP echo $item['ID_TIPO_ASOCIACION']; ?> " required="true" onchange="dependencia()" class="form-control" name="tipoAsociacion" required="true">
                                                                <?PHP  foreach ($tipos as $items) {
                                                                ?>
                                                                        <option value="<?PHP echo $items['ID_TIPO_ASOCIACION']; ?>"> <?PHP echo $items['NOMBRE_TIPO_ASOCIACION']; ?></option>
                                                                <?PHP
                                                                }
                                                            ?>
                                                        </select> 
                                                </div>
                                        </div>
                                </div>
                                <div class="row">
                                        <div class="col-md-6">
                                                <div class="form-group">
                                                        <label for="claseAsociacion">Clase: *</label>
                                                        <select disabled="true" readonly style="width: 100%"  id="claseAsociacion" class="form-control" value=" <?PHP echo $item['ID_CLASE_ASOCIACION']; ?> " name="claseAsociacion" required="true" type="text">
                                                                <option value="1" selected="true">Seleccione una clase</option>
                                                        </select>
                                                </div>
                                        </div>
                                        <div class="col-md-6">
                                                <div class="form-group">
                                                        <label for="dependenciaAsociacion">Afiliación: *</label>
                                                        <select disabled="true"  style="width: 100%" id="dependenciaAsociacion" class="form-control" name="dependenciaAsociacion" >
                                                            <option value=" ">Seleccione una opción</option>
                                                        </select>
                                                </div>
                                        </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="estadoAsociacion">Estado: *</label>
                                                    <select disabled="true" readonly style="width: 100%" class="form-control" id="estadoAsociacion" required="true"  value=" <?PHP echo $item['ESTADO_ASOCIACION']; ?> "  name="estadoAsociacion">
                                                        <option value="ACEFALO" selected>ACEFALO</option>
                                                        <option value="ACTIVO">ACTIVO</option>
                                                        <option value="TRAMITE">TRAMITE</option>
                                                        <option value="CANCELADO">CANCELADO</option>
                                                        <option value="DENEGADO">DENEGADO</option>
                                                    </select>
                       
                                                </div>
                                        </div>
                                </div>
                        </section>
                        <h6>Complementarios</h6>
                        <section>
                               <div class="row">
                                        
                                        <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="municipioAsociacion">Municipio: *</label>
                                                    <select   style="width: 100%" class="form-control" disabled="true" id="municipioAsociacion" name="municipioAsociacion" required="true">
                                                        <?PHP  foreach ($deptos as $item2) {
                                                            ?>
                                                                    <optgroup  label =" <?PHP echo $item2['departamento']; ?>" >
                                                            <?PHP
                                                                    $aux=$this->AM->getMunicipiosByDepto($item2['id_departamento']);
                                                                    foreach ($aux as $item3) {
                                                                     ?>       
                                                                        <option class="l2" value="<?PHP echo $item3['id_municipio']; ?>"> <?PHP echo $item3['municipio']; ?></option>
                                                                    <?PHP
                                                                    }
                                                                    ?>
                                                                </optgroup>
                                                                    <?PHP
                                                            }
                                                        ?>
                                                    </select> 
                                                </div>
                                        </div>
                                        <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="emailAsociacion">Email: </label>
                                                    <input  style="text-transform:uppercase" disabled="true" class="form-control" maxlength="50" value=" <?PHP echo $item['EMAIL_ASOCIACION']; ?> " id="emailAsociacion"  name="emailAsociacion" type="text"> 
                                                </div>
                                        </div>
                                </div>
                                 <div class="row">
                                        <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="hombresAsociacion">Hombres: </label>
                                                    <input  style="text-transform:uppercase" disabled="true" value=" <?PHP echo $item['HOMBRES_ASOCIACION']; ?> " class="form-control" id="hombresAsociacion" name="hombresAsociacion"  min="0"   type="text">        
                                                </div>
                                        </div>
                                        <div class="col-md-3">
                                                <div class="form-group"> 
                                                    <label for="mujeresAsociacion">Mujeres: </label>                                                       
                                                    <input  style="text-transform:uppercase" disabled="true" value=" <?PHP echo trim($item['MUJERES_ASOCIACION']); ?> " class="form-control" id="mujeresAsociacion" name="mujeresAsociacion"   min="0"    type="text">      
                                                </div>  
                                        </div>
                                        <div class="col-md-6">
                                                <div class="form-group"> 
                                                    <label for="telefonoAsociacion">Teléfono: *</label>
                                                    <input  style="text-transform:uppercase" disabled="true" class="form-control" id="telefonoAsociacion" value=" <?PHP echo $item['TELEFONO_ASOCIACION']; ?> " required="true" name="telefonoAsociacion">
                                                </div>
                                        </div>
                               </div>
                               <div class="row">
                                        <div class="col-md-12">
                                                <div class="form-group"> 
                                                     <label for="direccionAsociacion">Dirección: *</label>
                                                    <textarea style="text-transform:uppercase" disabled="true"  class="form-control "   id="direccionAsociacion"  name="direccionAsociacion"><?php echo trim($item['DIRECCION_ASOCIACION']); ?></textarea>  
                                                   
                                                </div> 
                                        </div>                                   
                                </div>
                        </section>
                       <h6>Finales</h6>
                        <section>
                                 <div class="row">
                                        <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="fechaConstitucionAsociacion">Fecha de Constitución</label>
                                                    <input readonly="true" style="text-transform:uppercase" class="form-control " value=" <?PHP echo $item['FECHA_CONSTITUCION_ASOCIACION']; ?> " id="fechaConstitucionAsociacion"  name="fechaConstitucionAsociacion" type="text">           
                                                </div>
                                        </div>
                                        <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="resolucionFinal">Fecha de Resolución Final</label>
                                                    <input readonly="true" style="text-transform:uppercase" class="form-control " value=" <?PHP echo $item['FECHA_RESOLUCION_FINAL_ASOCIACION']; ?> " id="resolucionFinal" name="resolucionFinal"  required="true" type="text"> 
                                                </div>
                                        </div>
                                </div>
                                <div class="row">
                                        <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="numeroLibro">Número de libro: </label>
                                                    <input readonly="true" style="text-transform:uppercase" value=" <?PHP echo $item['LIBRO_ASOCIACION']; ?> " class="form-control" id="numeroLibro" name="numeroLibro"  type="text">        
                                                </div>
                                        </div>
                                        <div class="col-md-3">
                                                <div class="form-group"> 
                                                    <label for="folioAsociacion">Folio: </label>                                                       
                                                    <input readonly="true" style="text-transform:uppercase" value=" <?PHP echo $item['FOLIO_ASOCIACION']; ?> " class="form-control" id="folioAsociacion" name="folioAsociacion"   type="text">      
                                                </div>  
                                        </div>
                                        <div class="col-md-3">
                                                <div class="form-group"> 
                                                    <label for="regAsociacion">Reg.: </label>
                                                    <input readonly="true" style="text-transform:uppercase" value=" <?PHP echo $item['REG_ASOCIACION']; ?> " class="form-control" id="regAsociacion" name="regAsociacion"  type="text">      
                                                </div>                                                           
                                        </div>
                                        <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="articuloAsociacion">Artículo: </label>                                                       
                                                    <input readonly="true" style="text-transform:uppercase" value=" <?PHP echo $item['ARTICULO_ASOCIACION']; ?> " class="form-control" id="articuloAsociacion" name="articuloAsociacion"  type="text">      
                                                </div>
                                        </div>
                                </div>
                                
                        </section>
                    <?php } ?>
                </form>


            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
function ok() {
               swal({ title: "¡El registro es solo de lectura!", type: "warning", showConfirmButton: true });
        }

function mayusculas(str) {
            var res = str.toUpperCase();
            str = res;
        }

function cambio()
        {
            var x = $('#sectorAsociacion').val();
            //alert(x);
            $('#claseAsociacion').html();
            var url = "<?php echo site_url(); ?>/Asociacion/cargarSelect";
                $.ajax({                        
                   type: "POST",                 
                   url: url,                     
                   data:'tipo='+x, 
                   success: function(data)             
                   {
                    $('#claseAsociacion').html(data);
                 }
               }); 
        }

 function dependencia()
        {
            var x = $('#tipoAsociacion').val();
            //alert(x);
            $('#dependenciaAsociacion').html();
            var url = "<?php echo site_url(); ?>/Asociacion/cargarDependencia";
                $.ajax({                        
                   type: "POST",                 
                   url: url,                     
                   data:'tipo='+x, 
                   success: function(data)             
                   {
                    $('#dependenciaAsociacion').html(data);
                     $("#dependenciaAsociacion option[value=<?php echo $item['AFILIACION_ID_ASOCIACION']; ?>]").attr("selected",true);
                 }
               }); 

        }
        $(document).ready(function() {
            
           
            $("#sectorAsociacion option[value=<?php echo $item['ID_SECTOR_ASOCIACION']; ?>]").attr("selected",true);
          $("#tipoAsociacion option[value=<?php echo $item['ID_TIPO_ASOCIACION']; ?>]").attr("selected",true);
          $("#municipioAsociacion option[value=<?php echo $item['ID_MUNICIPIO_ASOCIACION']; ?>]").attr("selected",true);
          $("#estadoAsociacion option[value=<?php echo $item['ESTADO_ASOCIACION']; ?>]").attr("selected",true);
         
             $('#resolucionFinal').bootstrapMaterialDatePicker({ weekStart : 0, time: false });
            $('#fechaConstitucionAsociacion').bootstrapMaterialDatePicker({ weekStart : 0, time: false }).on('change', function(e, date)
                {
                $('#resolucionFinal').bootstrapMaterialDatePicker('setMinDate', date);
                });
          
          cambio();
            dependencia();
           
        }); 
    </script>