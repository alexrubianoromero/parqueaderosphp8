    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
            <!-- <li class="nav-item d-none d-sm-inline-block">
            <a style="cursor:pointer;" class="nav-link active" onclick="CargarContenido('vistas/dashboard.php','content-wrapper');">

                    Tablero
                </a>
            </li> -->
            <!-- <li class="nav-item d-none d-sm-inline-block">
                <a href="#" class="nav-link">Inventario</a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="#" class="nav-link">Carga Masiva</a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="#" class="nav-link">Categrias</a>
            </li> -->
            <?php
                        // echo '<pre>'; 
                        // print_r($_SESSION);
                        // echo '</pre>';
                        // die();
            if($_SESSION['nivel']>5)
            {
            ?>
            <li class="nav-item d-none d-sm-inline-block">
            <a style="cursor:pointer;" class="nav-link" onclick="parqueaderos();">
                    Parqueaderos</a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
            <a style="cursor:pointer;" class="nav-link" onclick="tarifas();">
                    Tarifas</a>
            </li>

            <li class="nav-item d-none d-sm-inline-block">
            <a style="cursor:pointer;" class="nav-link" onclick="perfiles();">
                    Perfiles</a>
            </li>

            <li class="nav-item d-none d-sm-inline-block">
            <a style="cursor:pointer;" class="nav-link" onclick="usuarios();">
                    Usuarios</a>
            </li>
          
            <li class="nav-item d-none d-sm-inline-block">
            <a style="cursor:pointer;" class="nav-link" onclick="reportes();">
                Reportes</a>
            </li>
            <?php
            }
            ?>
            <li class="nav-item d-none d-sm-inline-block">
                <a style="cursor:pointer;" class="nav-link" onclick="parking();">
                    Parking</a>
            </li>

            <li class="nav-item d-none d-sm-inline-block">
            <a style="cursor:pointer;" class="nav-link" onclick="cambiarClave();">
            Cambiar Clave</a>
            </li>

                <!-- <li class="nav-item d-none d-sm-inline-block">
            <a style="cursor:pointer;" class="nav-link active" onclick="CargarContenido('vistas/compras.php','content-wrapper');">

                    Compras</a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="#" class="nav-link">Reportes</a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="#" class="nav-link">Configuracion</a>
            </li> -->
            <li class="nav-item d-none d-sm-inline-block">
            <a style="cursor:pointer;" class="nav-link" onclick="salir();">
                    Salir
                    
                </a>
            </li>
        </ul>

       
    </nav>
    <!-- /.navbar -->