<div class="row page-titles">
        <div class="col-md-5 col-8 align-self-center">
            <h3 class="text-themecolor m-b-0 m-t-0">Dashboard</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?PHP echo base_url();  ?>">Home</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
        </div>             
</div>


<!--BLOCK SECTION -->
<div class="row">

   <!--  
              <div class="card-header"><h4 class="m-b-0 text-white">Asociaciones Inscritas</h4></div>
            <div class="card-body">

                <div class="d-flex flex-row">
                    <div class="align-self-center "></div>
                    <div class="m-l-10 align-self-center" align="center">
                        <h3 class="m-b-0"></h3>
                    </div>
                </div>
            </div>
        </div>
    </div> -->
<div class="col-lg-3 col-md-6 col-sm-12 col-s-12 col-12">
        <div class="card card-outline-info"">
            <div class="card-header">
                <h4 class="m-b-0 text-white"></h4>
            </div>
            <div class="card-body">
                <div class="d-flex flex-row">
                    <div class="text-info round-lg align-self-center round-danger">
                        <i class="fa fa-archive fa-lg"></i>
                    </div>
                    <div class="m-l-10 align-self-center">
                        <h3 class="m-b-0"><?PHP echo $total; ?></h3>
                        <h5 class="text-muted m-b-0">Asociaciones Inscritas</h5>
                    </div>
                </div>   
            </div>
        </div>
 </div>
   <div class="col-lg-3 col-md-6 col-sm-12 col-s-12 col-12">
        <div class="card card-outline-danger"">
                            <div class="card-header">
                                <h4 class="m-b-0 text-white"></h4></div>
            <div class="card-body">
                <div class="d-flex flex-row">
                    <div class=" round-lg align-self-center round-danger text-danger"><i class="fa fa-suitcase   fa-lg"></i></div>
                    <div class="m-l-10 align-self-center">
                        <h3 class="m-b-0"><?PHP echo $publicas ?></h3>
                        <h5 class="text-muted m-b-0">Asociaciones Públicas</h5></div>
                </div>
            </div>
        </div>
    </div>

<div class="col-lg-3 col-md-6 col-sm-12 col-s-12 col-12">
        <div class="card card-outline-success"">
            <div class="card-header">
                <h4 class="m-b-0 text-white"></h4>
            </div>
            <div class="card-body">
                <div class="d-flex flex-row">
                    <div class="text-success round-lg align-self-center round-success">
                        <i class="fa fa-briefcase  fa-lg"></i>
                    </div>
                    <div class="m-l-10 align-self-center">
                        <h3 class="m-b-0"><?PHP echo $privadas; ?></h3>
                        <h5 class="text-muted m-b-0">Asociaciones Privadas</h5>
                    </div>
                </div>   
            </div>
        </div>
 </div>
<div class="col-lg-3 col-md-6 col-sm-12 col-s-12 col-12">
        <div class="card card-outline-warning"">
            <div class="card-header">
                <h4 class="m-b-0 text-white"></h4>
            </div>
            <div class="card-body">
                <div class="d-flex flex-row">
                    <div class="text-warning round-lg align-self-center round-warning">
                        <i class="fa fa-users fa-lg"></i>
                    </div>
                    <div class="m-l-10 align-self-center">
                        <h3 class="m-b-0"><?PHP echo $afiliados; ?></h3>
                        <h5 class="text-muted m-b-0">Afiliados Activos</h5>
                    </div>
                </div>   
            </div>
        </div>
 </div>  
 </div> 
<div class="row">
    <div class="col-lg-4 col-md-12">
        <div class="card">
            <div class="card-body">
                <h3 class="card-title">Detalle de Asociaciones</h3>

                <div id="asoc" style="height:260px; width:100%;"></div>
            </div>
            <div>
                <hr class="m-t-0 m-b-0">
            </div>
            <div class="card-body text-center ">
                <ul class="list-inline m-b-0">
                    <li>
                        <h6 class="text-muted text-info"><i class="fa fa-circle font-10 m-r-10 "></i>Publicas: <?PHP echo $publicas ?></h6> </li>

                    <li>
                        <h6 class="text-muted  text-success"><i class="fa fa-circle font-10 m-r-10"></i>Privadas: <?PHP echo $privadas ?></h6> </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-12">
        <div class="card">
            <div class="card-body">
                <h3 class="card-title">Detalle de Asociaciones Privadas</h3>

                <div id="visitor" style="height:260px; width:100%;"></div>
            </div>
            <div>
                <hr class="m-t-0 m-b-0">
            </div>
            <div class="card-body text-center ">
                <ul class="list-inline m-b-0">
                   <li>
                        <h6 class='text-muted text-success' >
                            <i class='fa fa-circle font-10 m-r-10'></i>Empresa: <?php echo $Empresa->total; ?>
                        </h6>
                   </li>
                   <li>
                        <h6 class='text-muted text-info' >
                            <i class='fa fa-circle font-10 m-r-10'></i>Gremio: <?php echo $Gremio->total; ?>
                        </h6>
                   </li>
                   <li>
                        <h6 class='text-muted text-warning' >
                            <i class='fa fa-circle font-10 m-r-10'></i>Autonoma: <?php echo $Autonoma->total; ?>
                        </h6>
                   </li>
                   <li>
                        <h6 class='text-muted text-inverse' >
                            <i class='fa fa-circle font-10 m-r-10'></i>Independiente: <?php echo $Independiente->total; ?>
                        </h6>
                   </li>
                   <li>
                        <h6 class=' text-danger' >
                            <i class='fa fa-circle font-10 m-r-10'></i>Industria: <?php echo $Industria->total; ?>
                        </h6>
                   </li>
                </ul>
            </div>
        </div>
    </div>

    <div class="col-lg-4 col-md-12">
        <div class="card">
            <div class="card-body">
                <h3 class="card-title">Detalle de Solicitudes</h3>

                <div id="solicitudes" style="height:260px; width:100%;"></div>
            </div>
            <div>
                <hr class="m-t-0 m-b-0">
            </div>
            <div class="card-body text-center ">
                <ul class="list-inline m-b-0">
                     <?PHP 
                      //  $i=0;
                       // $salida= array();
                       
                       // foreach ($solicitudes as $item) {
                          //  $colores[$i]=substr(md5(time()), 0, 6);
                            echo "
                            <li>
                                <h6 class='text-muted text-success' >
                                    <i class='fa fa-circle font-10 m-r-10'></i>";
                                    //    echo $item['nombre'].": ".$item['total'];
                                       // $salida[$i]="[".$item['nombre'].",".$item['TOT']."],";
                                        
                                        //$i++;

                               echo " 
                                </h6> 
                            </li>";
                             //echo "<script>         $('#aux').val($('#aux').val()+'".$salida[$i]."');</script>";
                       // }

                    ?>
                </ul>
            </div>
        </div>
    </div>
</div>




    


