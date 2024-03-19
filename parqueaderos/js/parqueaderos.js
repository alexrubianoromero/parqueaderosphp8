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
        var telefonoParqueadero = document.getElementById('telefonoParqueadero').value;
        var emailParqueadero = document.getElementById('emailParqueadero').value;
        var manejaiva = document.getElementById('manejaiva').value;
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
                    +'&telefonoParqueadero='+telefonoParqueadero
                    +'&emailParqueadero='+emailParqueadero
                    +'&manejaiva='+manejaiva
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
    if( document.getElementById('telefonoParqueadero').value == ''){
        alert('Por favor digitar telefono');
        document.getElementById('telefonoParqueadero').focus();
        return 0;
    }
    if( document.getElementById('emailParqueadero').value == ''){
        alert('Por favor digitar email');
        document.getElementById('emailParqueadero').focus();
        return 0;
    }
    if( document.getElementById('manejaiva').value == ''){
        alert('Por favor indicar si maneja iva');
        document.getElementById('manejaiva').focus();
        return 0;
    }
    return 1;
}
