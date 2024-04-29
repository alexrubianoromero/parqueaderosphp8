

function verReporteOcupacion()
{
    //  alert('reporte ocupacion');
    const http=new XMLHttpRequest();
    const url = 'reportes/reportes.php';
    http.onreadystatechange = function(){

        if(this.readyState == 4 && this.status ==200){
               document.getElementById("divResultadosReportes").innerHTML  = this.responseText;
        }
    };
    http.open("POST",url);
    http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    http.send('opcion=verReporteOcupacion'
    );

}
function verReporteTrazabilidad()
{
    //  alert('reporte ocupacion');
    const http=new XMLHttpRequest();
    const url = 'reportes/reportes.php';
    http.onreadystatechange = function(){

        if(this.readyState == 4 && this.status ==200){
               document.getElementById("divResultadosReportes").innerHTML  = this.responseText;
        }
    };
    http.open("POST",url);
    http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    http.send('opcion=verReporteTrazabilidad'
    );

}
