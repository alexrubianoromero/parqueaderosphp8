function mostrarTiposVehiculos()
{
    //  alert('ingresovehicvulo');
    const http=new XMLHttpRequest();
    const url = 'parking/parking.php';
    http.onreadystatechange = function(){

        if(this.readyState == 4 && this.status ==200){
               document.getElementById("modalBodyNuevoIngresoParking").innerHTML  = this.responseText;
        }
    };
    http.open("POST",url);
    http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    http.send('opcion=mostrarTiposVehiculos'
    );

}


function formuIngresoVehiculoParqueadero(idTipoVehiculo)
{
    //  alert('ingresovehiculo'+idTipoVehiculo);
    const http=new XMLHttpRequest();
    const url = 'parking/parking.php';
    http.onreadystatechange = function(){

        if(this.readyState == 4 && this.status ==200){
               document.getElementById("modalBodyNuevoIngresoParking").innerHTML  = this.responseText;
        }
    };
    http.open("POST",url);
    http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    http.send('opcion=formuIngresoVehiculoParqueadero'
                +'&idTipoVehiculo='+idTipoVehiculo
    );

}

// function asignarInfoPorTipoVehiculo(idTipoVehiculo)
// {
//     //  alert('ingresovehiculo'+idTipoVehiculo);
//     // document.getElementById('idTipoVehiculoIngreso').value = idTipoVehiculo;
//     // traerDescripcionTipoVehiculo(idTipoVehiculo);
//     const http=new XMLHttpRequest();
//     // const url = 'parking/parking.php';
//     const url = 'index2.php';
//     http.onreadystatechange = function(){

//         if(this.readyState == 4 && this.status ==200){
//             var  resp = JSON.parse(this.responseText); 
//                         //   alert(resp.descripcion);
//                           //    document.getElementById("modalBodyNuevoIngresoParking").innerHTML  = this.responseText;
//                         // document.getElementById("idTipoVehiculoIngresoLabel").innerHTML  = resp.descripcion;
//         }
//     };
//     http.open("POST",url);
//     http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
//     http.send(
//     );
// }

function asignarInfoPorTipoVehiculo(idTipoVehiculo)
{
    //  alert('ingresovehiculo'+idTipoVehiculo);
    document.getElementById('idTipoVehiculoIngreso').value = idTipoVehiculo;
    traerDescripcionTipoVehiculo(idTipoVehiculo);
    traerTarifaIdParqIdTipVehi(idTipoVehiculo);
    

    const http=new XMLHttpRequest();
    const url = 'parking/parking.php';
    http.onreadystatechange = function(){

        if(this.readyState == 4 && this.status ==200){
            var  resp = JSON.parse(this.responseText); 
                        document.getElementById("idTipoVehiculoIngresoLabel").innerHTML  = resp.descripcion;
        }
    };
    http.open("POST",url);
    http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    http.send('opcion=asignarInfoPorTipoVehiculo'
                +'&idTipo='+idTipoVehiculo
    );
    
}

function traerDescripcionTipoVehiculo(idTipo)
{
    const http=new XMLHttpRequest();
    const url = 'parking/parking.php';
    http.onreadystatechange = function(){
        if(this.readyState == 4 && this.status ==200){
              var  resp = JSON.parse(this.responseText); 
            //   alert(resp.descripcion);
              document.getElementById("idTipoVehiculoIngresoLabel").value = resp.descripcion;
        }
    };
    http.open("POST",url);
    http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    http.send('opcion=traerDescripcionTipoVehiculo'
                +'&idTipo='+idTipo
    );
}


function traerTarifaIdParqIdTipVehi(idTipo)
{
    // alert('va por aca ');
    const http=new XMLHttpRequest();
    const url = 'parking/parking.php';
    http.onreadystatechange = function(){
        if(this.readyState == 4 && this.status ==200){
            var  resp = JSON.parse(this.responseText); 
            
            // for (x of resp) 
            // {
            //     var listaModal = document.querySelector('#idTarifa');
            //     var opcion = document.createElement('option');
            //     opcion.setAttribute('value', x.id);
            //     opcion.textContent = x.descripcion;
            //     listaModal.appendChild(opcion);
            // }
        }
        document.getElementById("div_idTarifa").innerHTML = this.responseText;
    };
    http.open("POST",url);
    http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    http.send('opcion=traerTarifaIdParqIdTipVehi'
                +'&idTipo='+idTipo
    );
   
}

