    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="index3.html" class="brand-link">
            <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
            <span class="brand-text font-weight-light" style="cursor:pointer; color:#fcb900;">CRECIENTE PARKING</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar" >
       

            <!-- Sidebar Menu -->
            <nav class="mt-2" >
                <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent" data-widget="treeview" role="menu" data-accordion="false">
                <!-- color:#fcb900; -->
                    <li class="nav-item" >
                    <a style="cursor:pointer; " class="nav-link" onclick="parqueaderos();">
                            <!-- <i class="nav-icon fas fa-th"></i> -->
                            <p>
                                Parqueaderos
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                    <a style="cursor:pointer;" class="nav-link" onclick="tarifas();">
                            <!-- <i class="nav-icon fas fa-th"></i> -->
                            <p>
                                Tarifas
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                    <a style="cursor:pointer;" class="nav-link" onclick="perfiles();">
                            <!-- <i class="nav-icon fas fa-th"></i> -->
                            <p>
                                Perfiles
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                    <a style="cursor:pointer;" class="nav-link" onclick="usuarios();">
                            <!-- <i class="nav-icon fas fa-th"></i> -->
                            <p>
                                Usuarios
                            </p>
                        </a>
                    </li>
                   
                  
                  
                  
               
                    <li class="nav-item">
                        <a style="cursor:pointer;" class="nav-link" onclick="parking();">
                            
                        <p>
                            Parking
                        </p>
                    </a>
                </li>
                
                <li class="nav-item">
                <a style="cursor:pointer;" class="nav-link" onclick="reportes();">
                   
                        <p>
                            Reportes
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                        <a style="cursor:pointer;" class="nav-link" onclick="cambiarClave();">
                                <!-- <i class="nav-icon fas fa-th"></i> -->
                                <p>
                                    Cambiar Clave
                                </p>
                            </a>
                        </li>
                    <li class="nav-item">
                    <a style="cursor:pointer;" class="nav-link" onclick="salir();">
                            <!-- <i class="nav-icon fas fa-th"></i> -->
                            <p>
                                Salir
                            </p>
                        </a>
                    </li>
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>
    <script>
        $(".nav-link").on('click',function(){
            $(".nav-link").removeClass('active');
            $(this).addClass('active');
        })
    </script>