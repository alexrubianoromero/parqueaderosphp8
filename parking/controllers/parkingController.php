<?php
$raiz = dirname(dirname(dirname(__file__)));
require_once($raiz.'/parking/views/parkingView.php'); 
require_once($raiz.'/parking/models/ParkingModel.php'); 
require_once($raiz.'/parqueaderos/models/TipoVehiculoModel.php'); 
require_once($raiz.'/parqueaderos/models/ParqueaderoModel.php'); 
require_once($raiz.'/recibosDeCaja/models/ReciboDeCajaModel.php'); 
require_once($raiz.'/tarifas/models/TarifaModel.php'); 

date_default_timezone_set('America/Bogota');

class parkingController
{
    
    protected $view;
    protected $model;
    protected $tipoVehiculoModel;
    protected $reciboDeCajaModel;
    protected $tarifaModel;
    protected $parqueaderoModel;
    // protected $viewPlantilla;

    public function __construct()
    {
        session_start();

        // echo '<pre>'; 
        // print_r($_SESSION);
        // echo '</pre>';
        // die();
        if(!isset($_SESSION['id_usuario']) || $_SESSION['id_usuario']=='')
        {
            echo 'la sesion ha caducado';
            echo '<button class="btn btn-primary" onclick="irPantallaLogueo();">Continuar</button>';
            die();
        }
        $this->view = new parkingView();
        $this->model = new ParkingModel();
        $this->tipoVehiculoModel = new TipoVehiculoModel();
        $this->reciboDeCajaModel = new ReciboDeCajaModel();
        $this->tarifaModel = new  TarifaModel(); 
        $this->parqueaderoModel = new  ParqueaderoModel(); 
        

        if($_REQUEST['opcion']=='parkingMenu'){
            // echo 'parking menu';
            $this->view->menuParking();
        } 
        if($_REQUEST['opcion']=='formuModificacionPlaca'){
            // echo 'parking menu';
            $this->view->formuModificacionPlaca($_REQUEST['idParking']);
        } 
        if($_REQUEST['opcion']=='mostrarTiposVehiculos'){
            $this->view->mostrarTiposVehiculos();
        } 
       
        if($_REQUEST['opcion']=='formuIngresoVehiculoParqueadero'){
            // die('passoooo11');
            $this->view->formuIngresoVehiculoParqueadero($_REQUEST['idTipoVehiculo']);
        } 
        if($_REQUEST['opcion']=='formuSalidaVehiculosParking'){
            // die('passoooo11');
            $this->view->formuSalidaVehiculosParking();
        } 
        if($_REQUEST['opcion']=='registrarIngresoVehiculo'){
            $this->registrarIngresoVehiculo($_REQUEST);
        } 
        if($_REQUEST['opcion']=='buscarPlacaEnParking'){
            $this->buscarPlacaEnParking($_REQUEST['placa']);
        } 
        
        if($_REQUEST['opcion']=='asignarInfoPorTipoVehiculo'){
            $this->asignarInfoPorTipoVehiculo($_REQUEST['idTipo']);
        } 
        if($_REQUEST['opcion']=='traerTarifaIdParqIdTipVehi'){
            // die('llego acaq ');
            $tarifasXparXtipo =  $this->tarifaModel->traerTarifaIdParqIdTipVehi($_SESSION['idSucursal'],$_REQUEST['idTipo']);
        //      echo '<pre>'; 
        // print_r($tarifasXparXtipo);
        // echo '</pre>';
        // die();
            // echo json_encode($tarifasXparXtipo);
            $this->view->traerTarifaIdParqIdTipVehi($tarifasXparXtipo);
        } 


        if($_REQUEST['opcion']=='mostrarInfoParking'){
            $this->mostrarInfoParking();
        } 
        if($_REQUEST['opcion']=='mostrarMovimientosDiarioEnParqueadero'){
            $this->mostrarMovimientosDiarioEnParqueadero();
        } 
        if($_REQUEST['opcion']=='mostrarMovimientosEnParqueaderoRangoFechas'){
            $this->mostrarMovimientosEnParqueaderoRangoFechas($_REQUEST);
        } 
        if($_REQUEST['opcion']=='mostrarMovimientosEnParqueadero'){
            $this->mostrarMovimientosEnParqueadero();
        } 
        if($_REQUEST['opcion']=='buscarPlacaVehiculosParking'){
            $this->buscarPlacaVehiculosParking($_REQUEST['placa']);
        } 
        
        if($_REQUEST['opcion']=='liquidarSalidaVehiculo'){
            // die('passoooo11');
            $this->view->liquidarSalidaVehiculo($_REQUEST['idParking']);
        } 
        if($_REQUEST['opcion']=='reiniciarSelectTarifas'){
            // die('passoooo11');
            $this->view->reiniciarSelectTarifas();
        } 
        if($_REQUEST['opcion']=='facturarSalidaVehiculo'){
            $this->facturarSalidaVehiculo($_REQUEST);
        } 
    }
    
    
    public function facturarSalidaVehiculo($request)
    {
        $infoparking =  $this->model->traerInfoParkingIdParking($request['idParking']); 
        $infoParqueadero =  $this->parqueaderoModel->traerParqueaderoId($infoparking['idParqueadero']); 
        //         echo '<pre>'; 
        // print_r($infoParqueadero);
        // echo '</pre>';
        // die();

        $reciboNo = $this->reciboDeCajaModel->grabarReciboDeCaja($request);
        //cambiar el estado de parking y asignar numero de recibo
        $this->model->cambiarEstadoParking($request['idParking'],1);
        //adignar reciboCaja a parking
        $this->model->actualizarReciboCajaParking($request['idParking'],$reciboNo);
        $this->model->actualizarHoraSalidaUsuarioSalidaParking($request['idParking'],$reciboNo);
        
        echo 'Recibo Grabado '.$reciboNo;
        echo '<br><a class="btn btn-secondary btn-lg" target="_blank" href="parking/views/'.$infoParqueadero['archivoTicketSalida'].'?idParking='.$request['idParking'].'">Ver Recibo</a>'; 

        // $this->view->mostrarInfoParking($parking); 
    }
    
