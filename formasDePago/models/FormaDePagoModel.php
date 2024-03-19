<?php

$raiz =dirname(dirname(dirname(__file__)));
//   die('rutamodelsucursal '.$raiz);

require_once($raiz.'/conexion/Conexion.php');

class FormaDePagoModel extends Conexion
{

    public function traerFormasDePago()
    {
        $sql = "select * from formasdepago";
        $query = $this->connectMysql()->prepare($sql); 
        $query -> execute(); 
        $results = $query -> fetchAll(PDO::FETCH_ASSOC); 
        $this->desconectar();
        return $results;
        // die($sql); 
        // $consulta = mysql_query($sql,$this->connectMysql());
        // $data = $this->get_table_assoc($consulta);
        return $results;
    }
    public function traerFormasDePagoId($id)
    {
        $sql = "select * from formasdepago where id = '".$id."'  ";
        $query = $this->connectMysql()->prepare($sql); 
        $query -> execute(); 
        $results = $query -> fetch(PDO::FETCH_ASSOC); 
        $this->desconectar();
        // die($sql);
        // $consulta = mysql_query($sql,$this->connectMysql());
        // $data = mysql_fetch_assoc($consulta);
        return $results;
    }


}