function liquidarSalidaVehiculo(idParking)
{
    //  alert('ingresovehiculo'+idTipoVehiculo);
    const http=new XMLHttpRequest();
    const url = 'parking/parking.php';
    http.onreadystatechange = function(){

        if(this.readyState == 4 && this.status ==200){
               document.getElementById("modalBodySalidaParking").innerHTML  = this.responseText;
        }
    };
    http.open("POST",url);
    http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    http.send('opcion=liquidarSalidaVehiculo'
                +'&idParking='+idParking
    );

}
function formuModificacionPlaca(idParking)
{
    //  alert('ingresovehiculo'+idTipoVehiculo);
    const http=new XMLHttpRequest();
    const url = 'parking/parking.php';
    http.onreadystatechange = function(){

        if(this.readyState == 4 && this.status ==200){
               document.getElementById("modalBodymodalModifPlaca").innerHTML  = this.responseText;
        }
    };
    http.open("POST",url);
    http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    http.send('opcion=formuModificacionPlaca'
                +'&idParking='+idParking
    );
}
function formuModificacionValor(idParking)
{
    const http=new XMLHttpRequest();
    const url = 'parking/parking.php';
    http.onreadystatechange = function(){

        if(this.readyState == 4 && this.status ==200){
               document.getElementById("modalBodymodalModifValor").innerHTML  = this.responseText;
        }
    };
    http.open("POST",url);
    http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    http.send('opcion=formuModificacionValor'
                +'&idParking='+idParking
    );
}




function formuSalidaVehiculosParking()
{
    //  alert('ingresovehiculo'+idTipoVehiculo);
    const http=new XMLHttpRequest();
    const url = 'parking/parking.php';
    http.onreadystatechange = function(){

        if(this.readyState == 4 && this.status ==200){
               document.getElementById("modalBodySalidaParking").innerHTML  = this.responseText;
        }
    };
    http.open("POST",url);
    http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    http.send('opcion=formuSalidaVehiculosParking'
                // +'&idTipoVehiculo='+idTipoVehiculo
    );

}
function registrarIngresoVehiculo()
{
    var valida =  validaInfoParking();
    if(valida == '1')
    {
    //  alert('ingresovehiculo'+idTipoVehiculo);
    var idTipoVehiculo = document.getElementById('idTipoVehiculoIngreso').value;
    var idTarifa = document.getElementById('idTarifa').value;
    var placa = document.getElementById('placaIngreso').value;
    const http=new XMLHttpRequest();
    const url = 'parking/parking.php';
    http.onreadystatechange = function(){

        if(this.readyState == 4 && this.status ==200){
               document.getElementById("mensajesdePrograma").innerHTML  = this.responseText;
               limpiarMensajeRegistro();
        }
    };
    http.open("POST",url);
    http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    http.send('opcion=registrarIngresoVehiculo'
                +'&idTipoVehiculo='+idTipoVehiculo
                +'&idTarifa='+idTarifa
                +'&placa='+placa
    );
    }

    limpiarInfoCasillasIngresoVehiculo();
    setTimeout(() => {
        mostrarInfoParking();
    }, 250);
}


function limpiarInfoCasillasIngresoVehiculo()
{
    document.getElementById('idTipoVehiculoIngresoLabel').value='';
    document.getElementById('placaIngreso').value='';
    document.getElementById('placaIngreso').value='';
    reiniciarSelectTarifas();
}

function reiniciarSelectTarifas()
{
    // document.getElementById('idTipoVehiculoIngreso').value = idTipoVehiculo;
    // traerDescripcionTipoVehiculo(idTipoVehiculo);
    const http=new XMLHttpRequest();
    const url = 'parking/parking.php';
    http.onreadystatechange = function(){

        if(this.readyState == 4 && this.status ==200){
            var  resp = JSON.parse(this.responseText); 
                        //   alert(resp.descripcion);
                             document.getElementById("idTarifa").innerHTML  = this.responseText;
        }
    };
    http.open("POST",url);
    http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    http.send('opcion=reiniciarSelectTarifas'
                // +'&idTipo='+idTipoVehiculo
    );
}



function limpiarMensajeRegistro()
{
    setTimeout(() => {
        document.getElementById("mensajesdePrograma").innerHTML  = '';
    }, 2000);
}



