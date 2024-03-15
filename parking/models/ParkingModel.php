<?php

$raiz =dirname(dirname(dirname(__file__)));
//   die('rutamodelsucursal '.$raiz);

require_once($raiz.'/conexion/Conexion.php');
require_once($raiz.'/recibosDeCaja/models/ReciboDeCajaModel.php');

class ParkingModel extends Conexion
{
    protected $reciboModel; 

    public function __construct()
    {
        $this->reciboModel = new ReciboDeCajaModel(); 
    }

    public function traerVehiculosParking()
    {
        $sql = "select * from parking where estado = 0 and idParqueadero = '".$_SESSION['idSucursal']."'   ";
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
        $filas = $this->verificarPlacaEstadoCeroParking($request['placa']);
        if($filas==0)
        {
            $sql = "insert into parking  (idTipoVehiculo,placa,idTarifa,idParqueadero,usuarioIngreso)  
            values(:idTipoVehiculo,:placa,:idTarifa,:idParqueadero,:usuarioIngreso)";
            $query = $this->connectMysql()->prepare($sql); 
            $query->bindParam(':idTipoVehiculo',$request['idTipoVehiculo'],PDO::PARAM_STR, 25);
            $query->bindParam(':placa',$request['placa'],PDO::PARAM_STR, 25);
            $query->bindParam(':idTarifa',$request['idTarifa'],PDO::PARAM_STR, 25);
            $query->bindParam(':idParqueadero',$_SESSION['idSucursal'],PDO::PARAM_STR, 25);
            $query->bindParam(':usuarioIngreso',$_SESSION['id_usuario'],PDO::PARAM_STR, 25);
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
        where id = '".$id."' 
        and estado = 0 ";
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