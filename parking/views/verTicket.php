<?php
echo '<pre>'; 
print_r($_REQUEST); 
echo '</pre>';
$raiz =dirname(dirname(dirname(__file__)));
echo $raiz;
require_once($raiz.'/parking/models/ParkingModel.php');
$parkingModel = new ParkingModel(); 
$infoParking = $parkingModel->traerInfoParkingIdParking($_REQUEST['idParking']); 
echo '<pre>'; 
print_r($infoParking); 
echo '</pre>';
die(); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h3>CRECIENTE PARKING</h3>

</body>
</html>