/*
//llama la funcion que muestra los vehisulos en parking
*/
function mostrarInfoParking()
{
    const http=new XMLHttpRequest();
    const url = 'parking/parking.php';
    http.onreadystatechange = function(){

        if(this.readyState == 4 && this.status ==200){
            document.getElementById("divInfoVehiculosParqueadero").innerHTML  = this.responseText;
        }
    };
    http.open("POST",url);
    http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    http.send('opcion=mostrarInfoParking'
                // +'&placa='+placa
    );
}
function mostrarMovimientosDiarioEnParqueadero()
{
    const http=new XMLHttpRequest();
    const url = 'parking/parking.php';
    http.onreadystatechange = function(){

        if(this.readyState == 4 && this.status ==200){
            document.getElementById("divInfoVehiculosParqueadero").innerHTML  = this.responseText;
        }
    };
    http.open("POST",url);
    http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    http.send('opcion=mostrarMovimientosDiarioEnParqueadero'
                // +'&placa='+placa
    );
}

function mostrarMovimientosEnParqueaderoRangoFechas()
{
    var fechaIn = document.getElementById('fechaIn').value;
    var fechaFin = document.getElementById('fechaFin').value;

    const http=new XMLHttpRequest();
    const url = 'parking/parking.php';
    http.onreadystatechange = function(){

        if(this.readyState == 4 && this.status ==200){
            document.getElementById("divInfoVehiculosParqueadero").innerHTML  = this.responseText;
        }
    };
    http.open("POST",url);
    http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    http.send('opcion=mostrarMovimientosEnParqueaderoRangoFechas'
                +'&fechaIn='+fechaIn
                +'&fechaFin='+fechaFin
    );
}
function mostrarMovimientosEnParqueadero()
{
    const http=new XMLHttpRequest();
    const url = 'parking/parking.php';
    http.onreadystatechange = function(){

        if(this.readyState == 4 && this.status ==200){
            document.getElementById("divInfoVehiculosParqueadero").innerHTML  = this.responseText;
        }
    };
    http.open("POST",url);
    http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    http.send('opcion=mostrarMovimientosEnParqueadero'
                // +'&placa='+placa
    );
}

function  validaInfoParking()
{
    if( document.getElementById('idTipoVehiculoIngreso').value == '-1' ||  document.getElementById('idTipoVehiculoIngreso').value == '' ){
        alert('Por favor escoger un Tipo Vehiculo');
        document.getElementById('idTipoVehiculoIngreso').focus();
        return 0;
    }
    if( document.getElementById('placaIngreso').value == ''){
        alert('Por favor digitar Placa');
        document.getElementById('placaIngreso').focus();
        return 0;
    }
    if( document.getElementById('idTarifa').value == '-1'){
        alert('Por favor Escoger tarifa');
        document.getElementById('idTarifa').focus();
        return 0;
    }
    return 1;
}


function buscarPlacaVehiculosParking()
{
        //  alert('ingresovehiculo'+idTipoVehiculo);
        var placa = document.getElementById('placaABuscarEnParking').value;
        const http=new XMLHttpRequest();
        const url = 'parking/parking.php';
        http.onreadystatechange = function(){

            if(this.readyState == 4 && this.status ==200){
                document.getElementById("divInfoVehiculosParqueadero").innerHTML  = this.responseText;
            }
        };
        http.open("POST",url);
        http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        http.send('opcion=buscarPlacaVehiculosParking'
                    +'&placa='+placa
        );
}

function actualizarPlacaParking(idParking)
{
        //  alert('ingresovehiculo'+idTipoVehiculo);
        var placa = document.getElementById('placaParaCambiar').value;
        const http=new XMLHttpRequest();
        const url = 'parking/parking.php';
        http.onreadystatechange = function(){

            if(this.readyState == 4 && this.status ==200){
                document.getElementById("modalBodymodalModifPlaca").innerHTML  = this.responseText;
            }
        };
        http.open("POST",url);
        http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        http.send('opcion=actualizarPlacaParking'
                    +'&placa='+placa
                    +'&idParking='+idParking
        );
}

function actualizarValorParking(idParking)
{
     
        var valor = document.getElementById('valorParaCambiar').value;
        const http=new XMLHttpRequest();
        const url = 'parking/parking.php';
        http.onreadystatechange = function(){

            if(this.readyState == 4 && this.status ==200){
                document.getElementById("modalBodymodalModifValor").innerHTML  = this.responseText;
            }
        };
        http.open("POST",url);
        http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        http.send('opcion=actualizarValorParking'
                    +'&valor='+valor
                    +'&idParking='+idParking
        );
}




