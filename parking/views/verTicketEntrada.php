<?php
session_start();
// echo '<pre>'; 
// print_r($_SESSION); 
// echo '</pre>';

// echo '<pre>'; 
// print_r($_REQUEST); 
// echo '</pre>';
// echo $raiz;

$raiz =dirname(dirname(dirname(__file__)));
require_once($raiz.'/parking/models/ParkingModel.php');
require_once($raiz.'/empresa/models/EmpresaModel.php');
require_once($raiz.'/parqueaderos/models/ParqueaderoModel.php');
require_once($raiz.'/parqueaderos/models/TipoVehiculoModel.php'); 
// require_once($raiz.'/recibosDeCaja/models/ReciboDeCajaModel.php'); 
// require_once($raiz.'/formasDepago/models/FormaDePagoModel.php'); 

$parkingModel = new ParkingModel(); 
$empresaModel = new EmpresaModel(); 
$parqueaderoModel = new ParqueaderoModel(); 
$tipoVehiculoModel = new TipoVehiculoModel();
// $reciboModel = new ReciboDeCajaModel();
// $formaPagoModel = new FormaDePagoModel();

$infoParking = $parkingModel->traerInfoParkingIdParking($_REQUEST['idParking']); 
$empresaInfo = $empresaModel->traerInfoEmpresa();
$infoParqueadero = $parqueaderoModel->traerParqueaderoId($_SESSION['idSucursal']);
$infoTipoVehiculo = $tipoVehiculoModel->traerTipoVehiculoId($infoParking['idTipoVehiculo']);
// $infoRecibo = $reciboModel->traerReciboCajaId($infoParking['idReciboCaja']);
// $infoFormaPago = $formaPagoModel->traerFormasDePagoId($infoRecibo['idFormaDePago']);
$fechaHoy = date("Y-m-d H:i:s");
// echo 'assadsa<pre>'; 
// print_r($infoParking); 
// echo '</pre>';
// die(); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="">

        <h3>CRECIENTE PARKING</h3>
        NIT: <?php  echo $empresaInfo['nit'] ?>
        <br>
        <?php  echo '<br>'.$infoParqueadero['direccion'] ?>
        <?php  echo '<br>'.$empresaInfo['telefono'] ?>
        <div>
            Fecha: <?php  echo $fechaHoy; ?>
        </div>
        <div>
            Recibo <?php echo $infoParking['noreciboingreso']  ?>
        </div>
        <div>===========================</div>       
        <div>
            <table>
                <tr>
                    <td>Placa:</td>
                    <td align="right"><?php echo $infoParking['placa'] ?></td>
                </tr>
                <tr>
                    <td>Tipo Vehiculo:</td>
                    <td align="right"><?php echo $infoTipoVehiculo['descripcion'] ?></td>
                </tr>
                <tr>
                    <td>Fecha Ingreso: </td>
                    <td align="right"><?php echo  $infoParking['horaIngreso']; ?></td>
                </tr>
            </table>
        </div>       

    </div>
</body>
</html>