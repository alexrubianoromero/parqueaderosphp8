<?php
$raiz =dirname(dirname(dirname(__file__)));
//   die('rutamodelsucursal '.$raiz);

require_once($raiz.'/conexion/Conexion.php');

class PerfilModel extends Conexion
{
    public function traerPerfiles()
    {
        $sql = "select * from perfiles order by id_perfil asc";
        // $consulta = mysql_query($sql,$this->connectMysql());
        // $perfiles = $this->get_table_assoc($consulta);
        // return $perfiles;
        $query = $this->connectMysql()->prepare($sql); 
        $query -> execute(); 
        $results = $query -> fetchAll(PDO::FETCH_ASSOC); 
        $this->desconectar();
        return $results;
    } 

    public function traerPerfilId($id)
    {
        $sql = "select * from perfiles where id_perfil =  '".$id."'  ";
        $query = $this->connectMysql()->prepare($sql); 
        $query -> execute(); 
        $results = $query -> fetch(PDO::FETCH_ASSOC); 
        $this->desconectar();
        return $results;
        // $consulta = mysql_query($sql,$this->connectMysql());
        // $perfil = mysql_fetch_assoc($consulta); 
        // return $perfil;
    }
}