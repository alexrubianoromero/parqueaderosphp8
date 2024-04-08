<?php
$raiz = dirname(dirname(dirname(__file__)));
// require_once($raiz.'/login/views/loginView.php');  
require_once($raiz.'/usuarios/models/UsuarioModel.php');  
require_once($raiz.'/parqueaderos/models/ParqueaderoModel.php');  
require_once($raiz.'/perfiles/models/PerfilModel.php');  

class usuarioView
{
    protected $model;
    protected $parqueaderoModel;
    protected $perfilModel;

    public function __construct()
    {
        $this->model = new UsuarioModel();
        $this->parqueaderoModel = new ParqueaderoModel();
        $this->perfilModel = new PerfilModel();

        // if($_REQUEST['opcion']=='parqueaderoMenu'){
        //     // $this->model->traerParqueaderos();
        //     $this->view->parqueaderoMenu();
        // }    
    }
    // protected $model;
    public function usuarioMenu()
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
                Usuarios <button 
                            class="btn btn-warning"
                            data-bs-toggle="modal" 
                            data-bs-target="#modalNuevoUsuario1"
                            onclick="pedirInfoUsuarioNuevo();"
                            >Usuario Nuevo</button>
                <div></div>
                <div id="div_resultadosUsuario">
                    <?php
                        $usuarios = $this->model->traerUsuarios();
                        $this->mostrarUsuarios($usuarios);
                    ?>
                </div>
            </div>
            <?php  
                $this->modalNuevoUsuario(); 
                $this->modalNuevoUsuario1(); 
                $this->modalCambiarUsuario(); 
                ?>
        </body>
        </html>
        <?php
    }

    public function modalNuevoUsuario()
    {
        ?>
            <!-- Modal -->
            <div class="modal fade" id="modalNuevoUsuario" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Usuario</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="modalBodyNuevoUsuario">
                    
                </div>
                <div class="modal-footer">
                    <button  type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="usuarios();" >Cerrar</button>
                    <button  type="button" class="btn btn-primary"  id="btnEnviar"  onclick="grabarNuevoUsuario();" >Grabar</button>
                </div>
                </div>
            </div>
            </div>

        <?php
    }
    public function modalNuevoUsuario1()
    {
        ?>
            <!-- Modal -->
            <div class="modal fade" id="modalNuevoUsuario1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Usuario</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="modalBodyNuevoUsuario1">
                    
                </div>
                <div class="modal-footer">
                    <button  type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="usuarios();" >Cerrar</button>
                    <button  type="button" class="btn btn-primary"  id="btnEnviar"  onclick="grabarNuevoUsuario();" >Grabar</button>
                </div>
                </div>
            </div>
            </div>

        <?php
    }
    public function modalCambiarUsuario()
    {
        ?>
            <!-- Modal -->
            <div class="modal fade" id="modalCambiarUsuario" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Usuario</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="modalBodyCambiarUsuario">
                    
                </div>
                <div class="modal-footer">
                    <button  type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="usuarios();" >Cerrar</button>
                    <!-- <button  type="button" class="btn btn-primary"  id="btnEnviar"  onclick=";" >Grabar</button> -->
                </div>
                </div>
            </div>
            </div>

        <?php
    }
    
    public function mostrarUsuarios($usuarios)
    {
        ?>
            <table class="table table-striped mt-3">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Login</th>
                       
                        <th>Parqueadero</th>
                        <th>Perfil</th>
                       
                    </tr>
                </thead>
                <tbody>
                    <?php
                       foreach($usuarios as $usuario)
                       {
                            $infoPerfil =   $this->perfilModel->traerPerfilId($usuario['id_perfil']); 
                            $infoParqueadero = $this->parqueaderoModel->traerParqueaderoId($usuario['idSucursal']); 
                          echo '<tr>';  
                          echo '<td>'.$usuario['id_usuario'].'</td>'; 
                          echo '<td>'.$usuario['login'].'</td>'; 
                          echo '<td><button 
                          class="btn btn-success" 
                          data-bs-toggle="modal" 
                          data-bs-target="#modalCambiarUsuario"
                          onclick="formuCambiarParqueaderoUsuario('.$usuario['id_usuario'].');"
                          >'.$infoParqueadero['nombre'].'</button></td>'; 
                          echo '<td>'.$infoPerfil['nombre_perfil'].'</td>'; 
                          echo '</tr>';  
                        }  
                    ?>
                </tbody>
            </table>

        <?php
    }


    public function pedirInfoUsuarioNuevo()
    {
        ?>
        <div class="row">
                <div class="col-md-6">
                    <label for="">Usuario:</label>
                      <input class ="form-control" type="text" id="usuario123">          
                </div>
                <div class="col-md-6">
                    <label for="">Nombre Apellido:</label>
                      <input class ="form-control" type="text" id="nombreApe321">          
                </div>
                <!-- <div class="col-md-6">
                    <label for="">Nombres Apellidos:</label>
                      <input class ="form-control" type="text" id="nombreapellidoUsuario123">          
                </div> -->
             
        </div>
        <div class="row">
                <div class="col-md-6">
                    <label for="">Password:</label>
                      <input class ="form-control" type="password" id="password">          
                </div>
                <!-- <div class="col-md-6">
                    <label for="">email:</label>
                      <input class ="form-control" type="text" id="email">          
                </div> -->
        </div>
        <div class="row">
                <div class="col-md-6">
                    <label for="">Parqueadero:</label>
                    <select id="idParqueadero" class ="form-control">
                        <option value ="">Seleccione parqueadero</option>
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
                <div class="col-md-6">
                <label for="">Perfil:</label>
                    <select id="idPerfil" class ="form-control">
                        <option value ="">Seleccione Perfil</option>
                        <?php
                            $perfiles = $this->perfilModel->traerPerfiles();
                            foreach($perfiles as $perfil)
                            {
                                echo '<option value ="'.$perfil['id_perfil'].'" >'.$perfil['nombre_perfil'].'</option>';
                            }
                        ?>

                    </select>   
                    
                </div>
        </div>

        <?php
    }

    public function cambiarClave()
    {
        // echo 'cambiar clave.. '; 
        ?>
        <div class="row " >
            <div class="col-lg-3 offset-lg-3" id="div_cambiarClave">
                <h3 class="text-center">CAMBIO DE CLAVE</h3>
                <div id="div_respuestas_cambioClave" style="color:blue;font-size:25px;">
                </div>
                <label>Digite clave Anterior</label>
                <div>
                    <input class="form-control" type="text" id="claveAnterior"  >
                </div>
                <label>Digite nueva clave</label>
                <div>
                    <input class="form-control"  type="text" id="nuevaClave"  >
                </div>
                <div class="mt-3">
                    <button class="btn btn-warning btn-block" onclick = "realizarCambiarClaveUsuario();" >Cambiar Clave</button>
                </div>
            </div>
        </div>

        <?php
    }

    public function formuCambiarParqueaderoUsuario($idUsuario)
    {
        $infoUsuario =  $this->model->traerInfoUsuarioId($idUsuario);
            //     echo '<pre>'; 
            // print_r($infoUsuario); 
            // echo '</pre>';
            // die();
        $parqueaderos =   $this->parqueaderoModel->traerParqueaderos(); 
        ?>
        Cambiar parqueadero usuario 
        <select id="idParqueaderoUsuario" class="form-control">
            <?php
  
            foreach($parqueaderos as $parqueadero)
            {
                if($parqueadero['id'] == $infoUsuario['idSucursal'] )
                {
                    echo '<option selected value = "'.$parqueadero['id'].'">'.$parqueadero['nombre'].'</option>'; 
                }else{
                    echo '<option value = "'.$parqueadero['id'].'">'.$parqueadero['nombre'].'</option>'; 
                }
            }    


            ?>
        </select>
        <div class="mt-3">
            <button class="btn btn-warning" onclick="actualizarParqueaderoUsuario(<?php   echo $idUsuario; ?>)">Actualizar</button>
        </div>
        <?php
    }



    
}