function buscarPlacaEnParking()
{
    var valida =  validaInfoPlaca();
    if(valida == '1')
    {
        //  alert('ingresovehiculo'+idTipoVehiculo);
        var placa = document.getElementById('placaABuscarParking').value;
        const http=new XMLHttpRequest();
        const url = 'parking/parking.php';
        http.onreadystatechange = function(){
            
            if(this.readyState == 4 && this.status ==200){
                document.getElementById("divResultadosPlacaParking").innerHTML  = this.responseText;
            }
        };
        http.open("POST",url);
        http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        http.send('opcion=buscarPlacaEnParking'
        +'&placa='+placa
        );
    }
}
function calcularVueltas()
{
    
    var valorRecibido = document.getElementById('valorRecibido').value;
    // var inputCobroMinutos = document.getElementById('inputCobroMinutos').value;
    var inputGranTotalAproximado = document.getElementById('inputGranTotalAproximado').value;
    var valorVueltas = Math.round(inputGranTotalAproximado) -  valorRecibido ;
    document.getElementById('valorVueltas').value = -Math.round(valorVueltas);
    //  alert('inputCobroMinutos'+inputCobroMinutos);
        // const http=new XMLHttpRequest();
        // const url = 'parking/parking.php';
        // http.onreadystatechange = function(){
            
        //     if(this.readyState == 4 && this.status ==200){
        //         document.getElementById("divResultadosPlacaParking").innerHTML  = this.responseText;
        //     }
        // };
        // http.open("POST",url);
        // http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        // http.send('opcion=calcularVueltas'
        // +'&placa='+placa
        // );
}

function  validaInfoPlaca()
{
    if( document.getElementById('placaABuscarParking').value == '-1'){
        alert('Por favor digitar Placa');
        document.getElementById('placaABuscarParking').focus();
        return 0;
    }
    return 1;
}

function facturarSalidaVehiculo(idParking)
{
    var valida =  validaInfoPago();
    if(valida == '1')
    {
        //  alert('ingresovehiculo'+idTipoVehiculo);
        var idFormaPago = document.getElementById('idFormaPago').value;
        var inputCobroMinutos = document.getElementById('inputCobroMinutos').value;
        var porcenIva = document.getElementById('porcenIva').value;
        var inputValorImp = document.getElementById('inputValorImp').value;
        var inputGranTotalAproximado = document.getElementById('inputGranTotalAproximado').value;
        var valorRecibido = document.getElementById('valorRecibido').value;
        var valorVueltas = document.getElementById('valorVueltas').value;
        var placa = document.getElementById('inputPlaca').value;
        var stringTiempoTotal = document.getElementById('stringTiempoTotal').value;
        var fechaFinTxt = document.getElementById('fechaFinTxt').value;
        const http=new XMLHttpRequest();
        const url = 'parking/parking.php';
        http.onreadystatechange = function(){

            if(this.readyState == 4 && this.status ==200){
                document.getElementById("modalBodySalidaParking").innerHTML  = this.responseText;
            }
        };
        http.open("POST",url);
        http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        http.send('opcion=facturarSalidaVehiculo'
                    +'&idFormaPago='+idFormaPago
                    +'&inputCobroMinutos='+inputCobroMinutos
                    +'&porcenIva='+porcenIva
                    +'&inputValorImp='+inputValorImp
                    +'&inputGranTotalAproximado='+inputGranTotalAproximado
                    +'&valorRecibido='+valorRecibido
                    +'&valorVueltas='+valorVueltas
                    +'&idParking='+idParking
                    +'&placa='+placa
                    +'&stringTiempoTotal='+stringTiempoTotal
                    +'&fechaFinTxt='+fechaFinTxt
        );
        //refrescar la pantalla de parking
        // setTimeout(() => {
        //     // myModal.hide();
        //     refrescarParking();
        //     document.getElementById("modalSalidaParking").hide();
        // }, 500);
        setTimeout(() => {
            mostrarInfoParking();
        }, 250);

    }
}

function refrescarParking()
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


function  validaInfoPago()
{
    if( document.getElementById('idFormaPago').value == '-1' ||  document.getElementById('idFormaPago').value == '' ){
        alert('Por favor escoger una Forma de pago');
        document.getElementById('idFormaPago').focus();
        return 0;
    }
    if( document.getElementById('valorRecibido').value == ''){
        alert('Por favor digitar Valor Recibido');
        document.getElementById('valorRecibido').focus();
        return 0;
    }
 
    return 1;
}



// function resumenDiarioMovimientos()
// {
//     //  alert('reporte ocupacion');
//     const http=new XMLHttpRequest();
//     const url = 'reportes/reportes.php';
//     http.onreadystatechange = function(){

//         if(this.readyState == 4 && this.status ==200){
//                document.getElementById("divInfoVehiculosParqueadero").innerHTML  = this.responseText;
//         }
//     };
//     http.open("POST",url);
//     http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
//     http.send('opcion=resumenDiarioMovimientos'
//     );

// }