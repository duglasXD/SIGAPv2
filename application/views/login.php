    
    <div class="container-fluid" >
       <div class="row page-titles" style="opacity: 0.0">
                   
       </div>
          <div class="row">
            
                              <div class="col-lg-4 col-xlg-4 col-md-4 col-sm-4 col-xs-12 col-4">
                                  <div class="card animated tada">
                                      <div class="card-body">
                                        <div align="center">
                                        <img src="<?php echo base_url(); ?>assets/images/users/user.png" class="img-circle border" width="75" />
                                         <h3 class="box-title m-b-20">Inicio de Sesi&oacute;n</h3>
                                        </div>
                                            <form class="floating-labels" method="post" id="loginform" >
                                               
                                               <div class="form-group " id="divUser">
                                                        <input class="form-control" type="text" id="user" name="user" > <span class="bar"></span>
                                                        <label for="user">Usuario</label>
                                                </div>
                                                <div class="form-group" id="divPass">
                                                  
                                                        <input class="form-control"  id="password" name="password"  type="password"> 
                                                      <span class="bar"></span>
                                                        <label for="password">Contraseña</label>

                                                </div>
                                                
                                                <div class="form-group text-center m-t-20" align="center">
                                                  <div class=""></div>  
                                                    <div class="" align="center">
                                                        <button class="btn btn-info text-uppercase waves-effect waves-light" onclick="enviar();" type="button">Ingresar</button>
                                                    </div>
                                                </div>
                                               
                                            </form> 
                                       
                                      </div>
                                  
                                     
                                  </div>
                              </div>
                              <div class="col-lg-8 col-xlg-8 col-md-8 col-8 col-sm-8 col-xs-12">
                                  <div class="card">
                                      <div class="card-body">
                                          <h4 class="card-title">Descarga de documentos p&uacute;blicos</h4>
                                         <?php 
                                              foreach ($documento as $item) {?> 
                                                <div class="col-lg-4 col-md-4 col-4" align="center">
                                                    <?php 
                                                        switch($item['TIPO_DOCUMENTO']){
                                                            case 'word':
                                                                $clase= "ribbon-info";
                                                                $icono = "mdi-file-word";
                                                                break;
                                                            case 'excel':
                                                                $clase= "ribbon-success";
                                                                $icono = "mdi-file-excel";
                                                                break;
                                                            case 'powerpoint':
                                                                $clase= "ribbon-danger";
                                                                $icono = "mdi-file-powerpoint";
                                                                break;
                                                            case 'pdf':
                                                                $clase= "ribbon-warning";
                                                                $icono = "mdi-file-pdf";
                                                                break;
                                                            case 'img':
                                                                $clase= "ribbon-primary";
                                                                $icono = "mdi-file-image";
                                                                break;


                                                            } 
                                                    ?>
                                                    <div class="ribbon-wrapper card">
                                                        <div class="ribbon ribbon-bookmark <?php echo $clase; ?>"><a href="<?php echo base_url().'assets/'.$item['RUTA_DOCUMENTO'];  ?>" target='new' class=" waves-effect waves-light"><i class=" mdi <?php echo $icono; ?>  mdi-24px mdi-light"></i>
                                                        </div>
                                                        <p class="ribbon-content"><h5><?PHP echo $item['NOMBRE_DOCUMENTO']; ?></h5>
                                                            
                                                        </p>
                                                        </a>
                                                    </div>
                                                         <!-- Card -->
                                                        
                                                        <!-- Card -->
                                                </div>
                                            <?php 
                                                }
                                              ?>
                                      </div>
                                    </div>
                                  </div>

              
          </div>

    </div>

<script type="text/javascript">
 

	function enviar(){
      var b=validarP();
      var a=validarU();
      

    if(b==1&&a==1)
    {
		 var url = "<?php echo site_url(); ?>/Main/loguear";
                $.ajax({                        
                   type: "POST",                 
                   url: url,                     
                   data: $("#loginform").serialize(), 
                   success: function(data)             
                   {
                   		if(data == "0"){
	                         swal({ title: "Contraseña Incorrecta!", type: "error", showConfirmButton: true });
	                    }

	                    if(data == "1"){
	                         //swal({ title: "Inicio de sesion exitoso!", type: "success", showConfirmButton: true });
	                         location.replace("<?php echo site_url(); ?>/Main/principal");
	                    }
	                   if(data == "2"){
	                        swal({ title: "Usuario Inactivo!", type: "error", showConfirmButton: true });
	                     }
	                     if(data == "3"){
	                     	swal({ title: "El usuario no existe!", type: "error", showConfirmButton: true });
	                     }
                 	}
               });
    }
    //$('#user').focus();
  }
		
	

  
  $(document).ready(function(){
    $("#password").keypress(function(e) {
         var code = (e.keyCode ? e.keyCode : e.which);
        if(code==13){
            enviar();
        }
    });
     $("#user").keypress(function(e) {
         var code = (e.keyCode ? e.keyCode : e.which);
        if(code==13){
            enviar();
        }
    });
     //$('#user').attr('onblur','validarU()');


});


function validarU()
  {
    if($('#user').val()=='')
    {
      $('#divUser').addClass('has-error has-danger');
      $('#user').focus();
      return 0;
    }
    else
    {
      $('#divUser').removeClass('has-error has-danger');
      return 1;
    }
  }
  function validarP()
  {
    if($('#password').val()=='')
    {
      $('#divPass').addClass('has-error has-danger');
      $('#password').focus();
      return 0;
    }
    else
    {
      $('#divPass').removeClass('has-error has-danger');
      return 1;
    }
  } 

</script>