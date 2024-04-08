<?php

$raiz =dirname(dirname(dirname(__file__)));
//   die('rutamodelsucursal '.$raiz);

require_once($raiz.'/conexion/Conexion.php');

class UsuarioModel extends Conexion
{

    public function traerUsuarios()
    {
        $sql = "select * from usuarios ";
        $query = $this->connectMysql()->prepare($sql); 
        $query -> execute(); 
        $results = $query -> fetchAll(PDO::FETCH_ASSOC); 
        $this->desconectar();
        return $results;
        // $consulta = mysql_query($sql,$this->connectMysql());
        // $usuarios = $this->get_table_assoc($consulta);
        // return $usuarios;

    }

    public function crearUsuario($request)
    {
        // $sql = "insert into usuarios (login,email,nombre,apellido,clave,idSucursal,id_perfil) 
        // values (
        //     '".$request['email']."'
        //     ,'".$request['email']."'
        //     ,'".$request['nombreUsuario']."'
        //     ,'".$request['apellidoUsuario']."'
        //     ,'".$request['password']."'
        //     ,'".$request['idSucursal']."'
        //     ,'".$request['idPerfil']."'
            
        // ) " ; 
        $sql = "insert into usuarios (login,email,nombre,apellido,clave,idSucursal,id_perfil) 
        values(:login,:email,:nombre,:apellido,:clave,:idSucursal,:id_perfil)";
        $query = $this->connectMysql()->prepare($sql); 
        $query->bindParam(':login',$request['email'],PDO::PARAM_STR, 25);
        $query->bindParam(':email',$request['email'],PDO::PARAM_STR, 25);
        $query->bindParam(':nombre',$request['nombreUsuario'],PDO::PARAM_STR, 25);
        $query->bindParam(':apellido',$request['apellidoUsuario'],PDO::PARAM_STR, 25);
        $query->bindParam(':clave',$request['password'],PDO::PARAM_STR, 25);
        $query->bindParam(':idSucursal',$request['idSucursal'],PDO::PARAM_STR, 25);
        $query->bindParam(':id_perfil',$request['idPerfil'],PDO::PARAM_STR, 25);
        $query->execute();
        $this->desconectar();
        
        // $consulta = mysql_query($sql,$this->connectMysql());
        
    }

    public function grabarNuevoUsuario($request)
    {
        // $sql = "insert into usuarios (login,nombre,clave,idSucursal,id_perfil) 
        // values (
        //     '".$request['usuario']."'
        //     ,'".$request['nombreapellidoUsuario']."'
        //     ,'".$request['password']."'
        //     ,'".$request['idParqueadero']."'
        //     ,'".$request['idPerfil']."'
            
        // ) " ; 
        $sql = "insert into usuarios (login,nombre,clave,idSucursal,id_perfil) 
        values(:login,:nombre,:clave,:idSucursal,:id_perfil)";
        $query = $this->connectMysql()->prepare($sql); 
        $query->bindParam(':login',$request['usuario'],PDO::PARAM_STR, 25);
        $query->bindParam(':nombre',$request['nombreapellidoUsuario'],PDO::PARAM_STR, 25);
        $query->bindParam(':clave',$request['password'],PDO::PARAM_STR, 25);
        $query->bindParam(':idSucursal',$request['idParqueadero'],PDO::PARAM_STR, 25);
        $query->bindParam(':id_perfil',$request['idPerfil'],PDO::PARAM_STR, 25);
        $query->execute();
        $this->desconectar();
        // die($sql);
        // $consulta = mysql_query($sql,$this->connectMysql());
        
    }
    // public function grabarNuevoParqueadero($request)
    // {
    //     $sql = "insert into parqueaderos  (nombre,direccion)    
    //         values ('".$request['nombreParqueadero']."','".$request['direccionParqueadero']."'
    //         ) ";
    //     $consulta = mysql_query($sql,$this->connectMysql());
  

    // }
    public function validarClaveActual($request)
    {
            $sql = "select * from usuarios where id_usuario = '".$_SESSION['id_usuario']."'  and clave = '".$request['claveAnterior']."'   "; 
            // die($sql ); 
            $query = $this->connectMysql()->prepare($sql); 
            $query -> execute(); 
            $results = $query -> fetch(PDO::FETCH_ASSOC); 
            $this->desconectar();
            $filas = $query->rowCount();
            if($filas>0){
                    $infoUsuario = $results;
                    $valida = 1; 
                }else{
                    $valida = 0; 
                }
            return $valida;
            // $consulta = mysql_query($sql,$this->connectMysql());
            // $filas = mysql_num_rows($consulta);
            // if($filas>0){
            //     $infoUsuario = $this->get_table_assoc($consulta);
            //     $valida = 1; 
            // }else{
            //     $valida = 0; 
            // }
            // return $valida; 
    }
        
        
    public function actualizarClaveUsuario($request)
    {
            $sql = "update usuarios set clave = '".$request['nuevaClave']."'   where id_usuario = '".$_SESSION['id_usuario']."'   "; 
            // $consulta = mysql_query($sql,$this->connectMysql());
            $sql = "update usuarios set clave = :nuevaclave  where id_usuario = '".$_SESSION['id_usuario']."'   "; 
            $query = $this->connectMysql()->prepare($sql); 
            $query->bindParam(':nuevaclave',$request['nuevaClave'],PDO::PARAM_STR, 25);
            $query->execute();
            $this->desconectar();

    }

    public function traerInfoUsuarioId($idUsuario)
    {
        $sql = "select * from usuarios where id_usuario = '".$idUsuario."'  ";
        // die($sql); 
        $query = $this->connectMysql()->prepare($sql); 
        $query -> execute(); 
        $results = $query -> fetch(PDO::FETCH_ASSOC); 
        $this->desconectar();
        return $results;
    }

    public function actualizarParqueaderoUsuario($request)
    {
            $sql = "update usuarios set idSucursal = '".$request['idParqueadero']."'   where id_usuario = '".$request['idUsuario']."'   "; 
            $query = $this->connectMysql()->prepare($sql); 
            $query->execute();
            $this->desconectar();

    }


    }
?>