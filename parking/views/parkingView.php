<?php
$raiz = dirname(dirname(dirname(__file__)));
require_once($raiz.'/parqueaderos/models/TipoVehiculoModel.php'); 
require_once($raiz.'/parking/models/ParkingModel.php'); 
require_once($raiz.'/parking/models/EstadoParkingModel.php'); 
require_once($raiz.'/formasDePago/models/FormaDePagoModel.php'); 
require_once($raiz.'/tarifas/models/TarifaModel.php'); 
require_once($raiz.'/vista/vista.php'); 

class parkingView extends vista
{
    protected $tipoVehiculoModel;
    protected $model;
    protected $tarifaModel;
    protected $estadoParkingModel;
    protected $formaDePagoModel;

    public function __construct()
    {
        $this->tipoVehiculoModel = new  TipoVehiculoModel(); 
        $this->model = new  ParkingModel(); 
        $this->tarifaModel = new  TarifaModel(); 
        $this->estadoParkingModel = new  EstadoParkingModel(); 
        $this->formaDePagoModel = new  FormaDePagoModel(); 
    }
    public function menuParking()
    {
     ?>
     <!DOCTYPE html>
     <html lang="en">
     <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
     </head>
     <body class="container">
         <!-- el div horizontal principal -->
        <div class="row">

            <!-- el div que contiene las imagenes  -->
            <div class="row col-lg-4 mt-3">

                <div class="col-lg-4" style="border:1px solid black; padding:5px;" align="center">
                    <img 
                        style="border:1px solid black;"
                        src="imagenes/bici.jpg" 
                        height="85px;" 
                        onclick="asignarInfoPorTipoVehiculo(1);"
                    >
                </div>
                <div class="col-lg-4" style="border:1px solid black; padding:5px;" align="center">
                    <img 
                        style="border:1px solid black;"
                        src="imagenes/otroazul.jpg" 
                        height="75px;" 
                        onclick="asignarInfoPorTipoVehiculo(2);"
                    >
                </div>
                <div class="col-lg-4" style="border:1px solid black; padding:5px;" align="center">
                    <img 
                        style="border:1px solid black;"
                        src="imagenes/mt10.png" 
                        height="85px;" 
                        onclick="asignarInfoPorTipoVehiculo(3);"
                    >
                </div>

            </div>
            <!-- la siguiente parte despues de las imagenes osea la de la mitad  -->
            <div class="row col-lg-6 mt-3">
                <!-- el div que coloque para dejar espacio -->
                <div class="col-lg-1"></div>
                <div class="row col-lg-5">
                   <div class="row">
                    <input type="hidden" id="idTipoVehiculoIngreso">
                       <label for="" class="col-lg-4">Tipo:</label>
                       <label for="" style="color:blue;"class="col-lg-4" id="idTipoVehiculoIngresoLabel"></label>
                     
                    </div>
                   <div class="row">
                       <label for="" class="col-lg-4">Placa:</label>
                       <div class="col-lg-8">
                           <input type="text" class="form-control" id="placaIngreso">
                        </div>
                    </div>
                    <div class="row mt-1" id="div_idTarifa">
                    
                        <!-- <select id="idTarifa" name="idTarifa" class="form-control"> -->
                            <?php   
                                // $tarifas =   $this->tarifaModel->traerTarifaIdParqueadero($_SESSION['idSucursal']); 
                                // $this->colocarSelectCampoConOpcionSeleccionada($tarifas,1);
                                
                            ?>
                        <!-- </select> -->
                    </div>
                    <!-- <div class="row mt-1">
                        <button class="btn btn-primary btn-sm">Registrar</button>
                    </div> -->
                </div>
                <!-- aqui coolocare el boton de registrar  -->
              
                <!-- la ultima parte del bloque inicial de 3  -->
                <div class="row col-lg-5 mt-1">
                    <div class="row">
                        <label class="">Hora: <?php  echo date("H:i:s");  ?></label>
                    </div>
                
                    <div class="row">
                        <label class="">Fecha: <?php  echo date("d-M-Y");        ?></label>
                    </div>
                    <button 
                        class="btn btn-warning btn-lg" 
                        onclick="registrarIngresoVehiculo();" 
                        >Registrar</button>
                        <!-- data-bs-toggle="modal" 
                        data-bs-target="#modalNuevoIngresoParking" -->
                </div>
               
            </div>
        </div>
         <!-- este div es para colocar mensajes como registro grabado o cosas asi -->
        <div class="row" id="mensajesdePrograma" style="padding:1px;color:blue;font-size:20px"></div>
        <!-- aqui es el div que muestra la informacion de los vehiculos relacionadosa parqueadero  -->
        <div class="row mt-3" style="padding:5px;">
            <div class="row mt-1">
                <div class="col-lg-4">
                    <button class="btn btn-secondary btn-sm" onclick="mostrarInfoParking();">Registros Abiertos</button>
                    <button class="btn btn-secondary btn-sm" onclick="mostrarMovimientosEnParqueadero();">Movimientos en parqueadero</button>
                </div>
                <div class="col-lg-4 row">
                    <label class=" col-lg-2">BUSCAR:</label>
                    <div class="col-lg-4">
                        <input 
                            id="placaABuscarEnParking"  
                            class="form-control"
                            placeholder = "Placa"
                            onkeyup="buscarPlacaVehiculosParking(); "
                        >
                    </div>
                </div>
            </div>
            <div class="row mt-2" id="divInfoVehiculosParqueadero"  style="border:1px solid black;">
                <?php 
                    $parking = $this->model->traerVehiculosParking();    
                    $this->mostrarInfoParking($parking); 
                ?>
            </div>

        </div>
        
        
        <div class="row">
            <!-- <div>
                <button class="btn btn-primary">Ingreso</button>
                <button class="btn btn-primary">Salida</button>
            </div> -->
            <!-- <div class="col-lg-2 mt-3">
                    <img 
                        src="imagenes/iconoparqueo.png" 
                        width="100px;" 
                        onclick="mostrarTiposVehiculos();"
                        data-bs-toggle="modal" 
                        data-bs-target="#modalNuevoIngresoParking"
                    >
            </div> -->
            <!-- <div class="col-lg-2 mt-3">
                <img 
                    src="imagenes/imagenparking2.jpg"
                        width="100px;" 
                        onclick="formuSalidaVehiculosParking();"
                        data-bs-toggle="modal" 
                        data-bs-target="#modalSalidaParking"
                    >
            </div> -->
            <div></div>
        </div>
     </body>
     <?php $this->modalNuevoIngresoParking() ;?>
     <?php $this->modalSalidaParking() ;?>
     </html>
     
     <?php
    }
    public function reiniciarSelectTarifas()
    {
        $tarifas =   $this->tarifaModel->traerTarifaIdParqueadero($_SESSION['idSucursal']); 
        $this->colocarSelectCampoConOpcionSeleccionada($tarifas,1);
        
    }
    public function modalNuevoIngresoParking()
    {
        ?>
            <!-- Modal -->
            <div class="modal fade" id="modalNuevoIngresoParking" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Parking</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="modalBodyNuevoIngresoParking">
                    
                </div>
                <div class="modal-footer">
                    <!-- <button  type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="parking();" >Cerrar</button>
                    <button  type="button" class="btn btn-primary"  id="btnEnviar"  onclick=";" >Grabar</button> -->
                </div>
                </div>
            </div>
            </div>

        <?php
    }
  
