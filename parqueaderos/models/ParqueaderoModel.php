<?php

$raiz =dirname(dirname(dirname(__file__)));
//   die('rutamodelsucursal '.$raiz);

require_once($raiz.'/conexion/Conexion.php');

class ParqueaderoModel extends Conexion
{

    public function traerParqueaderos()
    {
        $sql = "select * from parqueaderos  order by id desc";
        $query = $this->connectMysql()->prepare($sql); 
        $query -> execute(); 
        $results = $query -> fetchAll(PDO::FETCH_ASSOC); 
        $this->desconectar();

        // $consulta = mysql_query($sql,$this->connectMysql());
        // $parqueaderos = $this->get_table_assoc($consulta);
        return $results;
    }

    public function traerParqueaderoId($id)
    {
        $sql = "select * from parqueaderos where id = '".$id."'  ";
        $query = $this->connectMysql()->prepare($sql); 
        $query -> execute(); 
        $results = $query -> fetch(PDO::FETCH_ASSOC); 
        $this->desconectar();

        // $consulta = mysql_query($sql,$this->connectMysql());
        // $parqueadero = mysql_fetch_assoc($consulta);
        return $results;
    }


    public function grabarNuevoParqueadero($request)
    {
        // echo '<pre>'; 
        // print_r($request); 
        // echo '</pre>';
        // die();

        $sql = "insert into parqueaderos(nombre,direccion) values(:nombre,:direccion)";
        $query = $this->connectMysql()->prepare($sql); 
        $query->bindParam(':nombre',$request['nombreParqueadero'],PDO::PARAM_STR, 25);
        $query->bindParam(':direccion',$request['direccionParqueadero'],PDO::PARAM_STR, 25);
        $query->execute();
        $this->desconectar();




    }

}


?>