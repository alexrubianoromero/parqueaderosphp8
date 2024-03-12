function formuNuevoParqueadero()
{
    //  alert('funcion javascript');
    const http=new XMLHttpRequest();
    const url = 'parqueaderos/parqueadero.php';
    http.onreadystatechange = function(){

        if(this.readyState == 4 && this.status ==200){
               document.getElementById("modalBodyNuevoParqueadero").innerHTML  = this.responseText;
        }
    };
    http.open("POST",url);
    http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    http.send('opcion=formuNuevoParqueadero'
    );

}


function grabarNuevoParqueadero()
{
    var valida =  validaInfoParqueadero();
    if(valida == '1')
    {
        var nombreParqueadero = document.getElementById('nombreParqueadero').value;
        var direccionParqueadero = document.getElementById('direccionParqueadero').value;
        const http=new XMLHttpRequest();
        const url = 'parqueaderos/parqueadero.php';
        http.onreadystatechange = function(){
                if(this.readyState == 4 && this.status ==200){
                           document.getElementById("modalBodyNuevoParqueadero").innerHTML  = this.responseText;
                    }
                };
                http.open("POST",url);
                http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                http.send('opcion=grabarNuevoParqueadero'
                    +'&nombreParqueadero='+nombreParqueadero
                    +'&direccionParqueadero='+direccionParqueadero
                );
    }
}

function  validaInfoParqueadero()
{
    if( document.getElementById('nombreParqueadero').value == ''){
        alert('Por favor digitar nombre');
        document.getElementById('nombreParqueadero').focus();
        return 0;
    }
    if( document.getElementById('direccionParqueadero').value == ''){
        alert('Por favor digitar direccion');
        document.getElementById('direccionParqueadero').focus();
        return 0;
    }
    return 1;
}
