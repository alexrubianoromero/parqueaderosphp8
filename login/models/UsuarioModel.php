<?php

$raiz =dirname(dirname(dirname(__file__)));
//  die('rutamodel '.$raiz);

require_once($raiz.'/conexion/Conexion.php');

class UsuarioModel extends Conexion
{

    public function verificarCredenciales($request)
    {
        //    echo '<pre>'; 
        // print_r($request); 
        // echo '</pre>';
        // die();
        $sql = "select u.id_usuario,u.login,u.clave,u.nombre as nombreusuario ,u.id_perfil
        ,p.nombre_perfil,p.nivel,u.idSucursal 
        from usuarios u 
        inner join perfiles p on (p.id_perfil =  u.id_perfil )
        where login = '".$request['user']."'   "; 

        $query = $this->connectMysql()->prepare($sql); 
        $query -> execute(); 
        $results = $query -> fetch(PDO::FETCH_ASSOC); 
        $this->desconectar();
        
        $filas = $query->rowCount();
        $datosUser  =[];
        $respu = [];

        if($filas>0)
        {
            $datosUser = $results;  
            if($request['clave']==$results['clave']  )
            {
                $valida = 1; 
                $respu['datos'] = $datosUser;

            }
            else {
                $valida = 0;
            }
        }else{
            $valida = 0; 
        } 
       
        $respu['valida'] = $valida;
        return $respu;  
    } 




    public function verificarClaveActual($request)
    {
        $sql="select * from usuarios where id_usuario = '".$request['idUsuario']."' ";
        $consulta = mysql_query($sql,$this->connectMysql());
        $datosUser = mysql_fetch_assoc($consulta);
        return $datosUser;  
    }
    public function actualizarClave($request)
    {
        $sql = "update usuarios set
        clave = '".$request['claveNueva']."'
        where id_usuario = '".$request['idUsuario']."'  ";
        $consulta = mysql_query($sql,$this->connectMysql());
    }

    public function getUsers()
    {
        $sql = "select * from usuarios ";
        $consulta = mysql_query($sql,$this->connectMysql());
        $users = $this->get_table_assoc($consulta);
        return $users;
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
        
        $consulta = mysql_query($sql,$this->connectMysql());
        
    }
    public function  traerTecnicos()
    {
        $sql = "select u.id_usuario as id_usuario , u.nombre as nombre 
                from usuarios u 
                inner join perfiles p on (p.id_perfil = u.id_perfil) 
                where p.nombre_perfil = 'Tecnico'";
        $consulta = mysql_query($sql,$this->connectMysql());
        $tecnicos = $this->get_table_assoc($consulta);
        return $tecnicos;
        // die($sql);   
    }
    
    public function traerInfoId($idUsuario)
    {
        $sql = "select * from usuarios where id_usuario = '".$idUsuario."'  ";
        $consulta = mysql_query($sql,$this->connectMysql());
        $arrUsu = mysql_fetch_assoc($consulta);
        return $arrUsu;
    }
    
}

?>