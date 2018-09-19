<?php 


foreach ($asociaciones as $item) {?> 
<div class="row page-titles">
        <div class="col-md-5 col-8 align-self-center">
             <?php
                  if($item['ID_TIPO_ASOCIACION']==3||$item['ID_TIPO_ASOCIACION']==4||$item['tipo']==2)
                     {
                ?>
                            <h3 class="text-themecolor m-b-0 m-t-0">Gesti&oacute;n de Asociaciones</h3>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="<?php echo base_url();  ?>">Home</a></li>
                              	<li class="breadcrumb-item active">Gesti&oacute;n de Asociaciones</li>
                            </ol>
             <?php
                   }
                   else
                   {
            ?>
                        <h3 class="text-themecolor m-b-0 m-t-0">Asociaciones afiliadas</h3>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="<?php echo base_url();  ?>">Home</a></li>
                                <li class="breadcrumb-item active">Asociaciones afiliadas</li>
                            </ol>
            <?php

                   }
            ?>
                                       
        </div>             
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Datos de la Asociaci&oacute;n</h4>
                <h6 class="card-subtitle"></h6>
                <div class="table-responsive">
                    <table id="example" class="tablesaw table-striped table-hover table-bordered table tablesaw-stack color-table info-table" data-tablesaw-mode="stack" data-tablesaw-minimap="">
                        <thead>
                            <tr>      
                                <th>Número de Asociación</th>
                                <th>Sector</th>
                                <th>Clase</th>
                                <th>Tipo</th>
                                <th>Estado</th>
                                <th>Nombre Asociación</th>
                                <th>Fecha Constitución</th>
                                <th>Empresa</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
               
                        <tbody>
                        	
                                <tr>

                                    <td>
                                        <?php echo $item['NUMERO_ASOCIACION']; ?>
                                    </td>
                                    <td>
                                    	<?php echo $this->AM->verSector($item['ID_ASOCIACION']); ?>
                                        
                                    </td>
                                    <td>
                                       <?php echo $this->AM->verClase($item['ID_ASOCIACION']); ?>
                                    </td>
                                    <td>
                                       <?php echo $this->AM->verTipo($item['ID_ASOCIACION']); ?>
                                    </td>
                                    <td>
                                       <?php echo $item['ESTADO_ASOCIACION']; ?>
                                    </td>
                                    <td>
                                         <?php echo $item['NOMBRE_ASOCIACION']; ?>
                                    </td>
                                    <td>
                                         <?php echo $item['FECHA_CONSTITUCION_ASOCIACION']; ?>
                                    </td>
                                    <td>
                                         <?php echo $item['INSTITUCION_PERTENECE_ASOCIACION']; ?>
                                    </td>
                                    <td>
                                        <button data-toggle="tooltip" data-placement="top" title="Ver Asociación" class="btn btn-warning btn-circle"  onclick="mostrarModal('<?php echo site_url(); ?>/Asociacion/viewAsociacion?id=<?php echo $item['ID_ASOCIACION']; ?>');" type="button"><i class="fa fa-eye"></i></button>

                                        <?php
                                            if($item['ID_TIPO_ASOCIACION']==3||$item['ID_TIPO_ASOCIACION']==4)
                                            {
                                        ?>
                                        <button data-toggle="tooltip" data-placement="top" title="Agregar afiliados"  class="btn btn-danger btn-circle"  onclick="mostrarModal('<?php echo site_url(); ?>/Asociacion/agregarAfiliados?id=<?php echo $item['ID_ASOCIACION']; ?>');" type="button"><i class="fa fa-users"></i></button>
                                        <?php
                                            }
                                        ?>
                                       

                                    </td>
                                </tr>
                           <?php 
                              }?> 
                        </tbody>
                    </table>
                </div>
                <script type="text/javascript">
                    $(document).ready(function () {
                        $('#example').DataTable({ dom: 'Bfrtip'});
                            
                           
                    });
                    function mostrarModal(dir)
                    {
                     $('.modal-body').load(dir, function () {
                                            $('#otro').modal({show: true});
                                        });
                    }
                </script>
                <!--                                                    <ul id="cm">
                                                                        <li><a data-icon="fa-search" onclick="ContextMenuDemo.view()">Ver Detalle</a></li>
                                                                        <li><a data-icon="fa-close" onclick="ContextMenuDemo.edit()">Editar</a></li>
                                                                    </ul>-->





            </div>
        </div>
    </div>
</div>
                                            <div class="modal fade" id="otro" >
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                       <div class="modal-body">

                                                        </div>
                                                    </div>
                                                    
                                                </div>
                                            </div>


