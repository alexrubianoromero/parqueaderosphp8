function irPantallaLogueo(){
    location.href ='https://crecienteparking.lagunaglamping.com';;
}
function verifiqueCredeciales()
{
    // alert('verificando credenciales');
    var user = document.getElementById("txtUsuario").value;
    var clave = document.getElementById("txtClave").value;
    const http=new XMLHttpRequest();
    const url = './index.php';
    http.onreadystatechange = function(){

        if(this.readyState == 4 && this.status ==200){
            var  resp = JSON.parse(this.responseText); 
            // alert(resp.valida);
            if(resp.valida == 1)
            {    
                //  alert('respuesta: '+ resp.valida + 'usuario '+ resp.datos.login+ ' '+resp.datos.id_usuario+ ' '+resp.datos.nivel);
                sessionStorage.id_usuario = resp.datos.id_usuario;
                sessionStorage.usuario = resp.datos.login;
                sessionStorage.nivel = resp.datos.nivel;

                document.getElementById("id_usuario").value = resp.datos.id_usuario;
                document.getElementById("usuario").value = resp.datos.login;
               document.getElementById("nivel").value = resp.datos.nivel;
                 menuPrincipal();
            }
            else{
                   document.getElementById("divErrorLogueo").innerHTML  = 'Usuario o Clave incorrectos';
                    alert('Usuario o Clave incorrectos '); 
            }
        }
    };
    http.open("POST",url);
    http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    http.send('opcion=verificarCredenciales'
    + "&user="+user
    + "&clave="+clave
    );

    //  verificarCredencialesJsonAsignarSessionStorage(user,clave);
}




function menuPrincipal(){

    const http=new XMLHttpRequest();
    const url = './index.php';
    http.onreadystatechange = function(){
        if(this.readyState == 4 && this.status ==200){
           document.getElementById("div_principal_inventarios").innerHTML  = this.responseText;
        }

    };
    http.open("POST",url);
    http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    http.send('opcion=menuPrincipal'
    + "&nivel="+ sessionStorage.nivel
    );
}
// function irPantallaLogueo(){
//     location.href ='http://www.alexrubiano.com/parqueaderos';
// }

function salir()
{
    // alert('verificando credenciales');
    const http=new XMLHttpRequest();
    const url = './index.php';
    http.onreadystatechange = function(){

        if(this.readyState == 4 && this.status ==200){
       
                sessionStorage.id_usuario = '';
                sessionStorage.usuario = '';
                sessionStorage.nivel = '';

                document.getElementById("id_usuario").value = '';
                document.getElementById("usuario").value = '';
               document.getElementById("nivel").value = '';
               document.getElementById("divInicialInventarios").innerHTML  = this.responseText;

        }
    };
    http.open("POST",url);
    http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    http.send('opcion=salir'
    );

    //  verificarCredencialesJsonAsignarSessionStorage(user,clave);
}


function usuarios()
{
    const http=new XMLHttpRequest();
    const url = './usuarios/usuarios.php';
    http.onreadystatechange = function(){

        if(this.readyState == 4 && this.status ==200){
               document.getElementById("div_content_wrapper").innerHTML  = this.responseText;

        }
    };
    http.open("POST",url);
    http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    http.send('opcion=usuarioMenu');

}

function parqueaderos()
{
    const http=new XMLHttpRequest();
    const url = './parqueaderos/parqueadero.php';
    http.onreadystatechange = function(){

        if(this.readyState == 4 && this.status ==200){
               document.getElementById("div_content_wrapper").innerHTML  = this.responseText;

        }
    };
    http.open("POST",url);
    http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    http.send('opcion=parqueaderoMenu');

}


function parking()
{
    const http=new XMLHttpRequest();
    const url = './parking/parking.php';
    http.onreadystatechange = function(){

        if(this.readyState == 4 && this.status ==200){
               document.getElementById("div_content_wrapper").innerHTML  = this.responseText;

        }
    };
    http.open("POST",url);
    http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    http.send('opcion=parkingMenu');

}

