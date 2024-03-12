<?php
$raiz = dirname(dirname(dirname(__file__)));
require_once($raiz.'/parqueaderos/models/ParqueaderoModel.php'); 
require_once($raiz.'/parqueaderos/models/TipoVehiculoModel.php'); 
require_once($raiz.'/parking/models/ParkingModel.php'); 
require_once($raiz.'/parking/models/EstadoParkingModel.php'); 
require_once($raiz.'/formasDePago/models/FormaDePagoModel.php'); 
require_once($raiz.'/tarifas/models/TarifaModel.php'); 
require_once($raiz.'/vista/vista.php'); 

class reportesView extends vista
{
    protected $parqueaderoModel;
    protected $tipoVehiculoModel;
    protected $model;
    protected $tarifaModel;
    protected $estadoParkingModel;
    protected $formaDePagoModel;

    public function __construct()
    {
        $this->parqueaderoModel = new  ParqueaderoModel(); 
        $this->tipoVehiculoModel = new  TipoVehiculoModel(); 
        $this->model = new  ParkingModel(); 
        $this->tarifaModel = new  TarifaModel(); 
        $this->estadoParkingModel = new  EstadoParkingModel(); 
        $this->formaDePagoModel = new  FormaDePagoModel(); 
    }

    public function reportesMenu()
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
            <div style="padding:5px;">
                <div><button class="btn btn-primary" onclick="verReporteOcupacion();">Reporte Ocupacion</button></div>
            </div>
            <div class="row" id="divResultadosReportes"></div>
        </body>
        </html>
     <?php
    }

    public function verReporteOcupacion()
    {

        // echo 'reporte ocupacion';
        echo '<div class="row">';
        $parqueaderos = $this->parqueaderoModel->traerParqueaderos();
        foreach($parqueaderos as $parqueadero )
        {
            $parking = $this->model->traerVehiculosParkingGerencial($parqueadero['id']);
            echo '<div class="col-lg-3 row" style="border: 1px solid black;" style="padding:5px;">';
                echo '<h3>'.$parqueadero['nombre'].'</h3>';
                echo '<div style="font-size:20px;">';
                foreach($parking as $park)
                {
                    echo '<br>'.$park['placa'];
                } 
                echo '</div>';
            echo '</div>'; 
        }
        echo '</div>';
    }

}