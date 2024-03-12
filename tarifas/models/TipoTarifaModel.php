<?php

$raiz =dirname(dirname(dirname(__file__)));
//   die('rutamodelsucursal '.$raiz);

require_once($raiz.'/conexion/Conexion.php');

class TipoTarifaModel extends Conexion
{

    public function traerTiposTarifa()
    {
        $sql = "select * from tiposTarifa ";
        $consulta = mysql_query($sql,$this->connectMysql());
        $data = $this->get_table_assoc($consulta);
        return $data;
    }

    public function traerTipoTarifaId($id)
    {
        $sql = "select * from tiposTarifa where id = '".$id."'  ";
        $consulta = mysql_query($sql,$this->connectMysql());
        $data = mysql_fetch_assoc($consulta);
        return $data;
    }
}