function tarifas()
{
    const http=new XMLHttpRequest();
    const url = './tarifas/tarifas.php';
    http.onreadystatechange = function(){

        if(this.readyState == 4 && this.status ==200){
               document.getElementById("div_content_wrapper").innerHTML  = this.responseText;

        }
    };
    http.open("POST",url);
    http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    http.send('opcion=tarifasMenu');

}

function sucursales()
{
    const http=new XMLHttpRequest();
    const url = './sucursales/sucursales.php';
    http.onreadystatechange = function(){

        if(this.readyState == 4 && this.status ==200){
               document.getElementById("div_content_wrapper").innerHTML  = this.responseText;

        }
    };
    http.open("POST",url);
    http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    http.send('opcion=sucursalesMenu');

}
function perfiles()
{
    const http=new XMLHttpRequest();
    const url = './perfiles/perfiles.php';
    http.onreadystatechange = function(){

        if(this.readyState == 4 && this.status ==200){
               document.getElementById("div_content_wrapper").innerHTML  = this.responseText;

        }
    };
    http.open("POST",url);
    http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    http.send('opcion=perfilesMenu');

}
function inventarios()
{
    const http=new XMLHttpRequest();
    const url = './inventarios/inventarios.php';
    http.onreadystatechange = function(){

        if(this.readyState == 4 && this.status ==200){
               document.getElementById("div_content_wrapper").innerHTML  = this.responseText;

        }
    };
    http.open("POST",url);
    http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    http.send('opcion=inventariosMenu');

}
function pedidos()
{
    const http=new XMLHttpRequest();
    const url = './pedidos/pedidos.php';
    http.onreadystatechange = function(){

        if(this.readyState == 4 && this.status ==200){
               document.getElementById("div_content_wrapper").innerHTML  = this.responseText;

        }
    };
    http.open("POST",url);
    http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    http.send('opcion=pedidosMenu');

}
function clientes()
{
    const http=new XMLHttpRequest();
    const url = './clientes/clientes.php';
    http.onreadystatechange = function(){

        if(this.readyState == 4 && this.status ==200){
               document.getElementById("div_content_wrapper").innerHTML  = this.responseText;

        }
    };
    http.open("POST",url);
    http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    http.send('opcion=clientesMenu');

}
function hojasdevida()
{
    // alert('buenas ');
    const http=new XMLHttpRequest();
    const url = './hojasdevida/hojasdevida.php';
    http.onreadystatechange = function(){

        if(this.readyState == 4 && this.status ==200){
               document.getElementById("div_content_wrapper").innerHTML  = this.responseText;

        }
    };
    http.open("POST",url);
    http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    http.send('opcion=hojasdevidaMenu');

}

function tablerotecnicos()
{
    // alert('buenas ');
    const http=new XMLHttpRequest();
    const url = './tablerotecnicos/tablerotecnicos.php';
    http.onreadystatechange = function(){

        if(this.readyState == 4 && this.status ==200){
               document.getElementById("div_content_wrapper").innerHTML  = this.responseText;

        }
    };
    http.open("POST",url);
    http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    http.send('opcion=tablerotecnicosMenu');

}
function reportes()
{
    // alert('buenas ');
    const http=new XMLHttpRequest();
    const url = './reportes/reportes.php';
    http.onreadystatechange = function(){

        if(this.readyState == 4 && this.status ==200){
               document.getElementById("div_content_wrapper").innerHTML  = this.responseText;
        }
    };
    http.open("POST",url);
    http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    http.send('opcion=reportesMenu');

}

function cambiarClave()
{
    const http=new XMLHttpRequest();
    const url = './usuarios/usuarios.php';
    http.onreadystatechange = function(){

        if(this.readyState == 4 && this.status ==200){
               document.getElementById("div_content_wrapper").innerHTML  = this.responseText;

        }
    };
    http.open("POST",url);
    http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    http.send('opcion=cambiarClave'
    );

}

