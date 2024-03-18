<?php

$raiz =dirname(dirname(dirname(__file__)));
//   die('rutamodelsucursal '.$raiz);

require_once($raiz.'/conexion/Conexion.php');

class TipoTarifaModel extends Conexion
{

    public function traerTiposTarifa()
    {
        $sql = "select * from tipostarifa ";
        $query = $this->connectMysql()->prepare($sql); 
        $query -> execute(); 
        $results = $query -> fetchAll(PDO::FETCH_ASSOC); 
        $this->desconectar();
        return $results;
        // $consulta = mysql_query($sql,$this->connectMysql());
        // $data = $this->get_table_assoc($consulta);
        // return $data;
    }

    public function traerTipoTarifaId($id)
    {
        $sql = "select * from tipostarifa where id = '".$id."'  ";
        $query = $this->connectMysql()->prepare($sql); 
        $query -> execute(); 
        $results = $query -> fetch(PDO::FETCH_ASSOC); 
        $this->desconectar();
        return $results;
    }
}