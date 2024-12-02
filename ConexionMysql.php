<?php
class ConexionMysql {
    //
    // private $host = 'localhost';
    // private $usuario = 'root';
    // private $contrasena = '';
    // private $nombreBaseDatos = 'base_parqueaderos';
    // private $conexion; 


    // private $host = 'localhost';
    // private $usuario = 'ctwtvsxj_admin';
    // private $contrasena = 'ElMejorProgramador***';
    // private $nombreBaseDatos = 'ctwtvsxj_base_parqueaderos';
    // private $conexion; 

    private $host = 'localhost';
    private $usuario = '';
    private $contrasena = '';
    private $nombreBaseDatos = '';
    private $conexion; 
    
    public function conectar(){
        try {
            $this->conexion = new PDO("mysql:host={$this->host};dbname={$this->nombreBaseDatos}",$this->usuario,$this->contrasena);
            $this->conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $this->conexion; 
        } catch (PDOException $e) {
            echo "Error de conexion:". $e->getMessage();
            die();
        }

    }

    public function desconectar(){
        $this->conexion = null;
    }
}



?>