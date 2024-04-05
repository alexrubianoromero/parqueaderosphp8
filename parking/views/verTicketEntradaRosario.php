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
        NIT: <?php  echo $infoParqueadero['nit'] ?>
        <br>
        <?php  echo '<br>'.$infoParqueadero['direccion'] ?>
        <?php  echo '<br>'.$infoParqueadero['email'] ?>
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
        <BR>
        <div>
            <!-- INFORMACION ASOCIADA AL PARQUEADERO<BR>
            *EL VEHICULO SE ENTREGARA AL PORTADOR DE ESTE RECIBO *EN CASO DE PERDIDA DEL RECIBO SE DEBE VERIFICAR 
            LA TITULARIDAD DEL MISMO CON LA TARJETA DE PROPIEDAD Y SE DEBE CANCELAR UN COSTO DE $10.000 ADICIONAL. *NO SE RESPONDE POR OBJETOS 
            DEJADOS EN EL VEHICULO QUE NO SEAN DECLARADOS ANTES DEL INGRESO.<BR>
     
            HORARIOS LUNES A VIERNES <BR> 6:00 AM - 7:00 PM<BR> 
            SABADOS <BR>
            6:00 AM - 3:00 PM    -->
            INVERSIONES CRECIENTE SAS NIT.900.988.979-1 <BR>
                RESOLUCION FACTURACION POS 13028091830225DESDE LA 2001 A LA 50000<BR>
                INFORMACION ASOCIADA AL PARQUEADERO RECIBO<BR>
                *EL VEHICULO SE ENTREGARA AL PORTADO DE ESTE RECIBO<BR>
                EN CASO DE PERDIDA DEL RECIBO SE DEBE VERIFICAR LA TITULARIDAD DEL MISMO  CON LA TARJETA DE PROPIEDAD Y SE DEBE CANCELAR UN COSTO DE 10.000 ADICIONAL<BR>
                NO SE RESPONDE POR OBJETOS DEJADOS EN EL VEHICULO SIN ANTES DE INFORMAR AL INGRESO<BR>
                *REGIMEN COMUN RESPONSABLE DE IVA<BR>
                COMPAÑIA MUNDIAL DE SEGUROS  S.A.<BR>
                POLIZA No CSC-250006148 VIGENCIA 02/02/2024 AL 02/02/2025 <br>
                PARA ALGUNA RECLAMACION CON LA COMPAÑIA DE SEGUROS COMUNIQUESE EN BOGOTA 
                (601) 3274712- (601)3274713.
                HORARIO DE DOMINGO A DOMINGO DE 6 AM A 6PM.   
        </div>      

    </div>
</body>
</html>