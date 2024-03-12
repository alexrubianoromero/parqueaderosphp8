<?php

$raiz =dirname(dirname(dirname(__file__)));
//   die('rutamodelsucursal '.$raiz);

require_once($raiz.'/conexion/Conexion.php');

class EstadoParkingModel extends Conexion
{

    public function traerEstadosParking()
    {
        $sql = "select * from estadosParking  ";
        $consulta = mysql_query($sql,$this->connectMysql());
        $data = $this->get_table_assoc($consulta);
        return $data;
    }
    public function traerEstadosParkingId($id)
    {
        $sql = "select * from estadosParking where id='".$id."' ";
        // die($sql);
        $consulta = mysql_query($sql,$this->connectMysql());
        $data = mysql_fetch_assoc($consulta);
        return $data;
    }


  
}