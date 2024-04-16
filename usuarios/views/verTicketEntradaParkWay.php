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

        <h3>RAMIREZ PARKING</h3>
        NIT: <?php  echo $infoParqueadero['nit'] ?>
        <br>
        <?php  echo '<br>'.$infoParqueadero['direccion'] ?>
        <?php  echo '<br>'.$infoParqueadero['telefono'] ?>
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
        <div>
            COMPANIA MUNDIAL DE SEGUROS S.A.<BR>
            POLIZA No CSC-250003026 VIGENCIA 07/05/2021 AL 07/05/2022
            INFORMACION ASOCIADA AL PARQUEADERO<BR>
            *EL VEHICULO SE ENTREGARA AL PORTADOR DE ESTE RECIBO *EN CASO DE PERDIDA DEL RECIBO SE DEBE VERIFICAR 
            LA TITULARIDAD DEL MISMO Y SE DEBE CANCELAR UN COSTO DE $10.000 ADICIONAL. *NO SE RESPONDE POR OBJETOS 
            DEJADOS EN EL VEHICULO QUE NO SEAN DECLARADOS ANTES DEL INGRESO.<BR>
            *REGIMEN SIMPLIFICADO NO RESPONSABLE DE IVA<BR>
            HORARIOS LUNES A VIERNES <BR> 6:00 AM - 7:00 PM<BR> 
            SABADOS <BR>
            6:00 AM - 3:00 PM   
        </div>      

    </div>
</body>
</html>