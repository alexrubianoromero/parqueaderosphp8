<?php
$raiz = dirname(dirname(dirname(__file__)));
require_once($raiz.'/parqueaderos/views/parqueaderoView.php'); 
require_once($raiz.'/parqueaderos/models/ParqueaderoModel.php'); 

class parqueaderoController
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

        $this->view = new parqueaderoView();
        $this->model = new ParqueaderoModel();
        if($_REQUEST['opcion']=='parqueaderoMenu'){
            // $this->model->traerParqueaderos();
            $this->view->parqueaderoMenu();
        }    
        if($_REQUEST['opcion']=='formuNuevoParqueadero'){
            // $this->model->traerParqueaderos();
            $this->view->formuNuevoParqueadero();
        }    
        if($_REQUEST['opcion']=='grabarNuevoParqueadero'){
             $this->grabarNuevoParqueadero($_REQUEST);
        }    
    }

    public function grabarNuevoParqueadero($request)
    {
        $this->model->grabarNuevoParqueadero($request);
        echo 'Informacion grabada';
    }

}