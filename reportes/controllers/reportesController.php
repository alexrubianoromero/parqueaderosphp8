<?php
$raiz = dirname(dirname(dirname(__file__)));
require_once($raiz.'/reportes/views/reportesView.php'); 
require_once($raiz.'/parking/models/ParkingModel.php'); 
require_once($raiz.'/parqueaderos/models/TipoVehiculoModel.php'); 
require_once($raiz.'/recibosDeCaja/models/ReciboDeCajaModel.php'); 
require_once($raiz.'/trazabilidadCambios/models/TrazabilidadCambioModel.php'); 
date_default_timezone_set('America/Bogota');

class reportesController
{
    
    protected $view;
    protected $model;
    protected $tipoVehiculoModel;
    protected $reciboDeCajaModel;
    protected $trazabilidadCambioModel;
    // protected $viewPlantilla;

    public function __construct()
    {
        session_start();
        // echo '<pre>'; 
        // print_r($_SESSION);
        // echo '</pre>';
        if(!isset($_SESSION['id_usuario']) || $_SESSION['id_usuario']=='')
        {
            echo 'la sesion ha caducado';
            echo '<button class="btn btn-primary" onclick="irPantallaLogueo();">Continuar</button>';
            die();
        }
        $this->view = new reportesView();
        $this->model = new ParkingModel();
        $this->tipoVehiculoModel = new TipoVehiculoModel();
        $this->reciboDeCajaModel = new ReciboDeCajaModel();
        $this->trazabilidadCambioModel = new TrazabilidadCambioModel();
        
        if($_REQUEST['opcion']=='reportesMenu'){
            $this->view->reportesMenu();
        } 
        if($_REQUEST['opcion']=='verReporteOcupacion'){
            $this->view->verReporteOcupacion();
        } 
        
        if($_REQUEST['opcion']=='verReporteTrazabilidad'){

            $registrosTrazabilidad = $this->trazabilidadCambioModel->traerInfoTrazabilidad();
            $this->view->verReporteTrazabilidad($registrosTrazabilidad);
        } 


    }

    
}