    public function buscarPlacaVehiculosParking($placa)
    {
        $parking = $this->model->buscarPlacaVehiculosParking($placa);
        $this->view->mostrarInfoParking($parking); 
    }

    public function mostrarInfoParking()
    {
        $parking = $this->model->traerVehiculosParking();
        $this->view->mostrarInfoParking($parking); 
    }
    public function mostrarMovimientosDiarioEnParqueadero()
    {
        // $fechaHoy = date("Y-m-d H:i:s"); 
        $fechaHoy = date("Y-m-d"); 
        $fechaIn = $fechaHoy.' 00:00:00';
        $fechaFin = $fechaHoy.' 23:59:59';
        $parking = $this->model->traerHistorialVehiculosParkingRangoFechas($fechaIn,$fechaFin);
        //traer solo el historial del dia de los vehiculos que se han ido
        $this->view->mostrarInfoParkingMovimientos($parking); 
    }
    public function mostrarMovimientosEnParqueaderoRangoFechas($request)
    {
        // $fechaHoy = date("Y-m-d H:i:s"); 
        $fechaHoy = date("Y-m-d"); 
        $fechaIn = $request['fechaIn'].' 00:00:00';
        $fechaFin = $request['fechaFin'].' 23:59:59';
        // die($fechaHoy);
        $parking = $this->model->traerHistorialVehiculosParkingRangoFechas($fechaIn,$fechaFin);
        //traer solo el historial del dia de los vehiculos que se han ido
        $this->view->mostrarInfoParkingMovimientos($parking); 
    }
    public function mostrarMovimientosEnParqueadero()
    {
        $parking = $this->model->traerHistorialVehiculosParking();

        $this->view->mostrarInfoParkingMovimientos($parking); 
    }

    public function asignarInfoPorTipoVehiculo($idTipo)
    {
        // die('antes de consulta a la base de datos ');
        $infoTipoVehiculo =  $this->tipoVehiculoModel->traerTipoVehiculoId($idTipo); 
        // echo '<pre>'; 
        // print_r($infoTipoVehiculo);
        // echo '</pre>';
        // die();

        echo json_encode($infoTipoVehiculo);
        exit();
    }
    public function registrarIngresoVehiculo($request)
    {
       
        $error = $this->model->grabarVehiculoParking($request); 
        if($error==0){
            echo 'Registro Realizado';
        }else{
            echo 'Placa no se registro porque ya se encuentra registrada  en parking verificar ';
        }
    }
    
    public function buscarPlacaEnParking($placa)
    {
        $resultado = $this->model->verificarPlacaEstadoCeroParking($placa); 
        if($resultado==0){
            echo 'Placa No Encontrada';
        }else{
            $this->view->mostrarInfoplacaParking($placa);

        }

    }

    
}  