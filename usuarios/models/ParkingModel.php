<?php
date_default_timezone_set('America/Bogota');
$raiz =dirname(dirname(dirname(__file__)));
//   die('rutamodelsucursal '.$raiz);

require_once($raiz.'/conexion/Conexion.php');
require_once($raiz.'/recibosDeCaja/models/ReciboDeCajaModel.php');
require_once($raiz.'/parqueaderos/models/ParqueaderoModel.php');

class ParkingModel extends Conexion
{
    protected $reciboModel; 
    protected $parqueaderoModel; 

    public function __construct()
    {
        $this->reciboModel = new ReciboDeCajaModel(); 
        $this->parqueaderoModel = new ParqueaderoModel(); 
    }

    public function traerVehiculosParking()
    {
        $sql = "select * from parking where estado = 0 and idParqueadero = '".$_SESSION['idSucursal']."' order by id desc  ";
        $query = $this->connectMysql()->prepare($sql); 
        $query -> execute(); 
        $results = $query -> fetchAll(PDO::FETCH_ASSOC); 
        $this->desconectar();
        return $results;
    }


    public function traerVehiculosParkingGerencial($idParqueadero)
    {
        $sql = "select * from parking where estado = 0 and idParqueadero = '".$idParqueadero."' order by idTipoVehiculo  ";
        $query = $this->connectMysql()->prepare($sql); 
        $query -> execute(); 
        $results = $query -> fetchAll(PDO::FETCH_ASSOC); 
        $this->desconectar();
        return $results;
    }


    public function traerHistorialVehiculosParking()
    {
        $sql = "select * from parking where estado > 0 and idParqueadero = '".$_SESSION['idSucursal']."'   ";
        $query = $this->connectMysql()->prepare($sql); 
        $query -> execute(); 
        $results = $query -> fetchAll(PDO::FETCH_ASSOC); 
        $this->desconectar();
        return $results;
    }

    public function traerHistorialVehiculosParkingRangoFechas($fechaIn,$fechaFin)
    {
        $sql = "select * from parking 
                where 1=1 
                and estado > 0 
                and idParqueadero = '".$_SESSION['idSucursal']."'   
                and horaSalida >= '".$fechaIn."'
                and horaSalida <=  '".$fechaFin."'
                ";

                // die($sql); 
        $query = $this->connectMysql()->prepare($sql); 
        $query -> execute(); 
        $results = $query -> fetchAll(PDO::FETCH_ASSOC); 
        $this->desconectar();
        return $results;
    }

    public function buscarPlacaVehiculosParking($placa)
    {
        $sql = "select * from parking where placa like '%".$placa."%' and estado = 0 and idparqueadero = '".$_SESSION['idSucursal']."'  ";
        $query = $this->connectMysql()->prepare($sql); 
        $query -> execute(); 
        $results = $query -> fetchAll(PDO::FETCH_ASSOC); 
        $this->desconectar();
        return $results;
    }

    /*
    //output errores
    // 0 se realizo el registro
    // 1 No se realizo el registro porque ya estaba registrada la placa
    */
    public function grabarVehiculoParking($request)
    {
        $hoy = date("Y-m-d H:i:s");   
        //  die('desde edl model '.$hoy); 
        $infoParqueadero = $this->parqueaderoModel->traerParqueaderoId($_SESSION['idSucursal']);
        $noRecibo = $infoParqueadero['noreciboingreso']+1;
        $this->parqueaderoModel->actualizarNoReciboIngreso($_SESSION['idSucursal'],$noRecibo); 

        $filas = $this->verificarPlacaEstadoCeroParking($request['placa']);
        if($filas==0)
        {
            $sql = "insert into parking  (idTipoVehiculo,placa,idTarifa,idParqueadero,usuarioIngreso,noreciboingreso,horaIngreso)  
            values(:idTipoVehiculo,:placa,:idTarifa,:idParqueadero,:usuarioIngreso,:noreciboingreso,:horaIngreso)";
            // die($sql);
            $query = $this->connectMysql()->prepare($sql); 
            $query->bindParam(':idTipoVehiculo',$request['idTipoVehiculo'],PDO::PARAM_STR, 25);
            $query->bindParam(':placa',strtoupper($request['placa']),PDO::PARAM_STR, 25);
            $query->bindParam(':idTarifa',$request['idTarifa'],PDO::PARAM_STR, 25);
            $query->bindParam(':idParqueadero',$_SESSION['idSucursal'],PDO::PARAM_STR, 25);
            $query->bindParam(':usuarioIngreso',$_SESSION['id_usuario'],PDO::PARAM_STR, 25);
            $query->bindParam(':noreciboingreso',$noRecibo,PDO::PARAM_STR, 25);
            $query->bindParam(':horaIngreso',$hoy,PDO::PARAM_STR, 25);
            $query->execute();
            $this->desconectar();
            return 0;
        }else{
            return 1;
        }
}
    