    public function modalSalidaParking()
    {
        ?>
            <!-- Modal -->
            <div class="modal fade" id="modalSalidaParking" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Parking.</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="modalBodySalidaParking">
                    
                </div>
                <div class="modal-footer">
                    <button  type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="parking();" >Cerrar</button>
                    <!-- <button  type="button" class="btn btn-primary"  id="btnEnviar"  onclick=";" >Grabar</button> -->
                </div>
                </div>
            </div>
            </div>

        <?php
    }
  

    public function mostrarTiposVehiculos()
    {
        $tiposVehiculos = $this->tipoVehiculoModel->traerTiposVehiculos(); 
       ?>
       <div class="row"  style="padding:5px;">
       <h3>Tipo Vehiculo</h3>
        <?php
            foreach($tiposVehiculos as $tipoVehiculo)
            {
                $nombreImagen = $tipoVehiculo['nombreImagen'];
                echo '  <div class="col-lg-3" style=" margin:8px;" align="center">';
                echo '   <img 
                            style="border:1px solid black;"
                            src="imagenes/'.$nombreImagen.'" 
                            height="80px;" 
                            onclick="formuIngresoVehiculoParqueadero('.$tipoVehiculo['id'].');"
                        >';
                echo '</div>';     
              
            }

        ?>
        <div clas="col-lg-2"></div>
        <div clas="col-lg-2"></div>
       </div>
       
       <?php
    }
    public function formuIngresoVehiculoParqueadero($idTipoVehiculo)
    {
        $tiposVehiculos = $this->tipoVehiculoModel->traerTiposVehiculos();
        $tarifas =   $this->tarifaModel->traerTarifaIdParqueadero($_SESSION['idSucursal']); 
        ?>
        <div class="row">
            <div class="row">
                <label class="col-lg-3" for="">Tipo Vehiculo</label>
                <select class="col-lg-6 form-control" id="idTipoVehiculoIngresoAnte">
                    <?php
                    $this->colocarSelectCampoConOpcionSeleccionada($tiposVehiculos,$idTipoVehiculo);
                    ?>
                </select>    
            </div>
            <div class="row">
                <label class="col-lg-3" for="">Tarifa</label>
                <select class="col-lg-6 form-control" id="idTarifaAnte">
                    <?php
                        $this->colocarSelectCampoConOpcionSeleccionada($tarifas,1);
                    ?>
                </select>    
            </div>
            <div class="row mt-3">
                <label class="col-lg-3" for="">Placa</label>
                <div class="col-lg-6">
                    <input class ="form-control" type="text" id="placaIngresoAnte">
                </div>
            </div>
            <div class="modal-footer mt-3">
                    <!-- <button  type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="parking();" >Cerrar</button> -->
                    <button  
                        type="button" 
                        class="btn btn-warning btn-block"  
                        id="btnEnviar"  
                        onclick="registrarIngresoVehiculoAnte();" 
                        >Ingresar</button>
                </div>
        </div>
      


        <?php
    }
    
    
    /*
    **obtiene la diferencia en dias
    */
    function dias_pasados($fecha_inicial,$fecha_final)
    {
        $dias = (strtotime($fecha_inicial)-strtotime($fecha_final))/86400;
        $dias = abs($dias); $dias = floor($dias);
        return $dias;
    }

