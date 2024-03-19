<?php

$raiz =dirname(dirname(dirname(__file__)));
//   die('rutamodelsucursal '.$raiz);

require_once($raiz.'/conexion/Conexion.php');
require_once($raiz.'/parqueaderos/models/ParqueaderoModel.php');

class ReciboDeCajaModel extends Conexion
{
    protected $parqueaderoModel;

    public function __construct()
    {
        $this->parqueaderoModel = new ParqueaderoModel(); 
    }
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
            //  echo '<pre>'; 
            //  print_r($request); 
            //  echo '</pre>';
            //  die();
            
            
            // $sql = "insert into recibosDeCaja  (idParking,fecha,valor,usuario,idParqueadero,placa,idFormaDePago,valorPagado,cambio)    
            // values ('".$request['idParking']."',now()
            // ,'".$request['valorRecibido']."','".$_SESSION['id_usuario']."','".$_SESSION['idSucursal']."'
            // ,'placa','".$request['idFormaPago']."'
            // ) ";
            // die($sql);
            // $consulta = mysql_query($sql,$this->connectMysql());
            $infoParqueadero = $this->parqueaderoModel->traerParqueaderoId($_SESSION['idSucursal']);
            //     echo '<pre>'; 
            //   print_r($infoParqueadero); 
            //   echo '</pre>';
            //   die();
              $proximoRecibo  =  $infoParqueadero['norecibosalida']+1;
              

            // die('recibo salida '.$proximoRecibo);
            $this->parqueaderoModel->actualizarReciboSalida($_SESSION['idSucursal'],$proximoRecibo);
            ///////////
            $valorMinRedondeado = round($request['inputCobroMinutos']);
            $sql = "insert into recibosdecaja  (idParking,valor,usuario,idParqueadero,placa,idFormaDePago,valorPagado,cambio,stringTiempoTotal,norecibosalida)    
            values(:idParking,:valor,:usuario,:idParqueadero,:placa,:idFormaDePago,:valorPagado,:cambio,:stringTiempoTotal,:norecibosalida)";
            $query = $this->connectMysql()->prepare($sql); 
            $query->bindParam(':idParking',$request['idParking'],PDO::PARAM_STR, 25);
            $query->bindParam(':valor',$valorMinRedondeado,PDO::PARAM_STR, 25);
            $query->bindParam(':usuario',$_SESSION['id_usuario'],PDO::PARAM_STR, 25);
            $query->bindParam(':idParqueadero',$_SESSION['idSucursal'],PDO::PARAM_STR, 25);
            $query->bindParam(':placa',$request['placa'],PDO::PARAM_STR, 25);
            $query->bindParam(':idFormaDePago',$request['idFormaPago'],PDO::PARAM_STR, 25);
            $query->bindParam(':valorPagado',$request['valorRecibido'],PDO::PARAM_STR, 25);
            $query->bindParam(':cambio',$request['valorVueltas'],PDO::PARAM_STR, 25);
            $query->bindParam(':stringTiempoTotal',$request['stringTiempoTotal'],PDO::PARAM_STR, 25);
            $query->bindParam(':norecibosalida',$proximoRecibo,PDO::PARAM_STR, 25);
            $query->execute();
            $this->desconectar();
            
            //////////////
            
            $maximo = $this->traerMaximoId();
            return $maximo; 
        }       
        
        public function traerMaximoId()
        {
            $sql = "select max(id) as max from recibosdecaja  "; 
            // die($sql);
            $query = $this->connectMysql()->prepare($sql); 
            $query -> execute(); 
            $results = $query -> fetch(PDO::FETCH_ASSOC); 
            $this->desconectar();
            return $results['max']; 
        }

        
        public function traerReciboCajaId($id)
        {
            $sql = "select * from recibosdecaja where id = '".$id."'  "; 
            $query = $this->connectMysql()->prepare($sql); 
            $query -> execute(); 
            $results = $query -> fetch(PDO::FETCH_ASSOC); 
            $this->desconectar();
            return $results; 
        }


 

  
}