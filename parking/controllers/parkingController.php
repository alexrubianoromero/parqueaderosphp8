<?php
$raiz = dirname(dirname(dirname(__file__)));
require_once($raiz.'/parking/views/parkingView.php'); 
require_once($raiz.'/parking/models/ParkingModel.php'); 
require_once($raiz.'/parqueaderos/models/TipoVehiculoModel.php'); 
require_once($raiz.'/recibosDeCaja/models/ReciboDeCajaModel.php'); 
date_default_timezone_set('America/Bogota');

class parkingController
{
    
    protected $view;
    protected $model;
    protected $tipoVehiculoModel;
    protected $reciboDeCajaModel;
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
        

        if($_REQUEST['opcion']=='parkingMenu'){
            // echo 'parking menu';
            $this->view->menuParking();
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
        if($_REQUEST['opcion']=='mostrarInfoParking'){
            $this->mostrarInfoParking();
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
        $reciboNo = $this->reciboDeCajaModel->grabarReciboDeCaja($request);
        //cambiar el estado de parking y asignar numero de recibo
        $this->model->cambiarEstadoParking($request['idParking'],1);
        //adignar reciboCaja a parking
        $this->model->actualizarReciboCajaParking($request['idParking'],$reciboNo);
        $this->model->actualizarHoraSalidaUsuarioSalidaParking($request['idParking'],$reciboNo);
        
        echo 'Recibo Grabado '.$reciboNo;
        echo '<br><a class="btn btn-secondary btn-lg" target="_blank" href="parking/views/verTicket.php?idParking='.$request['idParking'].'">Ver Recibo</a>'; 

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