    public function restafechas($fechaIngreso)
    {
        date_default_timezone_set('America/Bogota');		
        $fechaInicio = new DateTime($fechaIngreso);
        $fechaFin = new DateTime(date("Y-m-d H:i:s"));
        // $fechaFin = new DateTime("2022-01-01 17:45:25");
        $intervalo = $fechaInicio->diff($fechaFin);
        return $intervalo; 
        // echo "La diferencia entre  " . $fechaInicio->format('Y-m-d h:i:s') . " y " . $fechaFin->format('Y-m-d h:i:s') . " es de: <br> " .   $intervalo->y . " años, " . $intervalo->m." meses, ".$intervalo->d." dias, " . $intervalo->h . " horas, " . $intervalo->i . " minutos y " . $intervalo->s . " segundos";  
    }

    function cantidadMinutos($intervalo)
    {
        $horasEnMinutos = $intervalo->h *60;
        $minutos = $intervalo->i ;
        $segundosEnMinutos = $intervalo->s/60 ;
        // if($segundosMinutos<0){
        //     $minutos = $horasAminutos+$segundosMinutos;
        // }else{
            $minutos = $horasEnMinutos+$minutos+$segundosEnMinutos;
        // }
        // echo '<br>horasMInutos:'.$horasEnMinutos.'<br>segundosMinutos:'.$minutos; 
        // echo '<br>Segundos:'.$segundosEnMinutos;
        // echo '<br>Minutos:'.$minutos;
        //  echo '<pre>'; 
        // print_r($intervalo->s);
        // echo '</pre>';
        // die();

        return  $minutos;
    }
    function cantidadHoras($intervalo)
    {
        // $horasAminutos = $intervalo->h * 60;
        $segundosHoras = $intervalo->s /3600;
        $segundosHoras = $intervalo->i ;
        $totalHoras = $segundosHoras+$segundosHoras+$intervalo->h;
        return  $totalHoras;
    }


