<?php

$raiz =dirname(dirname(dirname(__file__)));
//   die('rutamodelsucursal '.$raiz);

require_once($raiz.'/conexion/Conexion.php');

class EmpresaModel extends Conexion
{

    public function traerInfoEmpresa()
    {
        $sql = "select * from empresa ";
        $query = $this->connectMysql()->prepare($sql); 
        $query -> execute(); 
        $results = $query -> fetch(PDO::FETCH_ASSOC); 
        $this->desconectar();

        // $consulta = mysql_query($sql,$this->connectMysql());
        // $parqueaderos = $this->get_table_assoc($consulta);
        return $results;
    }


}


?>