
<body class="fix-header fix-sidebar card-no-border mini-sidebar">
        
                 
                 <div class="preloader">
            <svg class="circular" viewBox="25 25 50 50">
                <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> </svg>
        </div>
            
        
        <div id="main-wrapper">
            <!--       -->
            
                    <header class="topbar">
                        <nav class="navbar top-navbar navbar-expand-md navbar-light">
                            <!-- ============================================================== -->
                            <!-- Logo -->
                            <!-- ============================================================== -->
                            <div class="navbar-header">
                                <a class="navbar-brand" href="index.html">
                                    <!-- Logo icon -->
                                    <b>
                                        <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                                        <!-- Dark Logo icon -->
                                        <img src="<?php echo base_url(); ?>assets/images/2.png" width="55" height="55" alt="homepage" class="light-logo" />

                                    </b>
                                    <!--End Logo icon -->
                                    <!-- Logo text -->
                                    <span>
                                        <!-- dark Logo text -->
                                        <img src="<?php echo base_url(); ?>assets/images/new.png" width="135" height="60" alt="homepage" class="dark-logo" />
                                        <!-- Light Logo icon -->
                                        <img src="<?php echo base_url(); ?>assets/images/1.png" width="175" height="60" alt="homepage" class="light-logo" /></span> </a>
                            </div>
                            <!-- ============================================================== -->
                            <!-- End Logo -->
                            <!-- ============================================================== -->
                            <div class="navbar-collapse">
                                <!-- ============================================================== -->
                                <!-- toggle and nav items -->
                                <!-- ============================================================== -->
                                <ul class="navbar-nav mr-auto mt-md-0">
                                    <!-- This is  -->
                            

                                    <li class="nav-item"> <a class="nav-link nav-toggler hidden-md-up text-muted waves-effect waves-dark" href="javascript:void(0)"><i class="mdi mdi-menu"></i></a> </li>
                                    <li class="nav-item"> <a class="nav-link sidebartoggler hidden-sm-down text-muted waves-effect waves-dark" href="javascript:void(0)"><i class="mdi mdi-menu"></i></a> </li>
                                    <!-- ============================================================== -->
                                    <!-- Search -->
                                  


                                </ul>
                                                        <!-- ============================================================== -->
                                <!-- User profile and search -->
                                <!-- ============================================================== -->
                                <ul class="navbar-nav my-lg-0">
                                    <!-- ============================================================== -->
                                    <!-- Comment -->
                                    <!-- ============================================================== -->
                                    <li class="nav-item dropdown">

                                    </li>
                                    <!-- ============================================================== -->
                                    <!-- End Comment -->
                                    <!-- ============================================================== -->
                                    <!-- ============================================================== -->
                                    <!-- Messages -->
                                    <!-- ============================================================== -->
                                    <li class="nav-item dropdown">

                                    </li>
                                    <!-- ============================================================== -->
                                    <!-- End Messages -->
                                    <!-- ============================================================== -->

                                    <!-- ============================================================== -->
                                    <!-- Profile -->
                                    <!-- ============================================================== -->
                                 

                                    <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="mdi mdi-account-circle mdi-36px mdi-light"></i> </a>
                                        <div class="dropdown-menu dropdown-menu-right scale-up">
                                            <ul class="dropdown-user">
                                                <li><div class="dw-user-box">
                                                        <div class="u-img"><i class="mdi mdi-account-circle mdi-48px"></i></div>
                                                        <div class="u-text">
                                                            <h5>Usuario: <?php echo $_SESSION['nombre_usuario']; ?></h5>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li role="separator" class="divider"></li>
                                                <li><a href="#"><i class="ti-settings"></i> Configuración de cuenta</a></li>
                                                <li role="separator" class="divider"></li>
                                                <li><a onclick="close()" href="<?php echo site_url(); ?>/Main/cerrarSesion"><i class="fa fa-power-off"></i> Cerrar Sesión</a></li>


                                                
                                            </ul>
                                        </div>
                                    </li>
                                  
                                    <!-- ============================================================== -->
                                    <!-- Language -->
                                    <!-- ============================================================== -->

                                </ul>
                            </div>
                        </nav>
                    </header>

<script type="text/javascript">
    function close()
    {
         var url = "<?php echo site_url(); ?>/Main/cerrarSesion";
         var cerrar = 1;
                $.ajax({                        
                   type: "POST",                 
                   url: url,                     
                   data: cerrar, 
                   success: function(data)             
                   {
                        if(data == "0"){
                             swal({ title: "No hay sesión iniciada!", type: "error", showConfirmButton: true });
                             location.replace("<?php echo site_url(); ?>/Main/index");
                        }

                        if(data == "1"){
                             swal({ title: "Sesión cerrada de manera exitosa!", type: "success", showConfirmButton: true });
                             location.replace("<?php echo site_url(); ?>/Main/index");
                        }
                      
                    }
               });
    }
</script>