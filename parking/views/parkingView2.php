<?php
$raiz = dirname(dirname(dirname(__file__)));
require_once($raiz.'/parqueaderos/models/TipoVehiculoModel.php'); 
require_once($raiz.'/parking/models/ParkingModel.php'); 
require_once($raiz.'/tarifas/models/TarifaModel.php'); 
require_once($raiz.'/vista/vista.php'); 

class parkingView extends vista
{
    protected $tipoVehiculoModel;
    protected $model;
    protected $tarifaModel;

    public function __construct()
    {
        $this->tipoVehiculoModel = new  TipoVehiculoModel(); 
        $this->model = new  ParkingModel(); 
        $this->tarifaModel = new  TarifaModel(); 
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
     <body>
        <div class="row">
            <!-- <div>
                <button class="btn btn-primary">Ingreso</button>
                <button class="btn btn-primary">Salida</button>
            </div> -->
            <div class="col-lg-2 mt-3">
                    <img 
                        src="imagenes/iconoparqueo.png" 
                        width="100px;" 
                        onclick="mostrarTiposVehiculos();"
                        data-bs-toggle="modal" 
                        data-bs-target="#modalNuevoIngresoParking"
                    >
            </div>
            <div class="col-lg-2 mt-3">
                <img 
                    src="imagenes/imagenparking2.jpg"
                        width="100px;" 
                        onclick="formuSalidaVehiculosParking();"
                        data-bs-toggle="modal" 
                        data-bs-target="#modalSalidaParking"
                    >
            </div>
            <div></div>
        </div>
     </body>
     <?php $this->modalNuevoIngresoParking() ;?>
     <?php $this->modalSalidaParking() ;?>
     </html>
     
     <?php
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
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Parking</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="modalBodySalidaParking">
                    
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
                <select class="col-lg-6 form-control" id="idTipoVehiculoIngreso">
                    <?php
                    $this->colocarSelectCampoConOpcionSeleccionada($tiposVehiculos,$idTipoVehiculo);
                    ?>
                </select>    
            </div>
            <div class="row">
                <label class="col-lg-3" for="">Tarifa</label>
                <select class="col-lg-6 form-control" id="idTarifa">
                    <?php
                    $this->colocarSelectCampoConOpcionSeleccionada($tarifas,1);
                    ?>
                </select>    
            </div>
            <div class="row mt-3">
                <label class="col-lg-3" for="">Placa</label>
                <div class="col-lg-6">
                    <input class ="form-control" type="text" id="placaIngreso">
                </div>
            </div>
            <div class="modal-footer mt-3">
                    <!-- <button  type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="parking();" >Cerrar</button> -->
                    <button  
                        type="button" 
                        class="btn btn-primary btn-block"  
                        id="btnEnviar"  
                        onclick="registrarIngresoVehiculo();" 
                        >Ingresar</button>
                </div>
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
                        class="btn btn-primary btn-block"  
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
                        class="btn btn-primary btn-block"  
                        id="btnEnviar"  
                        onclick="facturarPlacaParking();" 
                        >Facturar</button>
                </div>
        </div>
        <?php
    }


}

?>