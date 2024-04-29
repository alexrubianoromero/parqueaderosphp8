<?php
date_default_timezone_set('America/Bogota');
$raiz =dirname(dirname(dirname(__file__)));
//   die('rutamodelsucursal '.$raiz);

require_once($raiz.'/conexion/Conexion.php');
// require_once($raiz.'/recibosDeCaja/models/ReciboDeCajaModel.php');
// require_once($raiz.'/parqueaderos/models/ParqueaderoModel.php');

class TrazabilidadCambioModel extends Conexion
{
    // protected $reciboModel; 
    // protected $parqueaderoModel; 

    public function __construct()
    {
        // $this->reciboModel = new ReciboDeCajaModel(); 
        // $this->parqueaderoModel = new ParqueaderoModel(); 
    }

    /**
     * inputs
     * observaciones idParking 
     */
    public function grabarTrazabilidad($request)
    {
        $hoy = date("Y-m-d H:i:s");   
            $sql = "insert into trazabilidadCambios  (idUsuario,fecha,observaciones,idParking)  
            values(:idUsuario,:fecha,:observaciones,:idParking)";
            // die($sql);
            $query = $this->connectMysql()->prepare($sql); 
            $query->bindParam(':idUsuario',$_SESSION['id_usuario'],PDO::PARAM_STR, 25);
            $query->bindParam(':fecha',$hoy,PDO::PARAM_STR, 25);
            $query->bindParam(':observaciones',$request['observaciones'],PDO::PARAM_STR, 25);
            $query->bindParam(':idParking',$request['idParking'],PDO::PARAM_STR, 25);
            $query->execute();
            $this->desconectar();
    }


    public function traerInfoTrazabilidad()
    {
        $sql = "select * from  trazabilidadCambios order by fecha desc"; 
        $query = $this->connectMysql()->prepare($sql); 
        $query -> execute(); 
        $results = $query -> fetchAll(PDO::FETCH_ASSOC); 
        $this->desconectar();
        return $results;
    }
    
    
}