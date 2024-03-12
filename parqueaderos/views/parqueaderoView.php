<?php
$raiz = dirname(dirname(dirname(__file__)));
// require_once($raiz.'/login/views/loginView.php');  
require_once($raiz.'/parqueaderos/models/ParqueaderoModel.php');  

class parqueaderoView
{
    protected $model;
    // protected $viewPlantilla;

    public function __construct()
    {
        $this->model = new ParqueaderoModel();

        // if($_REQUEST['opcion']=='parqueaderoMenu'){
        //     // $this->model->traerParqueaderos();
        //     $this->view->parqueaderoMenu();
        // }    
    }
    public function parqueaderoMenu()
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
                Parqueaderos <button 
                            class="btn btn-warning"
                            data-bs-toggle="modal" 
                            data-bs-target="#modalNuevoParqueadero"
                            onclick="formuNuevoParqueadero();"
                            >Nuevo</button>
                <div></div>
                <div id="div_resultadosparqueadero">
                    <?php
                        $parqueaderos = $this->model->traerParqueaderos();
                        $this->mostrarParqueaderos($parqueaderos);
                    ?>
                </div>
            </div>
            <?php  $this->modalNuevoParqueadero(); ?>
        </body>
        </html>
        <?php
    }
    public function modalNuevoParqueadero()
    {
        ?>
            <!-- Modal -->
            <div class="modal fade" id="modalNuevoParqueadero" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Subir Archivo</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="modalBodyNuevoParqueadero">
                    
                </div>
                <div class="modal-footer">
                    <button  type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="parqueaderos();" >Cerrar</button>
                    <button  type="button" class="btn btn-primary"  id="btnEnviar"  onclick="grabarNuevoParqueadero();" >Grabar</button>
                </div>
                </div>
            </div>
            </div>

        <?php
    }
    public function mostrarParqueaderos($parqueaderos)
    {
        ?>
            <table class="table table-striped mt-3">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Nombre</th>
                        <th>Direccion</th>
                       
                    </tr>
                </thead>
                <tbody>
                    <?php
                       foreach($parqueaderos as $parqueadero)
                       {
                        
                          echo '<tr>';  
                          echo '<td>'.$parqueadero['id'].'</td>'; 
                          echo '<td>'.$parqueadero['nombre'].'</td>'; 
                          echo '<td>'.$parqueadero['direccion'].'</td>'; 
                          echo '</tr>';  
                        }  
                    ?>
                </tbody>
            </table>

        <?php
    }


 
    public function formuNuevoParqueadero()
    {
      
        ?>
        <div class="row">
                <div class="col-md-6">
                    <label for="">Nombre Parqueadero:</label>
                      <input class ="form-control" type="text" id="nombreParqueadero">          
                </div>
                <div class="col-md-6">
                    <label for="">Direccion:</label>
                      <input class ="form-control" type="text" id="direccionParqueadero">          
                </div>
             
        </div>
   
   
        <?php
    }
   


}


?>