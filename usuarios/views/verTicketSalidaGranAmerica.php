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
require_once($raiz.'/recibosDeCaja/models/ReciboDeCajaModel.php'); 
require_once($raiz.'/formasDePago/models/FormaDePagoModel.php'); 
// die('paso11');
$parkingModel = new ParkingModel(); 
$empresaModel = new EmpresaModel(); 
$parqueaderoModel = new ParqueaderoModel(); 
$tipoVehiculoModel = new TipoVehiculoModel();
$reciboModel = new ReciboDeCajaModel();
$formaPagoModel = new FormaDePagoModel();

$infoParking = $parkingModel->traerInfoParkingIdParking($_REQUEST['idParking']); 
// echo 'assadsa<pre>'; 
// print_r($infoParking); 
// echo '</pre>';
// die(); 
$empresaInfo = $empresaModel->traerInfoEmpresa();
$infoParqueadero = $parqueaderoModel->traerParqueaderoId($infoParking['idParqueadero']);
$infoTipoVehiculo = $tipoVehiculoModel->traerTipoVehiculoId($infoParking['idTipoVehiculo']);
$infoRecibo = $reciboModel->traerReciboCajaId($infoParking['idReciboCaja']);
$infoFormaPago = $formaPagoModel->traerFormasDePagoId($infoRecibo['idFormaDePago']);
$fechaHoy = date("Y-m-d H:i:s");
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
        <?php  echo '<br>'.$infoParqueadero['direccion'] ?>
        <?php  echo '<br>'.$infoParqueadero['telefono'] ?>
        <BR><BR>
        <div>
            Fecha: <?php  echo $fechaHoy; ?>
        </div>
        <div>
            Factura Venta <?php echo $infoRecibo['norecibosalida']  ?>
        </div>
        <div> <?php echo $infoTipoVehiculo['descripcion'].'-'.$infoParking['placa']  ?>  </div>
        <div><?php echo 'Hora Ingreso: '.$infoParking['horaIngreso'];   ?></div>       
        <div><?php echo 'Hora Salida: '.$infoParking['horaSalida'];   ?></div>   
        <div><?php echo $infoRecibo['stringTiempoTotal'];   ?></div>    
        <div>===========================</div>       
        <div>
            <table>
                <tr>
                    <td>Total</td>
                    <td align="right">$<?php  echo number_format($infoRecibo['valor'],0,",",".")  ?></td>
                </tr>
                <tr>
                    <td >Total Pagado</td>
                    <td align="right">$<?php  echo number_format($infoRecibo['valorPagado'],0,",",".")  ?></td>
                </tr>
                <tr>
                    <td>Cambio</td>
                    <td align="right">$<?php  echo number_format($infoRecibo['cambio'],0,",",".")  ?></td>
                </tr>
                <tr>
                    <td>Forma de Pago</td>
                    <td align="right"><?php  echo $infoFormaPago['descripcion']  ?></td>
                </tr>
                <tr>
                    <td>Valor</td>
                    <td align="right">$<?php  echo number_format($infoRecibo['valor'],0,",",".")  ?></td>
                </tr>
            </table>
        </div>
        <br><br>
        <div class="row">
            <div class="col-lg-2">
                <!-- INFORMACION IMPORTANTE<br>
                El vehiculo solo se entregara a la persona <br>
                que tenga este recibo.<br>
                En caso de perdida se solicitara la <br>
                confirmacion mediante algun medio fisico o <br>
                electronico de la propiedad o tenencia <br>
                del vehiculo, y tendra un costo adicional <br>
                de $10.000 pesos,Se recomienda no dejar <br>
                objetos de valor dentro de los vehiculos <br>
                o informar de ellos. <br>
                Regimen Simplificado no responsable de iva <br>
                Horario de domingo a domingo 6:00 AM A 6:00 PM<br> -->
                INFORMACION ASOCIADA AL PARQUEADERO<BR> 
                COMPAÑIA MUNDIAL DE SEGUROS  S.A.<BR>
                POLIZA No CSC-250003026 VIGENCIA 07/05/2023 AL 07/05/2024 <br>
                Para alguna reclamacion con la compañia de seguros comuniquese en bogota 
                (601) 3274712- (601)3274713.


            </div>
            
        
        </div>

    </div>
</body>
</html>