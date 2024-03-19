<?php

$raiz =dirname(dirname(dirname(__file__)));
//   die('rutamodelsucursal '.$raiz);

require_once($raiz.'/conexion/Conexion.php');

class TipoVehiculoModel extends Conexion
{

    public function traerTiposVehiculos()
    {
        $sql = "select * from tiposvehiculo ";
        $query = $this->connectMysql()->prepare($sql); 
        $query -> execute(); 
        $results = $query -> fetchAll(PDO::FETCH_ASSOC); 
        $this->desconectar();
        // $consulta = mysql_query($sql,$this->connectMysql());
        // $data = $this->get_table_assoc($consulta);
        return $results;
    }

    public function traerTipoVehiculoId($id)
    {
        $sql = "select * from tiposvehiculo where id = '".$id."'  ";
        // die($sql ); 
        $query = $this->connectMysql()->prepare($sql); 
        $query -> execute(); 
        $results = $query -> fetch(PDO::FETCH_ASSOC); 
        $this->desconectar();

        // $consulta = mysql_query($sql,$this->connectMysql());
        // $data = mysql_fetch_assoc($consulta);
        return $results;
    }
}