    public function verificarPlacaEstadoCeroParking($placa)
    {
        $sql = "select * from parking  
        where placa = '".$placa."' 
        and estado = 0 ";
        $query = $this->connectMysql()->prepare($sql); 
        $query -> execute(); 
        $results = $query -> fetch(PDO::FETCH_ASSOC); 
        $this->desconectar();
        $filas = $query->rowCount();
        return $filas;
    }

    public function traerInfoParkingPlaca($placa)
    {
        $sql = "select * from parking  
        where placa = '".$placa."' 
        and estado = 0 ";
        $query = $this->connectMysql()->prepare($sql); 
        $query -> execute(); 
        $results = $query -> fetch(PDO::FETCH_ASSOC); 
        $this->desconectar();
        return $results;
        // $consulta = mysql_query($sql,$this->connectMysql());
        // $placa = mysql_fetch_assoc($consulta);
        // return $placa; 
    }
    public function traerInfoParkingIdParking($id)
    {
        $sql = "select * from parking  
        where id = '".$id."'";
        $query = $this->connectMysql()->prepare($sql); 
        $query -> execute(); 
        $results = $query -> fetch(PDO::FETCH_ASSOC); 
        $this->desconectar();
        return $results;
        // $consulta = mysql_query($sql,$this->connectMysql());
        // $parking = mysql_fetch_assoc($consulta);
        // return $parking; 
    }


    public function cambiarEstadoParking($idParking,$estado)
    {
        $sql = "update parking 
        set estado = '".$estado."' 
        where  id = '".$idParking."'
        ";
        $query = $this->connectMysql()->prepare($sql); 
        $query -> execute(); 
        $this->desconectar();
        // $consulta = mysql_query($sql,$this->connectMysql());
    }

    public function cambiarPlacaParking($request)
    {
        $sql = "update parking 
        set placa = '".$request['placa']."' 
        where  id = '".$request['idParking']."'
        ";
        $query = $this->connectMysql()->prepare($sql); 
        $query -> execute(); 
        $this->desconectar();
        // $consulta = mysql_query($sql,$this->connectMysql());
    }


    public function actualizarReciboCajaParking($idParking,$idRecibo)
    {
        $sql = "update parking 
        set idReciboCaja = '".$idRecibo."' 
        where  id = '".$idParking."'
        ";
        $query = $this->connectMysql()->prepare($sql); 
        $query -> execute(); 
        $this->desconectar();
        // $consulta = mysql_query($sql,$this->connectMysql());
    }


    //esta funcion actualiza la hora de salida de parking con base 
    //en la hora del recibode caja 
    public function actualizarHoraSalidaUsuarioSalidaParking($idParking,$idRecibo)
    {
        $infoRecibo =  $this->reciboModel->traerReciboCajaId($idRecibo);
        $sql = "update parking 
        set horaSalida = '".$infoRecibo['fecha']."', 
            usuarioSalida = '".$infoRecibo['usuario']."' 
        where  id = '".$idParking."'
        ";
        $query = $this->connectMysql()->prepare($sql); 
        $query -> execute(); 
        $this->desconectar();
        // $consulta = mysql_query($sql,$this->connectMysql());
    }

   

  
}