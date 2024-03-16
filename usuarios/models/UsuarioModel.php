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
        $sql = "insert into usuarios (login,email,nombre,apellido,clave,idSucursal,id_perfil) 
        values (
            '".$request['email']."'
            ,'".$request['email']."'
            ,'".$request['nombreUsuario']."'
            ,'".$request['apellidoUsuario']."'
            ,'".$request['password']."'
            ,'".$request['idSucursal']."'
            ,'".$request['idPerfil']."'
            
        ) " ; 
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

    }
?>