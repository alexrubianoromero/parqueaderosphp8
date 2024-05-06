<?php

$raiz =dirname(dirname(dirname(__file__)));
//   die('rutamodelsucursal '.$raiz);

require_once($raiz.'/conexion/Conexion.php');

class ParqueaderoModel extends Conexion
{

    public function traerParqueaderos()
    {
        $sql = "select * from parqueaderos  order by id asc";
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


    // public function grabarNuevoParqueadero($request)
    // {
    //     $sql = "insert into parqueaderos(nombre,direccion,telefono,email,manejaiva) values(:nombre,:direccion,:telefono,:email,:manejaiva)";
    //     $query = $this->connectMysql()->prepare($sql); 
    //     $query->bindParam(':nombre',$request['nombreParqueadero'],PDO::PARAM_STR, 25);
    //     $query->bindParam(':direccion',$request['direccionParqueadero'],PDO::PARAM_STR, 25);
    //     $query->bindParam(':telefono',$request['telefonoParqueadero'],PDO::PARAM_STR, 25);
    //     $query->bindParam(':email',$request['emailParqueadero'],PDO::PARAM_STR, 25);
    //     $query->bindParam(':manejaiva',$request['manejaiva'],PDO::PARAM_STR, 25);
    //     $query->execute();
    //     $this->desconectar();
    // }


    public function grabarNuevoParqueadero($request)
    {
        // echo '<pre>'; 
        // print_r($request); 
        // echo '</pre>';
        // die();
        $sql = "insert into parqueaderos(nombre,direccion,telefono,email,manejaiva,archivoTicketEntrada,archivoTicketSalida) 
        values('".$request['nombreParqueadero']."','".$request['direccionParqueadero']."','".$request['telefonoParqueadero']."',
        '".$request['emailParqueadero']."','".$request['manejaiva']."','verTicketEntradagenerico.php','verTicketSalidagenerico.php')";
        $query = $this->connectMysql()->prepare($sql); 
        $query->execute();
        $this->desconectar();
    }

    public function actualizarNoReciboIngreso($idPaqueadero,$norecibo)
    {
        // $consulta = mysql_query($sql,$this->connectMysql());
        $sql = "update parqueaderos set noreciboingreso = :norecibo  where id = '".$idPaqueadero."'   "; 
        $query = $this->connectMysql()->prepare($sql); 
        $query->bindParam(':norecibo',$norecibo,PDO::PARAM_STR, 25);
        $query->execute();
        $this->desconectar();
    }
    public function actualizarReciboSalida($idPaqueadero,$norecibo)
    {
        // $consulta = mysql_query($sql,$this->connectMysql());
        $sql = "update parqueaderos set norecibosalida = :norecibosalida  where id = '".$idPaqueadero."'   "; 
        // die($sql);
        $query = $this->connectMysql()->prepare($sql); 
        $query->bindParam(':norecibosalida',$norecibo,PDO::PARAM_STR, 25);
        $query->execute();
        $this->desconectar();
    }



}


?>