    public function liquidarSalidaVehiculo($idParking)
    {
        $infoParking = $this->model->traerInfoParkingIdParking($idParking);
        $tipoVehiculo = $this->tipoVehiculoModel->traerTipoVehiculoId($infoParking['idTipoVehiculo']);
        $infoTarifa  =  $this->tarifaModel->traerTarifaId($infoParking['idTarifa']);  
        $intervalo = $this->restafechas($infoParking['horaIngreso'] ); 
        $cantidadMinutos = $this->cantidadMinutos($intervalo);
        $cantidadHoras = $this->cantidadHoras($intervalo);
        $cobroMinutos = $cantidadMinutos * $infoTarifa['valorMinuto'];
        $cobroHoras = $cantidadHoras * $infoTarifa['valorHora'];
        $stringTiempoTotal =  $intervalo->h.' Horas '.$intervalo->i.' Minutos '.$intervalo->s.' segundos' ;
        
      

        ?>
        <div class="row">
                <label for="">Placa: <?php echo $infoParking['placa']  ?></label>
                <label for="">Tipo: <?php echo $tipoVehiculo['descripcion']  ?></label>
                <label for="">Tarifa: <?php echo $infoTarifa['descripcion']  ?></label>
                <label for="">Hora Ingreso: <?php echo $infoParking['horaIngreso']  ?></label>
                <label for="">Tiempo Total: <?php echo $intervalo->h.' Horas '.$intervalo->i.' Minutos '.$intervalo->s.' segundos'  ?></label>
                <label for="">Valor: <?php echo number_format($cobroMinutos,0,",",".") ?></label>
        </div>
        <div class="row">
            <input type="hidden"  id="inputCobroMinutos" value = "<?php echo round($cobroMinutos) ?>">
            <input type="hidden"  id="inputPlaca" value = "<?php echo $infoParking['placa']?>">
            <input type="hidden"  id="stringTiempoTotal" value = "<?php echo $stringTiempoTotal; ?>">
                <label class="col-lg-4">Forma de pago</label>
                <div class="col-lg-8">
                    <select class="form-control" id="idFormaPago">
                        <option  value="-1">Seleccione..</option>
                        <option  value="1">Efectivo</option>
                        <option  value="2">Nequi</option>
                        <?php 
                        //    $formasDePago =   $this->formaDePagoModel->traerFormasDePago();
                        //     echo 'qeqweqwqw<pre>'; 
                        //     print_r($formasDePago);
                        //     echo '</pre>';
                        //     die();
                        //     foreach($formasDePago as $formaDePago)
                        //     {
                            //         echo '<option  value="'.$formaDePago['id'].'">'.$formaDePago['descripcion'].'</option>';
                            //     } 
                            ?>
                    </select>
                </div>
                <label class="col-lg-4 mt-3">Valor Recibido</label>
                <div class="col-lg-8 mt-3">
                    <input type="text" id="valorRecibido" class ="form-control" onkeyup="calcularVueltas();">
                </div>
                <label class="col-lg-4 mt-3">Valor Vueltas</label>
                <div class="col-lg-8 mt-3">
                    <input type="text" id="valorVueltas" class ="form-control" onfocus="blur();">
                </div>
                
        </div>
        <div>
            <!-- <button class="btn btn-warning btn-block mt-3" onclick="facturarSalidaVehiculo(<?php   echo $idParking  ?>);">Facturar</button> -->
            <!-- <a target="_blank"  href="parking/views/verTicket.php?idParking=<?php echo $idParking;  ?>" class="btn btn-warning btn-block mt-3" onclick="facturarSalidaVehiculo(<?php   echo $idParking  ?>);">Facturar</a> -->
            <button  class="btn btn-warning btn-block mt-3" onclick="facturarSalidaVehiculo(<?php   echo $idParking  ?>);">Facturar</button>
        </div>
        <?php
    }
    public function formuSalidaVehiculosParking()
    {
        ?>
        <div class="row">
            <div class="row mt-3">
                <label class="col-lg-3" for="">Placa:</label>
                <div class="col-lg-3">
                    <input class ="form-control" type="text" id="placaABuscarParking">
                </div>
                <div class="col-lg-4">
                <button  
                        type="button" 
                        class="btn btn-warning btn-block"  
                        id="btnEnviar"  
                        onclick="buscarPlacaEnParking();" 
                        >Buscar</button>
                </div>
            </div>
            <div id="divResultadosPlacaParking"></div>
            <!-- <div class="modal-footer mt-3">
                    <button  
                        type="button" 
                        class="btn btn-primary btn-block"  
                        id="btnEnviar"  
                        onclick="buscarPlacaEnParking();" 
                        >Buscar</button>
            </div> -->
        </div>
        <?php
    }
    public function mostrarInfoplacaParking($placa)
    {
        $infoPlaca = $this->model->traerInfoParkingPlaca($placa); 
        $tipoVehiculo = $this->tipoVehiculoModel->traerTipoVehiculoId($infoPlaca['idTipoVehiculo']); 
        $infoTarifa  =  $this->tarifaModel->traerTarifaId($infoPlaca['idTarifa']); 
        $ahora = date("Y-m-d H:i:s");   
        // echo '<pre>'; 
        // print_r($infoPlaca);
        // echo '</pre>';
        // die();
        ?>
        <div class="row">
            <!-- <div class="row mt-3">
                <label class="col-lg-3" for="">Placa:</label>
                <div class="col-lg-3">
                    <input class ="form-control" type="text" id="placaABuscarParking" value = "<?php  echo $placa; ?>">
                </div>
                <div class="col-lg-4"></div>
                
            </div> -->
            <div class="row mt-1">
                <label class="col-lg-4" for="">Tipo Vehiculo: </label>
                 <label class="col-lg-8"><?php echo $tipoVehiculo['descripcion']; ?></label>
            </div>
            <div class="row mt-1">
                <label class="col-lg-4" for="">Tarifa: </label>
                 <label class="col-lg-8"><?php echo $infoTarifa['descripcion']; ?></label>
            </div>
            <div class="row mt-1">
                <label class="col-lg-4" for="">Hora Entrada: </label>
                 <label class="col-lg-8"><?php echo $infoPlaca['horaIngreso']; ?></label>
            </div>
            <div class="row mt-1">
                <label class="col-lg-4" for="">Hora Salida: </label>
                 <label class="col-lg-8"><?php echo $ahora; ?></label>
            </div>

            <div class="modal-footer mt-3">
                    <button  
                        type="button" 
                        class="btn btn-warning btn-block"  
                        id="btnEnviar"  
                        onclick="facturarPlacaParking();" 
                        >Facturar</button>
                </div>
        </div>
        <?php
    }

