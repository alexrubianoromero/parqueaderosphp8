<?php

$raiz =dirname(dirname(dirname(__file__)));
//   die('rutamodelsucursal '.$raiz);

require_once($raiz.'/conexion/Conexion.php');

class FormaDePagoModel extends Conexion
{

    public function traerFormasDePago()
    {
        $sql = "select * from formasDePago";
        die($sql); 
        $consulta = mysql_query($sql,$this->connectMysql());
        $data = $this->get_table_assoc($consulta);
        return $data;
    }
    public function traerFormasDePagoId($id)
    {
        $sql = "select * from formasDePago where id = '".$id."'  ";
        // die($sql);
        $consulta = mysql_query($sql,$this->connectMysql());
        $data = mysql_fetch_assoc($consulta);
        return $data;
    }


}
