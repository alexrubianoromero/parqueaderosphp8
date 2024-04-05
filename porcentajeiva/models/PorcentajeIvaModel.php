<?php

date_default_timezone_set('America/Bogota');
$raiz =dirname(dirname(dirname(__file__)));
//   die('rutamodelsucursal '.$raiz);

require_once($raiz.'/conexion/Conexion.php');
// require_once($raiz.'/recibosDeCaja/models/ReciboDeCajaModel.php');
// require_once($raiz.'/parqueaderos/models/ParqueaderoModel.php');

class PorcentajeIvaModel extends Conexion
{
    // protected $reciboModel; 
    // protected $parqueaderoModel; 

    public function __construct()
    {
        // $this->reciboModel = new ReciboDeCajaModel(); 
        // $this->parqueaderoModel = new ParqueaderoModel(); 
    }

    public function traerPorcentajeIva()
    {
        $sql = "select porcentajeiva from porcentajeiva"; 
        $query = $this->connectMysql()->prepare($sql); 
        $query -> execute(); 
        $results = $query -> fetch(PDO::FETCH_ASSOC); 
        $this->desconectar();
        return $results;
        // $consulta = mysql_query($sql,$this->connectMysql());
        // $parking = mysql_fetch_assoc($consulta);
        // return $parking; 
    }

}


?>

