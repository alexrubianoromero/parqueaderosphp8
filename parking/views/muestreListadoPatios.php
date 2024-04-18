<?php
session_start();
// $hoy = date("Y-m-d H:i:s"); 
$hoy = date("Y-m-d H:i:s"); 
// echo '<pre>';
// print_r($_SESSION);
// echo '</pre>';

$raiz = dirname(dirname(dirname(__file__)));
// require_once($raiz.'/parking/views/parkingView.php'); 
require_once($raiz.'/parking/models/ParkingModel.php'); 


$parkingModel = new ParkingModel();


$parking = $parkingModel->traerVehiculosParking();
// echo '<pre>';
// print_r($parking);
// echo '</pre>';
// die();

    // die('aqui llego ');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<div>

    <h3>VEHICULOS EN PATIO </h3>

    <div class="row" style="font-size:12px;">
    <strong>Fecha:<?php echo  $hoy ?></strong><br>
        <table class="table table-striped mt-3">
            <thead>
                <tr>
                    <th>Placa</th>
                    <th>Tipo Vehiculo</th>
                    <th>Hora Ingreso</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    require_once($raiz.'/parqueaderos/models/TipoVehiculoModel.php'); 
                    // require_once($raiz.'/parking/models/EstadoParkingModel.php'); 
                    $tipoVehiculoModel = new TipoVehiculoModel();
                    
                    foreach($parking as $park)
                    {
                        $infoTipo = $tipoVehiculoModel->traerTipoVehiculoId($park['idTipoVehiculo']); 
                        echo '<tr>';  
                        echo '<th>'.$park['placa'].'</th>'; 
                        echo '<th align="center">'.$infoTipo['descripcion'].'</th>'; 
                        echo '<th>'.substr($park['horaIngreso'],11,8).'</th>'; 
                        echo '</tr>';  
                    }  
                    ?>
                </tbody>
            </table>
        </div>
        
</div>    
</body>
</html>

