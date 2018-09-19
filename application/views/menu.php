   <aside class="left-sidebar">
                        <!-- Sidebar scroll-->
                        <div class="scroll-sidebar">
                            <!-- Sidebar navigation-->
                            <nav class="sidebar-nav">
                                <ul id="sidebarnav">
                                    <li class=" nav-cap text-center" aria-expanded="false">MENÚ</li>
                                    <li class="nav-small-cap text-center" style="margin:5px;"></li> <!--Rol -->
                                    <li class="nav-devider" style="margin:5px;"></li>
                                    <?php 
                                    // echo $this->session->userdata('rol_usuario');
                                         foreach ($menu as $item)
                                         {
                                            $resultado=$this->SM->getSubOpcionesPorRol($this->session->userdata('rol_usuario'),$item['id_modulo']);
                                            if($resultado->num_rows() > 0)
                                            {
                                                
                                    ?>
                                                    <li>
                                                        <a class="has-arrow" href="#" aria-expanded="false"><i class="<?php echo $item['img_modulo'];?>"></i><span class="hide-menu"><?php echo $item['nombre_modulo']; ?></span></a>
                                                        <ul aria-expanded="false" class="collapse">
                                                        <?PHP 

                                                            foreach ($resultado->result() as $item2)
                                                            {
                                                          ?>  
                                                            <li>
                                                                <a href="<?php echo site_url().$item2->url_modulo;?>"><?php echo $item2->nombre_modulo; ?></a>
                                                            </li>
                                                           
                                                        <?PHP 
                                                            }
                                                        ?> 
                                                        </ul>
                                                    </li>

                                     <?php 
                                            }
                                        }
                                        
                                     ?>
                             

                                </ul>
                            </nav>
                            <!-- End Sidebar navigation -->
                        </div>
                        <!-- End Sidebar scroll-->
                    </aside>
                
           

            <!-- ============================================================== -->
            <!-- End Left Sidebar - style you can find in sidebar.scss  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Page wrapper  -->
            <!-- ============================================================== -->

            <div class="page-wrapper">
                <!-- ============================================================== -->
                <!-- Container fluid  -->
                <!-- ============================================================== -->
                <div class="container-fluid" id="aqui" name="aqui">
