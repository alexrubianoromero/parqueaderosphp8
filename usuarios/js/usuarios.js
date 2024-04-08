function pedirInfoUsuarioNuevo()
{
    // alert('verificando credenciales');
    const http=new XMLHttpRequest();
    const url = 'usuarios/usuarios.php';
    http.onreadystatechange = function(){

        if(this.readyState == 4 && this.status ==200){
               document.getElementById("modalBodyNuevoUsuario1").innerHTML  = this.responseText;
        }
    };
    http.open("POST",url);
    http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    http.send('opcion=pedirInfoUsuarioNuevo'
    );

    //  verificarCredencialesJsonAsignarSessionStorage(user,clave);
}


function grabarNuevoUsuario()
{
    var valida =  validaInfoUsuario();
    if(valida == '1')
    {
        var usuario = document.getElementById('usuario123').value;
        // alert(usuario);; 
        var nombreapellidoUsuario = document.getElementById('nombreApe321').value;
        var password = document.getElementById('password').value;
        var idParqueadero = document.getElementById('idParqueadero').value;
        var idPerfil = document.getElementById('idPerfil').value;
        const http=new XMLHttpRequest();
        const url = 'usuarios/usuarios.php';
        http.onreadystatechange = function(){
                if(this.readyState == 4 && this.status ==200){
                           document.getElementById("modalBodyNuevoUsuario1").innerHTML  = this.responseText;
                    }
                };
                http.open("POST",url);
                http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                http.send('opcion=grabarNuevoUsuario'
                    +'&usuario='+usuario
                    +'&nombreapellidoUsuario='+nombreapellidoUsuario
                    +'&password='+password
                    +'&idParqueadero='+idParqueadero
                    +'&idPerfil='+idPerfil
                );
    }
}
function formuCambiarParqueaderoUsuario(idUsuario)
{
  
        // var usuario = document.getElementById('usuario123').value;
        // alert(usuario);; 
        // var nombreapellidoUsuario = document.getElementById('nombreApe321').value;
        // var password = document.getElementById('password').value;
        // var idParqueadero = document.getElementById('idParqueadero').value;
        // var idPerfil = document.getElementById('idPerfil').value;
        const http=new XMLHttpRequest();
        const url = 'usuarios/usuarios.php';
        http.onreadystatechange = function(){
                if(this.readyState == 4 && this.status ==200){
                           document.getElementById("modalBodyCambiarUsuario").innerHTML  = this.responseText;
                    }
                };
                http.open("POST",url);
                http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                http.send('opcion=formuCambiarParqueaderoUsuario'
                    +'&idUsuario='+idUsuario
                    // +'&nombreapellidoUsuario='+nombreapellidoUsuario
                    // +'&password='+password
                    // +'&idParqueadero='+idParqueadero
                    // +'&idPerfil='+idPerfil
                );
    
}
function actualizarParqueaderoUsuario(idUsuario)
{
        var idParqueadero = document.getElementById('idParqueaderoUsuario').value;
        const http=new XMLHttpRequest();
        const url = 'usuarios/usuarios.php';
        http.onreadystatechange = function(){
                if(this.readyState == 4 && this.status ==200){
                           document.getElementById("modalBodyCambiarUsuario").innerHTML  = this.responseText;
                    }
                };
                http.open("POST",url);
                http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                http.send('opcion=actualizarParqueaderoUsuario'
                    +'&idUsuario='+idUsuario
                    +'&idParqueadero='+idParqueadero
                );
}


function  validaInfoUsuario()
{
    if( document.getElementById('usuario123').value == ''){
        alert('Por favor digitar usuario');
        document.getElementById('usuario123').focus();
        return 0;
    }
    if( document.getElementById('nombreApe321').value == ''){
        alert('Por favor digitar nombre y apellido');
        document.getElementById('nombreApe321').focus();
        return 0;
    }
    if( document.getElementById('password').value == ''){
        alert('Por favor digitar clave');
        document.getElementById('password').focus();
        return 0;
    }
    if( document.getElementById('idParqueadero').value == ''){
        alert('Por favor escoger parqueadero');
        document.getElementById('idParqueadero').focus();
        return 0;
    }
    if( document.getElementById('idPerfil').value == ''){
        alert('Por favor escoger perfil');
        document.getElementById('idPerfil').focus();
        return 0;
    }
    return 1;
}


function realizarCambiarClaveUsuario()
{
    var claveAnterior = document.getElementById('claveAnterior').value;
    var nuevaClave = document.getElementById('nuevaClave').value;
    
    // alert('cambio de clave '+claveAnterior+nuevaClave); 
    const http=new XMLHttpRequest();
        const url = 'usuarios/usuarios.php';
        http.onreadystatechange = function(){
    
            if(this.readyState == 4 && this.status ==200){
                   document.getElementById("div_respuestas_cambioClave").innerHTML  = this.responseText;
            }
        };
        http.open("POST",url);
        http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        http.send('opcion=realizarCambiarClave'
        +'&claveAnterior='+claveAnterior
        +'&nuevaClave='+nuevaClave
        );
     setTimeout(() => {
        document.getElementById("div_respuestas_cambioClave").innerHTML  = '';
     }, 2000);   
}
