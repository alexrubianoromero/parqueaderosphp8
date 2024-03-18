<?php
$raiz = dirname(dirname(dirname(__file__)));
require_once($raiz.'/tarifas/views/tarifasView.php'); 
require_once($raiz.'/tarifas/models/TarifaModel.php'); 

class tarifasController
{
    protected $view;
    protected $model;
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

    }
    
    
}  