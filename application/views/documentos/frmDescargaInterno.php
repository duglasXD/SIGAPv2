
                    <div class="row page-titles">
                            <div class="col-md-5 col-8 align-self-center">
                                <h3 class="text-themecolor m-b-0 m-t-0">Descarga de Documentos</h3>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?php echo base_url();  ?>">Home</a></li>
                                  	<li class="breadcrumb-item active">Descarga de Documentos</li>
                                </ol>
                            </div>             
                    </div>
                    <div class="row">
                        <?php 
                              foreach ($documento as $item) {?> 
                                <div class="col-lg-3 col-md-6" align="center">
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
                                        <div class="ribbon ribbon-bookmark <?php echo $clase; ?>"><a href="<?php echo base_url().$item['RUTA_DOCUMENTO'];  ?>" target='new' class=" waves-effect waves-light"><i class=" mdi <?php echo $icono; ?>  mdi-24px mdi-light"></i></a>
                                        </div>
                                        <p class="ribbon-content"><h4><?PHP echo $item['NOMBRE_DOCUMENTO']; ?></h4>
                                            
                                        </p>
                                    </div>
                                         <!-- Card -->
                                        
                                        <!-- Card -->
                                </div>
                            <?php 
                                }
                            ?>
                    </div>
