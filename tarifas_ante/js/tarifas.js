function formuNuevaTarifa()
{
    //  alert('funcion javascript');
    const http=new XMLHttpRequest();
    const url = 'tarifas/tarifas.php';
    http.onreadystatechange = function(){

        if(this.readyState == 4 && this.status ==200){
               document.getElementById("modalBodyNuevaTarifa").innerHTML  = this.responseText;
        }
    };
    http.open("POST",url);
    http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    http.send('opcion=formuNuevaTarifa'
    );

}


function grabarNuevaTarifa()
{
    var valida =  validaInfoTarifa();
    if(valida == '1')
    {
        var descripcion = document.getElementById('descripcionTarifa').value;
        var idParqueadero = document.getElementById('idParqueadero').value;
        var idTipoVehiculo = document.getElementById('idTipoVehiculo').value;
        var idTipoTarifa = document.getElementById('idTipoTarifa').value;
        var valorMinuto = document.getElementById('valorMinuto').value;
        const http=new XMLHttpRequest();
        const url = 'tarifas/tarifas.php';
        http.onreadystatechange = function(){
                if(this.readyState == 4 && this.status ==200){
                           document.getElementById("modalBodyNuevaTarifa").innerHTML  = this.responseText;
                    }
                };
                http.open("POST",url);
                http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                http.send('opcion=grabarNuevaTarifa'
                    +'&descripcion='+descripcion
                    +'&idParqueadero='+idParqueadero
                    +'&idTipoVehiculo='+idTipoVehiculo
                    +'&idTipoTarifa='+idTipoTarifa
                    +'&valorMinuto='+valorMinuto
                );
    }
}

function  validaInfoTarifa()
{
    if( document.getElementById('descripcionTarifa').value == ''){
        alert('Por favor digitar descripcion');
        document.getElementById('descripcionTarifa').focus();
        return 0;
    }
    if( document.getElementById('idParqueadero').value == ''){
        alert('Por favor digitar parqueadero');
        document.getElementById('idParqueadero').focus();
        return 0;
    }
    if( document.getElementById('idTipoVehiculo').value == ''){
        alert('Por favor digitar Tipo Vehiculo');
        document.getElementById('idTipoVehiculo').focus();
        return 0;
    }
    if( document.getElementById('idTipoTarifa').value == ''){
        alert('Por favor escoger tipo tarifa');
        document.getElementById('idTipoTarifa').focus();
        return 0;
    }
    if( document.getElementById('valorMinuto').value == ''){
        alert('Por favor digitar Valor Minuto');
        document.getElementById('valorMinuto').focus();
        return 0;
    }

    return 1;
}


function formuModifTarifa(idTarifa)
{
        const http=new XMLHttpRequest();
        const url = 'tarifas/tarifas.php';
        http.onreadystatechange = function(){
                if(this.readyState == 4 && this.status ==200){
                           document.getElementById("modalBodyModifTarifa").innerHTML  = this.responseText;
                    }
                };
                http.open("POST",url);
                http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                http.send('opcion=formuModifTarifa'
                    +'&idTarifa='+idTarifa
                );
}


function grabarModifTarifa()
{
    var valida =  validaInfoModifTarifa();
    if(valida == '1')
    {
      $validaProceso = confirm('Esta seguro de actualizar esta tarifa ?');
      if($validaProceso == 1)
      {
          var idTarifa = document.getElementById('idtarifaModif').value;
          var valorMinuto = document.getElementById('valorMinutoModif').value;
          const http=new XMLHttpRequest();
          const url = 'tarifas/tarifas.php';
          http.onreadystatechange = function(){
              if(this.readyState == 4 && this.status ==200){
                  document.getElementById("modalBodyModifTarifa").innerHTML  = this.responseText;
                }
            };
            http.open("POST",url);
            http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            http.send('opcion=grabarModifTarifa'
            +'&idTarifa='+idTarifa
            +'&valorMinuto='+valorMinuto
            );
        } 
    }
}
    

function  validaInfoModifTarifa()
{
    if( document.getElementById('valorMinutoModif').value == ''){
        alert('Por favor digitar Valor Minuto');
        document.getElementById('valorMinutoModif').focus();
        return 0;
    }

    return 1;
}
