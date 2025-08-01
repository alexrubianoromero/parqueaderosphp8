<?php
$raiz = dirname(dirname(dirname(__file__)));
require_once($raiz.'/tarifas/views/tarifasView.php'); 
require_once($raiz.'/tarifas/models/TarifaModel.php'); 
require_once($raiz.'/trazabilidadCambios/models/TrazabilidadCambioModel.php'); 
require_once($raiz.'/parqueaderos/models/ParqueaderoModel.php');  
require_once($raiz.'/usuarios/models/UsuarioModel.php');  


class tarifasController
{
    protected $view;
    protected $model;
    protected $trazabilidadCambioModel;
    protected $parqueaderoModel;
    protected $usuarioModel;
    // protected $viewPlantilla;

    public function __construct()
    {
        session_start();
        if(!isset($_SESSION['id_usuario']) || $_SESSION['id_usuario']=='')
        {
            echo 'la sesion ha caducado';
            echo '<button class="btn btn-primary" onclick="irPantallaLogueo();">Continuar</button>';
            die();
        }
        $this->view = new tarifasView();
        $this->model = new TarifaModel();
        $this->trazabilidadCambioModel = new  TrazabilidadCambioModel(); 
        $this->parqueaderoModel = new ParqueaderoModel();
        $this->usuarioModel = new UsuarioModel();

        if($_REQUEST['opcion']=='tarifasMenu'){
            // echo 'TarifaMenu';
            // $this->model->traerParqueaderos();
            $this->view->tarifasMenu();
        } 
        if($_REQUEST['opcion']=='formuNuevaTarifa'){
            $this->view->formuNuevaTarifa();
        } 
        if($_REQUEST['opcion']=='grabarNuevaTarifa'){
            $this->model->grabarNuevaTarifa($_REQUEST);
            echo 'Informacion Grabada';
        } 
        if($_REQUEST['opcion']=='formuModifTarifa'){
            $this->view->formuModifTarifa($_REQUEST['idTarifa']);
        } 
        if($_REQUEST['opcion']=='grabarModifTarifa'){
            $this->grabarModifTarifa($_REQUEST);
        } 

    }
    

    public function grabarModifTarifa($request)
    {
        $infoTarifa =  $this->model->traerTarifaId($request['idTarifa']); 
        $infoParqueadero =   $this->parqueaderoModel->traerParqueaderoId($infoTarifa['idParqueadero']);  
        $infoUsuario =  $this->usuarioModel->traerInfoUsuarioId($_SESSION['id_usuario']);

        $this->model->actualizarValorMinutoTarifa($request);
        //observaciones, en lugar de idparking colocar algo que denote que es un cambio de valor de tarifa     
        $observaciones = 'Cambio valor minuto parqueadero: '.$infoParqueadero['nombre'].' tarifa: '.$infoTarifa['nombre'];
        $observaciones .= ' Valor anterior minuto: '.$infoTarifa['valorMinuto'];    
        $observaciones .= ' Valor nuevo minuto: '.$request['valorMinuto'];    
        $observaciones .= ' Usuario: '.$infoUsuario['nombre'];    

        $infoTrazabilidad['observaciones'] = $observaciones;  
        $infoTrazabilidad['idParking'] = 'CVT'; //CVM cambio valor tarifa 
        $this->trazabilidadCambioModel->grabarTrazabilidad($infoTrazabilidad); 
        echo 'Valor del minuto actualizado'; 

    }
    
    
}  