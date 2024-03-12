<?php

$raiz =dirname(dirname(dirname(__file__)));
//   die('rutamodelsucursal '.$raiz);

require_once($raiz.'/conexion/Conexion.php');

class TipoVehiculoModel extends Conexion
{

    public function traerTiposVehiculos()
    {
        $sql = "select * from tiposVehiculo ";
        $consulta = mysql_query($sql,$this->connectMysql());
        $data = $this->get_table_assoc($consulta);
        return $data;
    }

    public function traerTipoVehiculoId($id)
    {
        $sql = "select * from tiposVehiculo where id = '".$id."'  ";
        $consulta = mysql_query($sql,$this->connectMysql());
        $data = mysql_fetch_assoc($consulta);
        return $data;
    }
}