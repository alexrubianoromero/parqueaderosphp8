<?php
$raiz = dirname(dirname(dirname(__file__)));
// require_once($raiz.'/login/views/loginView.php');  
require_once($raiz.'/parqueaderos/models/TipoVehiculoModel.php');  
require_once($raiz.'/parqueaderos/models/ParqueaderoModel.php');  
require_once($raiz.'/tarifas/models/TarifaModel.php'); 
require_once($raiz.'/tarifas/models/TipoTarifaModel.php'); 

class tarifasView
{
    protected $tipoVehiculoModel;
    protected $parqueaderoModel;
    protected $tarifaModel;
    protected $tipoTarifaModel;
    // protected $viewPlantilla;

    public function __construct()
    {
        $this->tipoVehiculoModel = new TipoVehiculoModel();
        $this->parqueaderoModel = new ParqueaderoModel();
        $this->tarifaModel = new TarifaModel();
        $this->tipoTarifaModel = new TipoTarifaModel();

        // if($_REQUEST['opcion']=='parqueaderoMenu'){
        //     // $this->model->traerParqueaderos();
        //     $this->view->parqueaderoMenu();
        // }    
    }
    public function tarifasMenu()
    {
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=div, initial-scale=1.0">
            <title>Document</title>
        </head>
        <body>
            <div>
                Tarifas <button 
                            class="btn btn-primary"
                            data-bs-toggle="modal" 
                            data-bs-target="#modalNuevoTarifa"
                            onclick="formuNuevaTarifa();"
                            >Nueva Tarifa</button>
                <div></div>
                <div id="divResultadosTarifas">
                    <?php
                        $tarifas = $this->tarifaModel->traerTarifas();
                        $this->mostrarTarifas($tarifas);
                    ?>
                </div>
            </div>
            <?php  
                $this->modalNuevoTarifa(); 
            ?>
        </body>
        </html>
        <?php
    }

    public function modalNuevoTarifa()
    {
        ?>
            <!-- Modal -->
            <div class="modal fade" id="modalNuevoTarifa" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Tarifas</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="modalBodyNuevaTarifa">
                    
                </div>
                <div class="modal-footer">
                    <button  type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="tarifas();" >Cerrar</button>
                    <button  type="button" class="btn btn-primary"  id="btnEnviar"  onclick="grabarNuevaTarifa();" >Grabar</button>
                </div>
                </div>
            </div>
            </div>

        <?php
    }

    public function mostrarTarifas($tarifas)
    {
        ?>
            <table class="table table-striped mt-3">
                <thead>
                    <tr>
                        <th>Descripcion</th>
                        <th>Parqueadero</th>
                        <th>Tipo Vehiculo</th>
                        <th>Tipo Tarifa</th>
                        <th>Valor Minuto</th>
                       
                    </tr>
                </thead>
                <tbody>
                    <?php
                       foreach($tarifas as $tarifa)
                       {
                           $infoTipoVehiculo = $this->tipoVehiculoModel->traerTipoVehiculoId($tarifa['idTipoVehiculo']);
                           $infoParqueadero = $this->parqueaderoModel->traerParqueaderoId($tarifa['idParqueadero']);
                           $tipoTarifa  =   $this->tipoTarifaModel->traerTipoTarifaId($tarifa['idTipoTarifa']);
                          echo '<tr>';  
                          echo '<td>'.$tarifa['descripcion'].'</td>'; 
                          echo '<td>'.$infoParqueadero['nombre'].'</td>'; 
                          echo '<td>'.$infoTipoVehiculo['descripcion'].'</td>'; 
                          echo '<td>'.$tipoTarifa['descripcion'].'</td>'; 
                          echo '<td>'.$tarifa['valorMinuto'].'</td>'; 
                          echo '</tr>';  
                        }  
                    ?>
                </tbody>
            </table>

        <?php
    }

    public function formuNuevaTarifa()
    {
      
        ?>
        <div class="row">
        <div>
            <label>Descripcion Tarifa</label>
            <div>
            <input class ="form-control" type="text" id="descripcionTarifa">          
            </div>
            
        </div>    
        <div class="col-md-6 mt-1">
                    <label for="">Parqueadero:</label>
                    <select id="idParqueadero" class ="form-control">
                        <option value ="">Seleccione...</option>
                        <?php
                            $parqueaderos = $this->parqueaderoModel->traerParqueaderos();
                            foreach($parqueaderos as $parqueadero)
                            {
                                echo '<option value ="'.$parqueadero['id'].'" >'.$parqueadero['nombre'].'</option>';
                            }
                        ?>

                    </select>   
                      <!-- <input class ="form-control" type="text" id="id">           -->
                </div>
                <div class="col-md-6 mt-1">
                    <label for="">Tipo Vehiculo</label>
                    <select id="idTipoVehiculo" class ="form-control">
                        <option value ="">Seleccione Tipo Vehiculo</option>
                        <?php
                            $tiposVehiculo = $this->tipoVehiculoModel->traerTiposVehiculos();
                            foreach($tiposVehiculo as $tipoVehiculo)
                            {
                                echo '<option value ="'.$tipoVehiculo['id'].'" >'.$tipoVehiculo['descripcion'].'</option>';
                            }
                        ?>
                    </select>   
                </div>
                <div class="col-md-6 mt-1">
                    <label for="">Tipo Tarifa</label>
                    <select id="idTipoTarifa" class ="form-control">
                        <option value ="">Seleccione Tipo Tarifa</option>
                        <?php
                            $tiposTarifas =  $this->tipoTarifaModel->traerTiposTarifa();
                            foreach($tiposTarifas as $tiposTarifa)
                            {
                                echo '<option value ="'.$tiposTarifa['id'].'" >'.$tiposTarifa['descripcion'].'</option>';
                            }
                        ?>
                    </select>   
                </div>

                <div class="col-md-6 mt-1">
                    <label for="">Valor Minuto (pesos)</label>
                      <input class ="form-control" type="text" id="valorMinuto">          
                </div>
              
             
        </div>
   
   
        <?php
    }
   

}