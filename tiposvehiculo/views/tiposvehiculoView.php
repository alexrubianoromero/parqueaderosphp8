<?php
$raiz = dirname(dirname(dirname(__file__)));
// require_once($raiz.'/login/views/loginView.php');  
require_once($raiz.'/tiposvehiculo/models/TipoVehiculoNewModel.php');  


class tiposvehiculoView
{
    protected $model;

    public function __construct()
    {
        $this->model = new TipoVehiculoNewModel(); 
    }

    public function mostrarSelectTipoVehiculo($infoParking)
    {
            $idParqueadero = $infoParking['idParqueadero'];
            $tipos = $this->model->traerTiposVehiculos();
            echo '<label>Tipo Vehiculo</label>';
            // echo '<select class="form-control" id="idTipoVehiculoNew" onchange="mostrarSelectTarifaXTipoVehiculoYParqueadero('.$idParqueadero.');">'; 
            echo '<select class="form-control" id="idTipoVehiculoNew" onchange="actualizarSelectTarifas();">'; 
            foreach($tipos as $tipo)
            {
                if($infoParking['idTipoVehiculo']== $tipo['id'])
                {
                    echo '<option    selected value ="'.$tipo['id'].'">'.$tipo['descripcion'].'</option>';   
                    
                }else{
                    echo '<option value ="'.$tipo['id'].'">'.$tipo['descripcion'].'</option>';   

                }
            }
            echo '</select>'; 
    }



}