<div class="row"  id="validation">
    <div class="col-12">
        <div class="card ">
            <div class="card-body wizard-content">
                    <h4 class="card-title">Nueva Junta Directiva</h4>
                    <h6 class="card-subtitle">Ingreso de juta directiva paso a paso</h6>
                    <form  class="validation-wizard wizard-circle" id="save" onsubmit="ok()">
                         <h6></h6>
                         <section>
                                <div class="row">
                                     <div class="col-md-12">
                                                <div class="form-group">
                                                        <label for="asociacionJunta">Asociación a la que pertenece: </label>
                                                        <select style="width: 100%" id="asociacionJunta"   class="form-control required" name="asociacionJunta">
                                                             
                                                        </select> 
                                                </div>
                                        </div>
                                        
                                </div>
                                 <div class="row">
                                        <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="fechaEleccionJunta">Fecha de Elección</label>
                                                    <input style="text-transform:uppercase" class="form-control date required"  id="fechaEleccionJunta"  name="fechaEleccionJunta" type="text">           
                                                </div>
                                        </div>
                                         <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="fechaPosesionJunta">Fecha de toma de Posesión</label>
                                                    <input style="text-transform:uppercase" class="form-control date required"  id="fechaPosesionJunta"  name="fechaPosesionJunta" type="text">           
                                                </div>
                                        </div>
                                </div>
                               <div class="row">
                                        <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="fechaFinJunta">Fecha de Fin de funciones: </label>
                                                    <input style="text-transform:uppercase" class="form-control date required"  id="fechaFinJunta"  name="fechaFinJunta" type="text">           
                                                </div>
                                        </div>
                                         <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="fechaAutoJunta">Auto de fecha: </label>
                                                    <input style="text-transform:uppercase" class="form-control date required"  id="fechaAutoJunta"  name="fechaAutoJunta" type="text">           
                                                </div>
                                        </div>
                                </div>

                        </section>
                        <h6></h6>
                        <section>
                                
                                          
                                <div class="row">
                                         <div class="col-md-4">
                                                <div class="form-group">
                                                        <label for="oficioJunta">N° Oficio: </label>
                                                        <input style="text-transform:uppercase" class="form-control required"  maxlength="25"  id="oficioJunta" name="oficioJunta" type="text"> 
                                                        
                                                </div>
                                         </div>
                                        <div class="col-md-4">
                                                <div class="form-group">
                                                        <label for="carneJunta">Carnés N°: </label>
                                                        <input style="text-transform:uppercase" class="form-control required"  maxlength="25"  id="carneJunta" name="carneJunta" type="text"> 
                                                        
                                                </div>
                                        </div>
                                         <div class="col-md-4">
                                                <div class="form-group">
                                                        <label for="libroJunta">Libro: </label>
                                                        <input style="text-transform:uppercase" class="form-control required"  maxlength="25"  id="libroJunta" name="libroJunta" type="text"> 
                                                        
                                                </div>
                                        </div>
                                </div>
                                <div class="row">
                                        
                                       <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="convocatoriaJunta">Convocatoria: </label>
                                                    <input  style="text-transform:uppercase" class="form-control" maxlength="50"  id="convocatoriaJunta"  name="convocatoriaJunta" type="text"> 
                                                </div>
                                        </div>
                               
                                        <div class="col-md-4">
                                                 <div class="form-group">
                                                    <label for="antelacionJunta">Antelación: </label>
                                                    <input  style="text-transform:uppercase" class="form-control" maxlength="50"  id="antelacionJunta"  name="antelacionJunta" type="text"> 
                                                </div>
                                        </div>

                                        <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="agendaJunta">Agenda: </label>
                                                    <input  style="text-transform:uppercase" class="form-control" maxlength="50"  id="agendaJunta"  name="agendaJunta" type="text"> 
                                                </div>
                                        </div>
                               </div>
                               <div class="row">
                                        <div class="col-md-12">
                                                <div class="form-group"> 
                                                     <label for="representacionJunta">Representación Legal: </label>
                                                    <textarea style="text-transform:uppercase"  class="form-control "   id="representacionJunta"  name="representacionJunta"></textarea>  
                                                   
                                                </div> 
                                        </div>                                   
                                </div>
                               
                        </section>
                        <h6></h6>
                        <section>   
                        <div class="row">
                                        <div class="col-md-4">
                                                 <div class="form-group">
                                                    <label for="quorumJunta">Quorum: </label>
                                                    <input  style="text-transform:uppercase" class="form-control" maxlength="50"  id="quorumJunta"  name="quorumJunta" type="text"> 
                                                </div>
                                        </div>
                                        <div class="col-md-4">
                                                 <div class="form-group">
                                                    <label for="votacionJunta">Votación: </label>
                                                    <input  style="text-transform:uppercase" class="form-control" maxlength="50"  id="votacionJunta"  name="votacionJunta" type="text"> 
                                                </div>
                                        </div>
                                       <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="asistenciaJunta">Asistencia: </label>
                                                    <input  style="text-transform:uppercase" class="form-control" maxlength="50"  id="asistenciaJunta"  name="asistenciaJunta" type="text"> 
                                                </div>
                                        </div>
                               </div> 
                         <div class="row">
                                        <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="presentacionJunta">Fecha de Presentación</label>
                                                    <input style="text-transform:uppercase" class="form-control date required"  id="presentacionJunta"  name="presentacionJunta" type="text">           
                                                </div>
                                        </div>
                                        <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="horaJunta">Hora de presentación</label>
                                                    <input style="text-transform:uppercase" class="form-control required" id="horaJunta" name="horaJunta"  required="true" type="text"> 
                                                </div>
                                        </div>
                                        
                                </div>                        
                              
                               
                        </section>
                       <h6></h6>
                        <section>
                                
                                <div class="row">
                                        
                                        <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="presentadoPorJunta">Presentado por: </label>
                                                    <input style="text-transform:uppercase" class="form-control required"  id="presentadoPorJunta"  name="presentadoPorJunta" type="text">           
                                                </div>
                                        </div>
                                        <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="hombresJunta">Hombres: </label>
                                                    <input style="text-transform:uppercase" class="form-control" id="hombresJunta" name="hombresJunta"  type="text">        
                                                </div>
                                        </div>
                                        <div class="col-md-3">
                                                <div class="form-group"> 
                                                    <label for="mujeresJunta">Mujeres: </label>                                                       
                                                    <input style="text-transform:uppercase" class="form-control" id="mujeresJunta" name="mujeresJunta"   type="text">      
                                                </div>  
                                        </div>
                                </div>
                                <div class="row">
                                        <div class="col-md-4">
                                                <div class="form-group"> 
                                                    <label for="folioJunta">Folio: </label>                                                       
                                                    <input style="text-transform:uppercase" class="form-control" id="folioJunta" name="folioJunta"   type="text">      
                                                </div>  
                                        </div>
                                        <div class="col-md-4">
                                                <div class="form-group"> 
                                                    <label for="regJunta">Reg.: </label>
                                                    <input style="text-transform:uppercase" class="form-control" id="regJunta" name="regJunta"  type="text">      
                                                </div>                                                           
                                        </div>
                                        <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="articuloJunta">Artículo: </label>                                                       
                                                    <input style="text-transform:uppercase" class="form-control" id="articuloJunta" name="articuloJunta"  type="text">      
                                                </div>
                                        </div>
                                </div>
                               
                        </section>
                        <h6></h6>
                        <section>
                            <div id="campo">
                                <div class="row">
                                        <div class="col-md-5">
                                                <div class="form-group"> 
                                                    <label for="secretariaJunta">Secretaría: </label>                                                       
                                                    <input style="text-transform:uppercase" class="form-control" id="secretariaJunta1" name="secretariaJunta1"   type="text">      
                                                </div>  
                                        </div>
                                        <div class="col-md-5">
                                                <div class="form-group"> 
                                                    <label for="representanteJunta">Representante: </label>
                                                    <input style="text-transform:uppercase" class="form-control" id="representanteJunta1" name="representanteJunta1"  type="text">      
                                                </div>                                                           
                                        </div>
                                        <div class="col-md-2">
                                            <input type="button" value="Agregar" name="agregar" class="" onclick="agrega()">
                                        </div>
                               </div>
                            </div>
                        </section>
                        <input type="hidden" name="contador" id="contador" value="2">
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
             $('#fechaEleccionJunta').bootstrapMaterialDatePicker({ weekStart : 0, time: false });
             $('#fechaAutoJunta').bootstrapMaterialDatePicker({ weekStart : 0, time: false });
             $('#fechaFinJunta').bootstrapMaterialDatePicker({ weekStart : 0, time: false });
             $('#fechaPosesionJunta').bootstrapMaterialDatePicker({ weekStart : 0, time: false });
             $('#presentacionJunta').bootstrapMaterialDatePicker({ weekStart : 0, time: false });
              $('#horaJunta').bootstrapMaterialDatePicker({ format : 'HH:mm', time: true, date: false });
            $('#fechaConstitucionAsociacion').bootstrapMaterialDatePicker({ weekStart : 0, time: false }).on('change', function(e, date)
                {
                $('#resolucionFinal').bootstrapMaterialDatePicker('setMinDate', date);
                });
          
             cargarAsociaciones();
           
        });
        
        function ok() {
                var url = "<?php echo site_url(); ?>/Junta/saveJunta";
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
      function cargarAsociaciones()
        {
         
            var url = "<?php echo site_url(); ?>/Asociacion/cargarAsociaciones";
          
                $.ajax({                        
                   type: "POST",                 
                   url: url,                     
                   data:'id=1', 
                   success: function(data)             
                   {
                        $('#asociacionJunta').html(data);
                   }
               }); 
        }
        function agrega()
        {
            var x=$('#contador').val();
           
            $('#campo').append('<div class="row"><div class="col-md-5"><div class="form-group"><label for="secretariaJunta">Secretaría: </label><input style="text-transform:uppercase" class="form-control" id="secretariaJunta'+x+'" name="secretariaJunta'+x+'"   type="text"></div></div><div class="col-md-5"><div class="form-group"><label for="representanteJunta">Representante: </label><input style="text-transform:uppercase" class="form-control" id="representanteJunta'+x+'" name="representanteJunta'+x+'"  type="text"></div></div></div>');
             x++;
            $('#contador').val(x);
        }
    </script>
