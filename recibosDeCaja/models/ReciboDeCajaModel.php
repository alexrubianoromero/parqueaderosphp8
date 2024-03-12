<?php

$raiz =dirname(dirname(dirname(__file__)));
//   die('rutamodelsucursal '.$raiz);

require_once($raiz.'/conexion/Conexion.php');

class ReciboDeCajaModel extends Conexion
{

    // public function traerVehiculosParking()
    // {
    //     $sql = "select * from parking where estado = 0 ";
    //     $consulta = mysql_query($sql,$this->connectMysql());
    //     $data = $this->get_table_assoc($consulta);
    //     return $data;
    // }
    // public function buscarPlacaVehiculosParking($placa)
    // {
        //     $sql = "select * from parking where placa like '%".$placa."%' ";
        //     $consulta = mysql_query($sql,$this->connectMysql());
        //     $data = $this->get_table_assoc($consulta);
        //     return $data;
        // }
        
        /*
        //output errores
        // 0 se realizo el registro
        // 1 No se realizo el registro porque ya estaba registrada la placa
        */
        public function grabarReciboDeCaja($request)
        {
            $sql = "insert into recibosDeCaja  (idParking,fecha,valor,usuario,idParqueadero,placa,idFormaDePago)    
            values ('".$request['idParking']."',now()
            ,'".$request['valorRecibido']."','".$_SESSION['id_usuario']."','".$_SESSION['idSucursal']."'
            ,'placa','".$request['idFormaPago']."'
            ) ";
            // die($sql);
            $consulta = mysql_query($sql,$this->connectMysql());

            $maximo = $this->traerMaximoId();
            return $maximo; 
        }       
        
        public function traerMaximoId()
        {
            $sql = "select max(id) as max from recibosDeCaja  "; 
            // die($sql);
            $consulta = mysql_query($sql,$this->connectMysql());
            $arr = mysql_fetch_assoc($consulta);
            return $arr['max']; 
        }
 

  
}