    public function mostrarInfoParking($parking)
    {
        ?>
        <div class="row">
        <table class="table table-striped mt-3">
                <thead>
                    <tr>
                        <th>Placa</th>
                        <th>Ticket</th>
                        <th>Tipo Vehiculo</th>
                        <th>Hora Ingreso</th>
                        <th>Fecha Ingreso</th> 
                        <th>Estado</th> 
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach($parking as $park)
                    {
                          $infoTipo = $this->tipoVehiculoModel->traerTipoVehiculoId($park['idTipoVehiculo']); 
                          $infoEstadoPArking =    $this->estadoParkingModel->traerEstadosParkingId($park['estado']); 
                          echo '<tr>';  
                          echo '<td><button 
                                        class="btn btn-warning " 
                                        data-bs-toggle="modal" 
                                        data-bs-target="#modalSalidaParking"
                                        onclick ="liquidarSalidaVehiculo('.$park['id'].');" 
                                        >'.$park['placa'].'</button></td>'; 
                            
                          echo '<td><a class ="btn btn-secondary"target="_blank" href="parking/views/verTicketEntrada.php?idParking='.$park['id'].'">Ticket</a></td>'; 
                          echo '<td>'.$infoTipo['descripcion'].'</td>'; 
                          echo '<td>'.substr($park['horaIngreso'],11,8).'</td>'; 
                          echo '<td>'.substr($park['horaIngreso'],0,10).'</td>'; 
                          echo '<td>'.$infoEstadoPArking['descripcion'].'</td>'; 
                       
                          echo '</tr>';  
                        }  
                        ?>
                </tbody>
            </table>
        </div>

        <?php

    }
    public function mostrarInfoParkingMovimientos($parking)
    {
        ?>
        <div class="row">
        <table class="table table-striped mt-3">
                <thead>
                    <tr>
                        <th>Placa</th>
                        <th>Recibo</th>
                        <th>Tipo Vehiculo</th>
                        <th>Hora Ingreso</th>
                        <th>Fecha Ingreso</th> 
                        <th>Hora Salida</th>
                        <th>Fecha Salida</th> 
                        <th>Estado</th> 
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach($parking as $park)
                    {
                          $infoTipo = $this->tipoVehiculoModel->traerTipoVehiculoId($park['idTipoVehiculo']); 
                          $infoEstadoPArking =    $this->estadoParkingModel->traerEstadosParkingId($park['estado']); 
                          echo '<tr>';  
                        //   echo '<td><button 
                        //                 class="btn btn-warning " 
                        //                 data-bs-toggle="modal" 
                        //                 data-bs-target="#modalSalidaParking"
                        //                 onclick ="liquidarSalidaVehiculo('.$park['id'].');" 
                        //                 >'.$park['placa'].'</button></td>'; 
                          echo '<td>'.$park['placa'].'</td>'; 
                          echo '<td><a class ="btn btn-secondary"target="_blank" href="parking/views/verTicket.php?idParking='.$park['id'].'">Recibo</a></td>'; 
                          echo '<td>'.$infoTipo['descripcion'].'</td>'; 
                          echo '<td>'.substr($park['horaIngreso'],11,8).'</td>'; 
                          echo '<td>'.substr($park['horaIngreso'],0,10).'</td>'; 
                          echo '<td>'.substr($park['horaSalida'],11,8).'</td>'; 
                          echo '<td>'.substr($park['horaSalida'],0,10).'</td>'; 
                          echo '<td>'.$infoEstadoPArking['descripcion'].'</td>'; 
                       
                          echo '</tr>';  
                        }  
                        ?>
                </tbody>
            </table>
        </div>

        <?php

    }
    public function traerTarifaIdParqIdTipVehi($tarifas)
    {
        echo '<select id="idTarifa" name="idTarifa" class="form-control">'; 
        // echo '<option value="-1">Sel.</option>';
        foreach($tarifas as $tarifa)
        {
                echo ' <option value="'.$tarifa['id'].'">'.$tarifa['descripcion'].'</option>';
        }
        echo '</select>';
    }
}

?>