<?php

$raiz =dirname(dirname(dirname(__file__)));
//   die('rutamodelsucursal '.$raiz);

require_once($raiz.'/conexion/Conexion.php');

class TarifaModel extends Conexion
{

    public function traerTarifas()
    {
        $sql = "select * from tarifas ";
        $consulta = mysql_query($sql,$this->connectMysql());
        $data = $this->get_table_assoc($consulta);
        return $data;
    }

    public function traerTarifaId($id)
    {
        $sql = "select * from tarifas where id = '".$id."'  ";
        // die($sql);
        $consulta = mysql_query($sql,$this->connectMysql());
        $data = mysql_fetch_assoc($consulta);
        return $data;
    }
    public function traerTarifaIdParqueadero($idParqueadero)
    {
        $sql = "select * from tarifas where idParqueadero = '".$idParqueadero."'  ";
        $consulta = mysql_query($sql,$this->connectMysql());
        $data = $this->get_table_assoc($consulta);
        return $data;
    }
    
    public function traerTarifaIdParqIdTipVehi($idParqueadero,$idTipoVeh)
    {
        $sql = "select * from tarifas 
            where idParqueadero = '".$idParqueadero."'
            and idTipoVehiculo = '".$idTipoVeh."'
            ";
        $consulta = mysql_query($sql,$this->connectMysql());
        $data = $this->get_table_assoc($consulta);
        return $data;
    }


    public function grabarNuevaTarifa($request)
    {
        $sql = "insert into tarifas  (idParqueadero,idTipoVehiculo,valorMinuto,idTipoTarifa,descripcion)    
            values ('".$request['idParqueadero']."','".$request['idTipoVehiculo']."'
            ,'".$request['valorMinuto']."','".$request['idTipoTarifa']."','".$request['descripcion']."'
            ) ";
            // die($sql);
        $consulta = mysql_query($sql,$this->connectMysql());
        // $clientes = $this->get_table_assoc($consulta);
        // return $clientes;
    }
}