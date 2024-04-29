<?php
$raiz = dirname(dirname(dirname(__file__)));
require_once($raiz.'/parqueaderos/models/ParqueaderoModel.php'); 
require_once($raiz.'/parqueaderos/models/TipoVehiculoModel.php'); 
require_once($raiz.'/parking/models/ParkingModel.php'); 
require_once($raiz.'/parking/models/EstadoParkingModel.php'); 
require_once($raiz.'/formasDePago/models/FormaDePagoModel.php'); 
require_once($raiz.'/tarifas/models/TarifaModel.php'); 
require_once($raiz.'/recibosDeCaja/models/ReciboDeCajaModel.php'); 
require_once($raiz.'/usuarios/models/UsuarioModel.php'); 
require_once($raiz.'/vista/vista.php'); 

class reportesView extends vista
{
    protected $parqueaderoModel;
    protected $tipoVehiculoModel;
    protected $model;
    protected $tarifaModel;
    protected $estadoParkingModel;
    protected $formaDePagoModel;
    protected $reciboModel;
    protected $usuarioModel;

    public function __construct()
    {
        $this->parqueaderoModel = new  ParqueaderoModel(); 
        $this->tipoVehiculoModel = new  TipoVehiculoModel(); 
        $this->model = new  ParkingModel(); 
        $this->tarifaModel = new  TarifaModel(); 
        $this->estadoParkingModel = new  EstadoParkingModel(); 
        $this->formaDePagoModel = new  FormaDePagoModel(); 
        $this->reciboModel = new  ReciboDeCajaModel(); 
        $this->usuarioModel = new  UsuarioModel(); 
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
                <div>
                    <button style="margin-right:20px;"class="btn btn-warning" onclick="verReporteOcupacion();">Reporte Ocupacion</button>
                    <!-- <button class="btn btn-warning" onclick="verReporteTrazabilidad();">Reporte Trazabilidad</button> -->
                </div>
            </div>
            <div class="row" id="divResultadosReportes"></div>
        </body>
        </html>
     <?php
    }

    public function contadorPorTipoVehiculo($idTipoVe,$parking)
    {
        $infoTipo = $this->tipoVehiculoModel->traerTipoVehiculoId($idTipoVe);

        $total = 0;
        foreach($parking as $park)
        {
            if($park['idTipoVehiculo']== $idTipoVe){ $total = $total +1 ; } 
        } 
        $respu['descripTipo']= $infoTipo['descripcion'] ;
        $respu['total']= $total;
        return $respu ; 
    }

    public function pintarTotalesPorParqueadero($idParqueadero)
    {
        $parking = $this->model->traerVehiculosParkingGerencial($idParqueadero);
        $tiposVehiculos =   $this->tipoVehiculoModel->traerTiposVehiculos();
        foreach($tiposVehiculos as $tiposVehiculo)
        {
            $conteo =  $this->contadorPorTipoVehiculo($tiposVehiculo['id'],$parking);
            echo ' '.$conteo['descripTipo'].'s: '.$conteo['total'].'<br>';
        } 
    }

    public function verReporteOcupacion()
    {

        // echo 'reporte ocupacion';
        echo '<div class="row">';
        $parqueaderos = $this->parqueaderoModel->traerParqueaderos();
        foreach($parqueaderos as $parqueadero )
        {
            $parking = $this->model->traerVehiculosParkingGerencial($parqueadero['id']);
            // echo '<div class="col-lg-3 row" style="border: 1px solid black;" style="padding:5px;">';
            //     echo '<h3>'.$parqueadero['nombre'].'</h3>';
            //     echo '<div style="font-size:20px;">';
            //     foreach($parking as $park)
            //     {
                //         echo '<br>'.$park['placa'];
                //     } 
                //     echo '</div>';
                // echo '</div>'; 
           
                $producidoDiario = $this->reciboModel->sumarProducidoDiario($parqueadero['id']);    
                // $producidoDiario =  number_format($producidoDiario['suma'],",","."); 
            ?>
            <div class="card text-bg-warning mb-3" style="max-width: 18rem;margin:10px;">
            <div class="card-header">
                     <h3><?php   echo $parqueadero['nombre']; ?></h3>
                <div> 
                    <?php   echo'<br>Recaudo Diario: '.number_format($producidoDiario['suma'],0,",",".") ?>
                </div>
            </div>
            <div class="card-body">
                <h5 class="card-title">
                    <?php
                          $this->pintarTotalesPorParqueadero($parqueadero['id']);  
                    ?>
                </h5>
                <p class="card-text">
                    <?php
                        echo '<table class="table table-striped">';
                        echo '<tr class="table-dark">';
                        echo '<th>Tipo</th>';  
                        echo '<th>Placa</th>';  
                        echo '</tr>'; 
                        foreach($parking as $park)
                        { 
                            $infoTipo = $this->tipoVehiculoModel->traerTipoVehiculoId($park['idTipoVehiculo']);
                            // echo '<br>'.$infoTipo['descripcion'].' '.$park['placa'];  
                            echo '<tr class="table-warning ">';
                            echo '<td>'.$infoTipo['descripcion'].'</td>';
                            echo '<td>'.$park['placa'].'</td>';
                            echo '</tr>'; 
                        } 
                        echo '</table>';
                    ?>
                </p>
            </div>
            </div>
                <!-- <div class="col-sm-6">
                    <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Special title treatment</h5>
                        <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                        <a href="#" class="btn btn-primary">Go somewhere</a>
                    </div>
                    </div>
                </div> -->
           <?php         

        }
        echo '</div>';
    }
    public function verReporteOcupacion_ante()
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

    public function verReporteTrazabilidad($registrosTrazabilidad)
    {
        $fechaHoy = date("Y-m-d"); 
        $fechaIn = $fechaHoy.' 00:00:00';
        $fechaFin = $fechaHoy.' 23:59:59';
        ?>
        <div>
            <div>Reporte Trazabilidad cambios dia: <?php  echo $fechaHoy;    ?>  </div>
            <div id="infoTrazabilidad">
            <table class="table table-striped mt-3">
                <thead>
                    <tr>
                        <th>Fecha</th>
                        <th>Usuario</th>
                        <th>Observaciones cambio</th>
                    </tr>
                </thead>
                <tbody>
                    <?php

                  

                    foreach($registrosTrazabilidad as $registro)
                    {
                        $infoUsuario = $this->usuarioModel->traerInfoUsuarioId($registro['idUsuario']);
                        echo '<tr>';
                          echo '<td>'.$registro['fecha'].'</td>'; 
                          echo '<td>'.$infoUsuario['nombre'].'</td>'; 
                          echo '<td>'.$registro['observaciones'].'</td>'; 
                          echo '</tr>';  
                    }
                    ?>
                </tbody>
            </table>
            </div>

        </div>
        <?php
    }

}