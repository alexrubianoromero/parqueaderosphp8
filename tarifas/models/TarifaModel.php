<?php

$raiz =dirname(dirname(dirname(__file__)));
//   die('rutamodelsucursal '.$raiz);

require_once($raiz.'/conexion/Conexion.php');

class TarifaModel extends Conexion
{

    public function traerTarifas()
    {
        $sql = "select * from tarifas order by id desc";
        $query = $this->connectMysql()->prepare($sql); 
        $query -> execute(); 
        $results = $query -> fetchAll(PDO::FETCH_ASSOC); 
        $this->desconectar();
        return $results;


        // $consulta = mysql_query($sql,$this->connectMysql());
        // $data = $this->get_table_assoc($consulta);
    }

    public function traerTarifaId($id)
    {
        $sql = "select * from tarifas where id = '".$id."'  ";
        $query = $this->connectMysql()->prepare($sql); 
        $query -> execute(); 
        $results = $query -> fetch(PDO::FETCH_ASSOC); 
        $this->desconectar();
        return $results;
        // die($sql);
        // $consulta = mysql_query($sql,$this->connectMysql());
        // $data = mysql_fetch_assoc($consulta);
        // return $data;
    }
    public function traerTarifaIdParqueadero($idParqueadero)
    {
        $sql = "select * from tarifas where idParqueadero = '".$idParqueadero."'  ";
        $query = $this->connectMysql()->prepare($sql); 
        $query -> execute(); 
        $results = $query -> fetchAll(PDO::FETCH_ASSOC); 
        $this->desconectar();
        return $results;
    }
    
    public function traerTarifaIdParqIdTipVehi($idParqueadero,$idTipoVeh)
    {
        $sql = "select * from tarifas 
            where idParqueadero = '".$idParqueadero."'
            and idTipoVehiculo = '".$idTipoVeh."'
            ";
        $consulta = mysql_query($sql,$this->connectMysql());
        $data = $this->get_table_assoc($consulta);
        return $data;
    }


    public function grabarNuevaTarifa($request)
    {
        // $sql = "insert into tarifas  (idParqueadero,idTipoVehiculo,valorMinuto,idTipoTarifa,descripcion)    
        //     values ('".$request['idParqueadero']."','".$request['idTipoVehiculo']."'
        //     ,'".$request['valorMinuto']."','".$request['idTipoTarifa']."','".$request['descripcion']."'
        //     ) ";
            $sql = "insert into tarifas  (idParqueadero,idTipoVehiculo,valorMinuto,idTipoTarifa,descripcion) 
                values(:idParqueadero,:idTipoVehiculo,:valorMinuto,:idTipoTarifa,:descripcion)";
            $query = $this->connectMysql()->prepare($sql); 
            $query->bindParam(':idParqueadero',$request['idParqueadero'],PDO::PARAM_STR, 25);
            $query->bindParam(':idTipoVehiculo',$request['idTipoVehiculo'],PDO::PARAM_STR, 25);
            $query->bindParam(':valorMinuto',$request['valorMinuto'],PDO::PARAM_STR, 25);
            $query->bindParam(':idTipoTarifa',$request['idTipoTarifa'],PDO::PARAM_STR, 25);
            $query->bindParam(':descripcion',$request['descripcion'],PDO::PARAM_STR, 25);
            $query->execute();
            $this->desconectar();


            // die($sql);
        // $consulta = mysql_query($sql,$this->connectMysql());
        // $clientes = $this->get_table_assoc($consulta);
        // return $clientes;
    }
}