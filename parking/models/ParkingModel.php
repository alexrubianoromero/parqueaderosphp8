<?php

$raiz =dirname(dirname(dirname(__file__)));
//   die('rutamodelsucursal '.$raiz);

require_once($raiz.'/conexion/Conexion.php');

class ParkingModel extends Conexion
{

    public function traerVehiculosParking()
    {
        $sql = "select * from parking where estado = 0 and idParqueadero = '".$_SESSION['idSucursal']."'   ";
        $consulta = mysql_query($sql,$this->connectMysql());
        $data = $this->get_table_assoc($consulta);
        return $data;
    }
    public function traerVehiculosParkingGerencial($idParqueadero)
    {
        $sql = "select * from parking where estado = 0 and idParqueadero = '".$idParqueadero."'   ";
        $consulta = mysql_query($sql,$this->connectMysql());
        $data = $this->get_table_assoc($consulta);
        return $data;
    }

    public function traerHistorialVehiculosParking()
    {
        $sql = "select * from parking where estado > 0 and idParqueadero = '".$_SESSION['idSucursal']."'   ";
        $consulta = mysql_query($sql,$this->connectMysql());
        $data = $this->get_table_assoc($consulta);
        return $data;
    }

    public function buscarPlacaVehiculosParking($placa)
    {
        $sql = "select * from parking where placa like '%".$placa."%' ";
        $consulta = mysql_query($sql,$this->connectMysql());
        $data = $this->get_table_assoc($consulta);
        return $data;
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
            $sql = "insert into parking  (idTipoVehiculo,placa
            ,horaIngreso,idTarifa,idParqueadero)    
            values ('".$request['idTipoVehiculo']."','".$request['placa']."'
            ,now(),'".$request['idTarifa']."','".$_SESSION['idSucursal']."'
            ) ";
            $consulta = mysql_query($sql,$this->connectMysql());
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
        $consulta = mysql_query($sql,$this->connectMysql());
        $filas = mysql_num_rows($consulta);
        // die('el valor de filas '.$filas); 
        return $filas;  
    }

    public function traerInfoParkingPlaca($placa)
    {
        $sql = "select * from parking  
        where placa = '".$placa."' 
        and estado = 0 ";
        $consulta = mysql_query($sql,$this->connectMysql());
        $placa = mysql_fetch_assoc($consulta);
        return $placa; 
    }
    public function traerInfoParkingIdParking($id)
    {
        $sql = "select * from parking  
        where id = '".$id."' 
        and estado = 0 ";
        $consulta = mysql_query($sql,$this->connectMysql());
        $parking = mysql_fetch_assoc($consulta);
        return $parking; 
    }


    public function cambiarEstadoParking($idParking,$estado)
    {
        $sql = "update parking 
        set estado = '".$estado."' 
        where  id = '".$idParking."'
        ";
        $consulta = mysql_query($sql,$this->connectMysql());
    }


    public function actualizarReciboCajaParking($idParking,$idRecibo)
    {
        $sql = "update parking 
        set idReciboCaja = '".$idRecibo."' 
        where  id = '".$idParking."'
        ";
        $consulta = mysql_query($sql,$this->connectMysql());
    }

   

  
}