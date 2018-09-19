<div class="row page-titles">
        <div class="col-md-5 col-8 align-self-center">
            <h3 class="text-themecolor m-b-0 m-t-0">Backup</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo base_url();  ?>">Home</a></li>
              	<li class="breadcrumb-item active">Backup</li>
            </ol>
        </div>             
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Generar Backup</h4>
                <h6 class="card-subtitle"></h6>
               
                    <button  onclick="generar()"  class="btn waves-effect waves-light btn-info white">Generar</button>
              
                
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    function generar()
    {
         var url = "<?php echo site_url(); ?>/Backup/generarBackup";
                    $.ajax({                        
                       type: "POST",                 
                       url: url,                     
                       data: 'tipo=1', 
                       success: function(data)             
                       {
                         if(data == "exito"){
                             swal({ title: "¡Generado de forma exitosa en el directorio /backup/ con la fecha actual", type: "success", showConfirmButton: true });
                        }else{
                            swal({ title: "¡No se pudo generar el registro!", type: "error", showConfirmButton: true });
                         }
                     }
                   });
    }
</script>