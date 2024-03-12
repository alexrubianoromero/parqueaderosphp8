<?php
$raiz = dirname(dirname(dirname(__file__)));
require_once($raiz.'/usuarios/views/usuarioView.php'); 
require_once($raiz.'/usuarios/models/UsuarioModel.php'); 

class usuarioController
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
        // echo 'controlador usuario';
        $this->view = new usuarioView();
        $this->model = new UsuarioModel();

        if($_REQUEST['opcion']=='usuarioMenu'){
            // $this->model->traerParqueaderos();
            $this->view->usuarioMenu();
        }    
        if($_REQUEST['opcion']=='pedirInfoUsuarioNuevo'){
            $this->view->pedirInfoUsuarioNuevo();
        }
        if($_REQUEST['opcion']=='grabarNuevoUsuario'){
            // $this->model->traerParqueaderos();
            // echo '<pre>'; 
            // print_r($_REQUEST); 
            // echo '</pre>';
            // die();
            $this->grabarNuevoUsuario($_REQUEST);
        }    
        // if($_REQUEST['opcion']=='grabarNuevoParqueadero'){
        //      $this->grabarNuevoParqueadero($_REQUEST);
        // }    
    }

    public function grabarNuevoUsuario($request)
    {
        $this->model->grabarNuevoUsuario($request);
        echo 'Informacion grabada';
    }

}