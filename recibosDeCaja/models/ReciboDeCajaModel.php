<?php
$raiz =dirname(dirname(dirname(__file__)));
//   die('rutamodelsucursal '.$raiz);

require_once($raiz.'/conexion/Conexion.php');
require_once($raiz.'/parqueaderos/models/ParqueaderoModel.php');
// require_once($raiz.'/parking/models/ParkingModel.php'); 

class ReciboDeCajaModel extends Conexion
{
    protected $parqueaderoModel;
    // protected $parkingModel;
    
    public function __construct()
    {
        $this->parqueaderoModel = new ParqueaderoModel(); 
        // $this->parkingModel = new ParkingModel(); 
        // die('recibo4567');
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
            
            //verificar si el idParking no existe
            //en caso de que exista no se debe grabar y se debe traer el id de este recibo para este idParking
            $validaIdPArking = $this->verificarIdParking($request['idParking']); 
            if($validaIdPArking['filas'] == 0)
            {
                $infoParqueadero = $this->parqueaderoModel->traerParqueaderoId($_SESSION['idSucursal']);
                $proximoRecibo  =  $infoParqueadero['norecibosalida']+1;
                $this->parqueaderoModel->actualizarReciboSalida($_SESSION['idSucursal'],$proximoRecibo);


                $sql = "insert into recibosdecaja  (idParking,porcentajeiva,valorsiniva,valoriva,valor,usuario,idParqueadero,placa,idFormaDePago,valorPagado,cambio,stringTiempoTotal,norecibosalida,fecha,valorMinuto,idTipoTarifa)    
                values(:idParking,:porcentajeiva,:valorsiniva,:valoriva,:valor,:usuario,:idParqueadero,:placa,:idFormaDePago,:valorPagado,:cambio,:stringTiempoTotal,:norecibosalida,:fecha,:valorMinuto,:idTipoTarifa)";
                $query = $this->connectMysql()->prepare($sql); 


                $query->bindParam(':idParking',$request['idParking'],PDO::PARAM_STR, 25);

                $query->bindParam(':valorsiniva',$request['inputCobroMinutos'],PDO::PARAM_STR, 25);
                $query->bindParam(':porcentajeiva',$request['porcenIva'],PDO::PARAM_STR, 25);
                $query->bindParam(':valoriva',$request['inputValorImp'],PDO::PARAM_STR, 25);
                $query->bindParam(':valor',$request['inputGranTotalAproximado'],PDO::PARAM_STR, 25);
                
                $query->bindParam(':usuario',$_SESSION['id_usuario'],PDO::PARAM_STR, 25);
                $query->bindParam(':idParqueadero',$_SESSION['idSucursal'],PDO::PARAM_STR, 25);
                $query->bindParam(':placa',$request['placa'],PDO::PARAM_STR, 25);
                $query->bindParam(':idFormaDePago',$request['idFormaPago'],PDO::PARAM_STR, 25);
                $query->bindParam(':valorPagado',$request['valorRecibido'],PDO::PARAM_STR, 25);
                $query->bindParam(':cambio',$request['valorVueltas'],PDO::PARAM_STR, 25);
                $query->bindParam(':stringTiempoTotal',$request['stringTiempoTotal'],PDO::PARAM_STR, 25);
                $query->bindParam(':norecibosalida',$proximoRecibo,PDO::PARAM_STR, 25);
                $query->bindParam(':fecha',$request['fechaFinTxt'],PDO::PARAM_STR, 25);
                $query->bindParam(':valorMinuto',$request['valorMinuto'],PDO::PARAM_STR, 25);
                $query->bindParam(':idTipoTarifa',$request['tipoTarifa'],PDO::PARAM_STR, 25);
                $query->execute();
                $this->desconectar();
                $maximo = $this->traerMaximoId();
            }  //fin de if($validaIdPArking == 0) osea si no existe el idParking  
            else{
                    // echo '<pre>'; 
                    // print_r($validaIdPArking['info']); 
                    // echo '</pre>';
                    $maximo = $validaIdPArking['info']['id'];
                    // die('<br>'.$maximo);
            }
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

        public function verificarIdParking($idParking)
        {
            $sql = "select * from recibosdecaja   where idParking = '".$idParking."'  "; 
            $query = $this->connectMysql()->prepare($sql); 
            $query -> execute(); 
            $results = $query -> fetch(PDO::FETCH_ASSOC); 
            $this->desconectar();
            $filas = $query->rowCount();
            $respu['filas'] = $filas;
            $respu['info'] = $results;
            return $respu;
            
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


        public function cambiarValorParking($idReciboCaja,$request)
        {
            // $infoParking =  $this->parkingModel->traerInfoParkingIdParking($request['idParking']);
            $infoRecibo = $this->traerReciboCajaId($idReciboCaja);
            $infoParqueadero =  $this->parqueaderoModel->traerParqueaderoId($infoRecibo['idParqueadero']);
            //    echo '<pre>'; 
            //  print_r($infoParqueadero); 
            //  echo '</pre>';
            //  die();
            $sql= '';
            if($infoParqueadero['manejaiva']==1)
            {
                $factorIva = '1'.$infoRecibo['porcentajeiva'];
                $factorIva = $factorIva/100;
                $valorSinIva = round($request['valor']/ $factorIva);
                $valorIva = $request['valor']-$valorSinIva; 

                $sql = "update recibosdecaja 
                set valorsiniva = '".$valorSinIva."',
                valoriva = '".$valorIva."',
                valor = '".$request['valor']."',
                valorPagado = '".$request['valor']."',
                cambio = 0
                where  id = '".$idReciboCaja."'
                ";
            }else{
                
                $sql = "update recibosdecaja 
                set valorsiniva = '".$request['valor']."',
                valoriva = 0,
                valor = '".$request['valor']."',
                valorPagado = '".$request['valor']."',
                cambio = 0
                where  id = '".$idReciboCaja."'
                ";
            }
            

            $query = $this->connectMysql()->prepare($sql); 
            $query -> execute(); 
            $this->desconectar();
        }
    

        public function sumarProducidoDiario($idParqueadero)
        {
            // $hoy = date("Y-m-d H:i:s"); 
            $hoy = date("Y-m-d"); 
            $desde =$hoy.' 00:00:00';
            $hasta =$hoy.' 23:59:59';
            // $sql = "select * from recibosdecaja where fecha between '".$desde."' and '".$hasta."' and idParqueadero = '".$idParqueadero."'   ";
            $sql = "select sum(valor) as suma from recibosdecaja where fecha between '".$desde."' and '".$hasta."' and idParqueadero = '".$idParqueadero."'   ";
            // die(':::::::::::'.$sql); 
            $query = $this->connectMysql()->prepare($sql); 
            $query -> execute(); 
            $results = $query -> fetch(PDO::FETCH_ASSOC); 
            $this->desconectar();
            return $results;

        }

 

  
}